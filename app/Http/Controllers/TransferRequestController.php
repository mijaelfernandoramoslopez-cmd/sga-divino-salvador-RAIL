<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Role;
use App\Models\Section;
use App\Models\Student;
use App\Models\TransferRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * HU-16: Gestión de traslado de estudiantes.
 * Enfoque aplicado: traslado de ingreso de estudiantes desde otra institución.
 */
class TransferRequestController extends Controller
{
    private const DEFAULT_MALE_PHOTO = 'Alumno_perfil.jpg';
    private const DEFAULT_FEMALE_PHOTO = 'Alumna_perfil.jpg';

    public function index()
    {
        $requests = TransferRequest::with([
                'requestedSection.course.degree',
                'requestedSection.course.subgrade',
                'student',
                'reviewer',
            ])
            ->orderBy('idtransfer_request', 'DESC')
            ->get();

        return view('transfer_requests.index', compact('requests'));
    }

    public function create()
    {
        $sections = $this->activeSections();

        return view('transfer_requests.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni'                  => 'required|digits:8',
            'full_name'            => 'required|string|max:100',
            'gender'               => ['required', Rule::in(['M', 'F'])],
            'birth_date'           => 'required|date|before:today',
            'address'              => 'nullable|string|max:255',
            'previous_school'      => 'required|string|max:150',
            'previous_school_code' => 'nullable|string|max:30',
            'origin_grade'         => 'nullable|string|max:80',
            'requested_idsection'  => 'nullable|integer|exists:sections,idsection',
            'request_date'         => 'required|date',
            'documents_presented'  => 'required|string|max:1000',
            'observations'         => 'nullable|string|max:1000',
        ]);

        if (Student::where('dni', $request->dni)->exists()) {
            return back()->withInput()->withErrors([
                'dni' => 'Ya existe un estudiante registrado con este DNI. Si ya pertenece al colegio, usa matrícula/sección en lugar de traslado.',
            ]);
        }

        TransferRequest::create([
            'request_code'          => $this->generateCode(),
            'dni'                   => $request->dni,
            'full_name'             => $request->full_name,
            'gender'                => $request->gender,
            'birth_date'            => $request->birth_date,
            'address'               => $request->address,
            'previous_school'       => $request->previous_school,
            'previous_school_code'  => $request->previous_school_code,
            'origin_grade'          => $request->origin_grade,
            'requested_idsection'   => $request->requested_idsection,
            'request_date'          => $request->request_date,
            'documents_presented'   => $request->documents_presented,
            'observations'          => $request->observations,
            'status'                => 'PENDIENTE',
        ]);

