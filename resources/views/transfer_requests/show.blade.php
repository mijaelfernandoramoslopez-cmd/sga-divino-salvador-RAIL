<x-layouts.app-layout title="Detalle de Traslado">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            
            {{-- Breadcrumb de navegación optimizado --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-decoration-none" style="color: #005187 !important;">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('transferRequests.index') }}" class="text-decoration-none" style="color: #005187 !important;">Traslados de Ingreso</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>

            {{-- Alertas de Error estilizadas --}}
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center" role="alert">
                    <i class="material-icons me-2">error</i>
                    <div>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Tarjeta Principal de Detalle --}}
            <div class="card shadow-sm border-0 mb-4" style="border-top: 4px solid #005187 !important;">
                
                {{-- Cabecera con Estado de Solicitud --}}
                <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h4 class="card-title mb-1 fw-bold" style="color: #005187 !important;">
                            <i class="material-icons align-middle me-2">assignment</i> Solicitud {{ $transferRequest->request_code }}
                        </h4>
                        <p class="text-muted small mb-0">Expediente completo y registro del proceso de traslado del estudiante.</p>
                    </div>
                    <div>
                        <span class="badge rounded-pill px-3 py-2 border font-monospace {{ $transferRequest->status_badge_class }}" style="font-size: 0.9rem;">
                            {{ $transferRequest->status_name }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    
                    {{-- Bloque de Información usando Grid y List Groups --}}
                    <div class="row g-4 mb-4">
                        
                        {{-- Columna 1: Datos Personales del Estudiante --}}
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-start border-3 h-100" style="border-color: #005187 !important;">
                                <h6 class="text-uppercase fw-bold mb-3 d-flex align-items-center" style="color: #005187; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    <i class="material-icons me-2" style="font-size: 18px;">face</i> Datos del Postulante
                                </h6>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Nombre Completo:</span>
                                        <span class="fw-medium text-dark">{{ $transferRequest->full_name }}</span>
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Documento Nacional de Identidad:</span>
                                        <span class="font-monospace fw-medium text-dark">{{ $transferRequest->dni }}</span>
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Género / Nacimiento:</span>
                                        <span class="text-dark">
                                            {{ $transferRequest->gender == 'M' ? 'Masculino' : 'Femenino' }} 
                                            <span class="text-muted mx-1">|</span> 
                                            <span class="font-monospace">{{ optional($transferRequest->birth_date)->format('d/m/Y') }}</span>
                                        </span>
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Dirección de Domicilio:</span>
                                        <span class="text-dark">{{ $transferRequest->address ?? '-' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Columna 2: Datos de Procedencia y Destino Académico --}}
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-start border-3 h-100" style="border-color: #005187 !important;">
                                <h6 class="text-uppercase fw-bold mb-3 d-flex align-items-center" style="color: #005187; font-size: 0.85rem; letter-spacing: 0.5px;">
                                    <i class="material-icons me-2" style="font-size: 18px;">school</i> Historial Escolar y Destino
                                </h6>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Colegio de Procedencia:</span>
                                        <span class="fw-medium text-dark">{{ $transferRequest->previous_school }}</span>
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Cód. Modular / Grado Origen:</span>
                                        <span class="text-dark font-monospace">{{ $transferRequest->previous_school_code ?? '-' }} / {{ $transferRequest->origin_grade ?? '-' }}</span>
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 py-2 d-flex justify-content-between flex-wrap">
                                        <span class="text-secondary small">Sección Solicitada:</span>
                                        <span class="text-dark text-end">
                                            @php
                                                $section = $transferRequest->requestedSection;
                                                $course = $section?->course;
                                            @endphp
                                            @if($section)
                                                <span class="fw-medium">Sección {{ $section->section_name }}</span><br>
                                                <small class="text-muted text-xs d-block">
                                                    {{ $course?->degree?->degree_name ?? 'Nivel N/A' }} — 
                                                    {{ $course?->subgrade?->subgrade_name ?? 'Grado N/A' }}
                                                </small>
                                                <small class="text-muted font-monospace text-xs">
                                                    {{ $course?->semester?->period?->period_name ?? 'Periodo N/A' }}
                                                </small>
                                            @else
                                                <span class="text-muted italic">No especificada</span>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Bloque Inferior: Detalles de Expediente y Gestión Interna --}}
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card border border-light-subtle bg-white rounded-3 shadow-none">
                                <div class="card-body p-3">
                                    <h6 class="text-secondary text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.5px;">Detalles del Expediente</h6>
                                    
                                    <div class="mb-3">
                                        <label class="text-muted small d-block mb-1">Fecha de Ingreso de Solicitud:</label>
                                        <span class="font-monospace text-dark">{{ optional($transferRequest->request_date)->format('d/m/Y') }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-muted small d-block mb-1">Documentos Presentados:</label>
                                        <span class="text-dark fw-medium">{{ $transferRequest->documents_presented }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-muted small d-block mb-1">Observaciones Iniciales:</label>
                                        <p class="text-secondary bg-light p-2.5 rounded border mb-0" style="font-size: 0.95rem;">{{ $transferRequest->observations ?? '-' }}</p>
                                    </div>

                                    <div class="mb-2">
                                        <label class="text-muted small d-block mb-1">Resolución de Revisión / Dictamen:</label>
                                        <div class="p-3 bg-light rounded border border-start border-secondary-subtle">
                                            <p class="text-dark mb-2 fw-medium">{{ $transferRequest->decision_notes ?? 'Sin notas de decisión registradas.' }}</p>
                                            <small class="text-muted d-block">
                                                <i class="material-icons align-middle me-1" style="font-size: 14px;">verified_user</i> 
                                                Revisado por: <span class="fw-medium">{{ $transferRequest->reviewer->username ?? '-' }}</span>
                                                @if($transferRequest->reviewed_at)
                                                    el {{ $transferRequest->reviewed_at->format('d/m/Y H:i') }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>

                                    {{-- Alumno Vinculado (Si aplica) --}}
                                    @if($transferRequest->student)
                                        <div class="mt-4 p-3 border rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="background-color: #f4f9fc; border-color: #bce0fd !important;">
                                            <div class="d-flex align-items-center">
                                                <i class="material-icons me-3 text-success" style="font-size: 32px;">check_circle</i>
                                                <div>
                                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Estudiante Matriculado en Sistema</small>
                                                    <span class="fw-bold text-dark" style="font-size: 1.05rem;">{{ $transferRequest->student->full_name }}</span>
                                                </div>
                                            </div>
                                            <a href="{{ route('students.show', $transferRequest->student->idstudent) }}" class="btn btn-sm text-white px-3" style="background-color: #005187 !important;">
                                                <i class="material-icons align-middle me-1" style="font-size: 16px;">launch</i> Ver Perfil Alumno
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Pie de Tarjeta con Flujo de Acciones Limpias --}}
                <div class="card-footer bg-white border-top p-4 d-flex justify-content-between flex-wrap gap-2">
                    <a href="{{ route('transferRequests.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center px-4 py-2">
                        <i class="material-icons me-1">arrow_back</i> Volver al Listado
                    </a>

                    @if($transferRequest->status !== 'APROBADO')
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('transferRequests.observe.form', $transferRequest->idtransfer_request) }}" class="btn btn-warning text-dark d-inline-flex align-items-center px-3 py-2 fw-medium">
                                <i class="material-icons me-1">rate_review</i> Observar
                            </a>
                            <a href="{{ route('transferRequests.reject.form', $transferRequest->idtransfer_request) }}" class="btn btn-danger text-white d-inline-flex align-items-center px-3 py-2 fw-medium">
                                <i class="material-icons me-1">close</i> Rechazar
                            </a>
                            <a href="{{ route('transferRequests.approve.form', $transferRequest->idtransfer_request) }}" class="btn btn-success text-white d-inline-flex align-items-center px-4 py-2 fw-medium shadow-sm">
                                <i class="material-icons me-1">check</i> Aprobar Traslado
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

</x-layouts.app-layout>