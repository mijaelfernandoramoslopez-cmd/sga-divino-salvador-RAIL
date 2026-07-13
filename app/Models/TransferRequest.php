<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * HU-16: Solicitud de traslado de ingreso.
 * Representa alumnos que solicitan ingresar desde otra institución educativa.
 */
class TransferRequest extends Model
{
    use HasFactory;

    protected $table = 'transfer_requests';
    protected $primaryKey = 'idtransfer_request';

    protected $fillable = [
        'request_code',
        'dni',
        'full_name',
        'gender',
        'birth_date',
        'address',
        'previous_school',
        'previous_school_code',
        'origin_grade',
        'requested_idsection',
        'request_date',
        'documents_presented',
        'observations',
        'status',
        'decision_notes',
        'reviewed_by',
        'reviewed_at',
        'idstudent',
        'idenrollment',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'request_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function requestedSection()
    {
        return $this->belongsTo(Section::class, 'requested_idsection', 'idsection');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'iduser');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'idstudent', 'idstudent');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'idenrollment', 'idenrollment');
    }

    public function getStatusNameAttribute(): string
    {
        return match ($this->status) {
            'PENDIENTE' => 'Pendiente',
            'OBSERVADO' => 'Observado',
            'APROBADO' => 'Aprobado',
            'RECHAZADO' => 'Rechazado',
            default => $this->status ?? 'Sin estado',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'PENDIENTE' => 'badge-warning',
            'OBSERVADO' => 'badge-info',
            'APROBADO' => 'badge-success',
            'RECHAZADO' => 'badge-danger',
            default => 'badge-secondary',
        };
    }
}