        return redirect()->route('transferRequests.index')->with('transfer_created', 'OK');
    }

    public function show($id)
    {
        $transferRequest = TransferRequest::with([
                'requestedSection.course.degree',
                'requestedSection.course.subgrade',
                'requestedSection.course.semester.period',
                'student',
                'enrollment',
                'reviewer',
            ])
            ->findOrFail($id);

        return view('transfer_requests.show', compact('transferRequest'));
    }

    public function approveForm($id)
    {
        $transferRequest = TransferRequest::findOrFail($id);

        if ($transferRequest->status === 'APROBADO') {
            return redirect()->route('transferRequests.show', $transferRequest->idtransfer_request)
                ->withErrors(['status' => 'Esta solicitud ya fue aprobada.']);
        }

        $sections = $this->activeSections();

        return view('transfer_requests.approve', compact('transferRequest', 'sections'));
    }

    public function approve(Request $request, $id)
    {
        $transferRequest = TransferRequest::findOrFail($id);

        if ($transferRequest->status === 'APROBADO') {
            return redirect()->route('transferRequests.show', $transferRequest->idtransfer_request)
                ->withErrors(['status' => 'Esta solicitud ya fue aprobada.']);
        }

        $request->validate([
            'username'        => 'required|string|max:50|unique:users,username',
            'email'           => 'required|email|max:100|unique:users,email',
            'password'        => 'required|string|min:6',
            'idsection'       => 'required|integer|exists:sections,idsection',
            'enrollment_date' => 'required|date',
            'decision_notes'  => 'nullable|string|max:1000',
        ]);

        if (Student::where('dni', $transferRequest->dni)->exists()) {
            return back()->withInput()->withErrors([
                'dni' => 'Ya existe un estudiante registrado con el DNI de esta solicitud.',
            ]);
        }

        try {
            DB::beginTransaction();

            $role = Role::where('role_name', 'STUDENT')->first();
            if (!$role) {
                throw new \Exception('No existe el rol STUDENT en la base de datos.');
            }

            $user = User::create([
                'username'       => $request->username,
                'email'          => $request->email,
                'password'       => Hash::make($request->password),
                'idrole'         => $role->idrole,
                'photo'          => $this->defaultPhotoByGender($transferRequest->gender),
                'status'         => 1,
                'login_attempts' => 0,
                'locked_until'   => null,
            ]);

            $student = Student::create([
                'iduser'     => $user->iduser,
                'dni'        => $transferRequest->dni,
                'full_name'  => $transferRequest->full_name,
                'gender'     => $transferRequest->gender,
                'birth_date' => $transferRequest->birth_date,
                'address'    => $transferRequest->address,
            ]);

            $enrollment = Enrollment::create([
                'idstudent'       => $student->idstudent,
                'idsection'       => $request->idsection,
                'enrollment_date' => $request->enrollment_date,
                'status'          => 1,
            ]);

            $transferRequest->update([
                'status'         => 'APROBADO',
                'decision_notes' => $request->decision_notes,
                'reviewed_by'    => Auth::id(),
                'reviewed_at'    => now(),
                'idstudent'      => $student->idstudent,
                'idenrollment'   => $enrollment->idenrollment,
            ]);

            DB::commit();

            return redirect()->route('transferRequests.show', $transferRequest->idtransfer_request)
                ->with('transfer_approved', 'OK');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors([
                'error' => 'No se pudo aprobar el traslado: ' . $e->getMessage(),
            ]);
        }
    }

    public function observeForm($id)
    {
        $transferRequest = TransferRequest::findOrFail($id);
        $action = 'OBSERVADO';

        return view('transfer_requests.decision', compact('transferRequest', 'action'));
    }

    public function observe(Request $request, $id)
    {
        return $this->changeStatus($request, $id, 'OBSERVADO');
    }

    public function rejectForm($id)
    {
        $transferRequest = TransferRequest::findOrFail($id);
        $action = 'RECHAZADO';

        return view('transfer_requests.decision', compact('transferRequest', 'action'));
    }

    public function reject(Request $request, $id)
    {
        return $this->changeStatus($request, $id, 'RECHAZADO');
    }

    private function changeStatus(Request $request, int $id, string $status)
    {
        $request->validate([
            'decision_notes' => 'required|string|max:1000',
        ]);

        $transferRequest = TransferRequest::findOrFail($id);

        if ($transferRequest->status === 'APROBADO') {
            return redirect()->route('transferRequests.show', $transferRequest->idtransfer_request)
                ->withErrors(['status' => 'No se puede modificar una solicitud ya aprobada.']);
        }

        $transferRequest->update([
            'status'         => $status,
            'decision_notes' => $request->decision_notes,
            'reviewed_by'    => Auth::id(),
            'reviewed_at'    => now(),
        ]);

        return redirect()->route('transferRequests.show', $transferRequest->idtransfer_request)
            ->with('transfer_status_updated', 'OK');
    }

    private function activeSections()
    {
        return Section::with([
                'course.degree',
                'course.subgrade',
                'course.semester.period',
            ])
            ->where('status', 1)
            ->orderBy('section_name')
            ->get();
    }



    private function defaultPhotoByGender(?string $gender): string
    {
        return $gender === 'F' ? self::DEFAULT_FEMALE_PHOTO : self::DEFAULT_MALE_PHOTO;
    }

    private function generateCode(): string
    {
        $year = date('Y');
        $sequence = TransferRequest::where('request_code', 'like', "TR-{$year}-%")->count() + 1;

        do {
            $code = sprintf('TR-%s-%04d', $year, $sequence);
            $sequence++;
        } while (TransferRequest::where('request_code', $code)->exists());

        return $code;
    }
}
