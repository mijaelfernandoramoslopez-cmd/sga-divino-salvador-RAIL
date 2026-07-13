<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * HU-14: Validación de documentos académicos.
 * Registra los documentos académicos emitidos para validar su autenticidad.
 */
class AcademicDocument extends Model
{
    use HasFactory;

    protected $table = 'academic_documents';
    protected $primaryKey = 'idacademic_document';

    protected $fillable = [
        'document_code',
        'document_type',
        'source_table',
        'source_id',
        'idstudent',
        'issued_by',
        'issue_date',
        'status',
        'validation_count',
        'last_validated_at',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'last_validated_at' => 'datetime',
        'status' => 'integer',
        'validation_count' => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'idstudent', 'idstudent');
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by', 'iduser');
    }

    public function getDocumentTypeNameAttribute(): string
    {
        return match ($this->document_type) {
            'CONSTANCIA_ESTUDIOS' => 'Constancia de Estudios',
            'CONSTANCIA_NOTAS' => 'Constancia de Notas',
            default => $this->document_type ?? 'Documento académico',
        };
    }

    public function getStatusNameAttribute(): string
    {
        return (int) $this->status === 1 ? 'Válido' : 'Anulado';
    }
}
