<?php

namespace App\Http\Controllers;

use App\Models\AcademicDocument;
use App\Models\Certificate;
use App\Models\GradeCertificate;
use Illuminate\Http\Request;

/**
 * HU-14: Validación de documentos académicos.
 * Permite consultar la autenticidad de constancias de estudios y constancias de notas.
 */
class AcademicDocumentController extends Controller
{
    /**
     * Se muestra directamente el formulario de validación.
     * Se elimina el historial porque el buscador de la tabla repetía la función
     * principal de validar por código.
     */
    public function index()
    {
        return view('academic_documents.validate');
    }

    public function validateForm()
    {
        return view('academic_documents.validate');
    }

    public function validateDocument(Request $request)
    {
        $request->validate([
            'document_code' => 'required|string|max:50',
        ]);

        $documentCode = strtoupper(trim($request->document_code));
        $document = $this->findOrSyncDocument($documentCode);

        if ($document) {
            $document->increment('validation_count');
            $document->update(['last_validated_at' => now()]);
        }

        return view('academic_documents.validate', compact('document', 'documentCode'));
    }

    public function view($code)
    {
        $document = $this->findOrSyncDocument(strtoupper(trim($code)));

        if (!$document || (int) $document->status !== 1) {
            abort(404);
        }

        if ($document->document_type === 'CONSTANCIA_ESTUDIOS' && $document->source_id) {
            return redirect()->route('certificates.print', $document->source_id);
        }

        if ($document->document_type === 'CONSTANCIA_NOTAS' && $document->source_id) {
            return redirect()->route('gradeCertificates.print', $document->source_id);
        }

        abort(404);
    }

    /**
     * Permite validar documentos antiguos aunque todavía no estén sincronizados
     * en la tabla academic_documents.
     */
    private function findOrSyncDocument(string $documentCode): ?AcademicDocument
    {
        $document = AcademicDocument::with(['student', 'issuer'])
            ->where('document_code', $documentCode)
            ->first();

        if ($document) {
            return $document;
        }

        $certificate = Certificate::with(['student', 'issuer'])
            ->where('certificate_code', $documentCode)
            ->first();

        if ($certificate) {
            return self::syncStudyCertificate($certificate)->load(['student', 'issuer']);
        }

        $gradeCertificate = GradeCertificate::with(['student', 'issuer'])
            ->where('certificate_code', $documentCode)
            ->first();

        if ($gradeCertificate) {
            return self::syncGradeCertificate($gradeCertificate)->load(['student', 'issuer']);
        }

        return null;
    }

    public static function syncStudyCertificate(Certificate $certificate): AcademicDocument
    {
        return AcademicDocument::updateOrCreate(
            [
                'document_code' => $certificate->certificate_code,
            ],
            [
                'document_type' => 'CONSTANCIA_ESTUDIOS',
                'source_table' => 'certificates',
                'source_id' => $certificate->idcertificate,
                'idstudent' => $certificate->idstudent,
                'issued_by' => $certificate->issued_by,
                'issue_date' => $certificate->issue_date,
                'status' => $certificate->status,
            ]
        );
    }

    public static function syncGradeCertificate(GradeCertificate $certificate): AcademicDocument
    {
        return AcademicDocument::updateOrCreate(
            [
                'document_code' => $certificate->certificate_code,
            ],
            [
                'document_type' => 'CONSTANCIA_NOTAS',
                'source_table' => 'grade_certificates',
                'source_id' => $certificate->idgradecertificate,
                'idstudent' => $certificate->idstudent,
                'issued_by' => $certificate->issued_by,
                'issue_date' => $certificate->issue_date,
                'status' => $certificate->status,
            ]
        );
    }
}
