<x-layouts.app-layout title="Validar Documento Académico">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-decoration-none text-custom-blue">Panel Control</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Validación de Documentos Académicos</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-colegio" style="min-height:485px">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="card-title mb-1 fw-bold text-custom-blue">
                        <i class="material-icons align-middle me-1">verified_user</i> Validación de Documentos Académicos
                    </h4>
                    <p class="text-muted small mb-0">
                        Consulta si una constancia fue emitida por el sistema ingresando el código que aparece en el documento.
                    </p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('academicDocuments.validate') }}" method="POST" autocomplete="off" class="mb-4">
                        @csrf

                        <div class="row g-3 align-items-end">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-dark mb-2">Código de validación <span class="text-custom-blue">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-colegio"><i class="material-icons style-18">qr_code</i></span>
                                        <input
                                            type="text"
                                            name="document_code"
                                            class="form-control border-colegio @error('document_code') is-invalid @enderror"
                                            value="{{ old('document_code', $documentCode ?? '') }}"
                                            placeholder="Ej: CONST-2026-XXXX"
                                            required
                                        >
                                    </div>
                                    @error('document_code')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn bg-colegio shadow-sm w-100 py-2">
                                    <i class="material-icons align-middle me-1">search</i> Validar documento
                                </button>
                            </div>
                        </div>
                    </form>

                    @isset($documentCode)
                        <div class="py-2">
                            <hr class="text-muted opacity-25 my-4">

                            @if(isset($document) && $document)
                                
                                @if((int) $document->status === 1)
                                    <div class="alert alert-success d-flex align-items-center border-0 shadow-sm mb-4" role="alert">
                                        <i class="material-icons me-2">check_circle</i>
                                        <div>
                                            <strong>Documento válido.</strong> El código ingresado pertenece a un documento académico emitido legítimamente por el sistema.
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning d-flex align-items-center border-0 shadow-sm mb-4" role="alert">
                                        <i class="material-icons me-2">warning</i>
                                        <div>
                                            <strong>Documento anulado.</strong> El código existe en nuestros registros, pero el documento ya no se encuentra vigente.
                                        </div>
                                    </div>
                                @endif

                                <div class="card border border-colegio shadow-sm mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="mb-0 fw-bold text-custom-blue d-flex align-items-center">
                                            <i class="material-icons me-2">description</i> Detalles del Documento Encontrado
                                        </h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4" style="width: 250px;">Código único</th>
                                                    <td class="font-monospace fw-bold text-custom-blue">{{ $document->document_code }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4">Tipo de documento</th>
                                                    <td>{{ $document->document_type_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4">Estudiante</th>
                                                    <td class="fw-semibold text-dark">{{ $document->student->full_name ?? 'No registrado' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4">Documento de Identidad (DNI)</th>
                                                    <td>{{ $document->student->dni ?? 'No registrado' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4">Fecha de emisión</th>
                                                    <td>{{ optional($document->issue_date)->format('d/m/Y') ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4">Estado actual</th>
                                                    <td>
                                                        <span class="badge {{ (int) $document->status === 1 ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                                            {{ $document->status_name }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-dark fw-bold ps-4">Consultas realizadas</th>
                                                    <td>
                                                        <span class="badge bg-light text-dark border px-3 py-2 fw-normal">
                                                            {{ $document->validation_count }} veces consultado
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if((int) $document->status === 1)
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('academicDocuments.view', $document->document_code) }}" class="btn btn-success text-white px-4 py-2 shadow-sm d-inline-flex align-items-center" target="_blank">
                                            <i class="material-icons me-2">visibility</i> Ver / Descargar Documento
                                        </a>
                                    </div>
                                @endif

                            @else
                                <div class="alert alert-danger d-flex align-items-center border-0 shadow-sm" role="alert">
                                    <i class="material-icons me-2">error</i>
                                    <div>
                                        <strong>Documento no encontrado.</strong> El código ingresado no corresponde a ningún documento académico registrado en nuestra base de datos. Por favor, verifique la escritura.
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.app-layout>