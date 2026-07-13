<x-layouts.app-layout title="Registrar Traslado de Ingreso">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            
            {{-- Breadcrumb de navegación optimizado --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-custom-blue">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('transferRequests.index') }}" class="text-decoration-none text-custom-blue">Traslados de Ingreso</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Registrar Solicitud</li>
                </ol>
            </nav>

            {{-- Tarjeta Contenedora Principal usando tus estilos del colegio --}}
            <div class="card shadow-sm border-0 mb-4" style="min-height:485px; border-top: 4px solid #005187 !important;">
                
                {{-- Cabecera con título e información --}}
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="card-title mb-1 fw-bold text-custom-blue">
                        <i class="material-icons align-middle me-2">swap_horiz</i> Registrar Solicitud de Traslado de Ingreso
                    </h4>
                    <p class="text-muted small mb-0">Gestión de expedientes de alumnos procedentes de otras instituciones educativas.</p>
                </div>

                <div class="card-body p-4">
                    
                    {{-- Alerta informativa unificada en Bootstrap 5 --}}
                    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4" role="alert" style="background-color: #f4f9fc;">
                        <i class="material-icons text-info me-3">info</i>
                        <div class="small text-dark">
                            <strong>Nota del sistema:</strong> Este módulo registra alumnos externos hacia nuestra institución. La matrícula formal se generará automáticamente de manera posterior, únicamente cuando la solicitud sea evaluada y aprobada por la dirección.
                        </div>
                    </div>

                    <form action="{{ route('transferRequests.store') }}" method="POST" autocomplete="off">
                        @csrf

                        {{-- Navegación por Tabs (Pestañas) utilizando tus estilos nav-pills --}}
                        <ul class="nav nav-pills mb-4 bg-light p-1 rounded-3" id="transferTabs" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active d-flex align-items-center justify-content-center py-2" id="student-tab" data-bs-toggle="tab" data-bs-target="#student-content" type="button" role="tab" aria-controls="student-content" aria-selected="true">
                                    <i class="material-icons me-2" style="font-size: 18px;">person</i> 1. Datos del Estudiante
                                </button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 d-flex align-items-center justify-content-center py-2" id="transfer-tab" data-bs-toggle="tab" data-bs-target="#transfer-content" type="button" role="tab" aria-controls="transfer-content" aria-selected="false">
                                    <i class="material-icons me-2" style="font-size: 18px;">school</i> 2. Datos del Traslado e Historial
                                </button>
                            </li>
                        </ul>

                        {{-- Contenido de las Pestañas --}}
                        <div class="tab-content" id="transferTabsContent">
                            
                            {{-- PESTAÑA 1: DATOS DEL ESTUDIANTE --}}
                            <div class="tab-pane fade show active" id="student-content" role="tabpanel" aria-labelledby="student-tab">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium">DNI <span class="text-danger">*</span></label>
                                        <input type="text" name="dni" maxlength="8" class="form-control border-secondary-subtle" value="{{ old('dni') }}" required onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" placeholder="Ingrese 8 dígitos">
                                        @error('dni') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label fw-medium">Nombre completo <span class="text-danger">*</span></label>
                                        <input type="text" name="full_name" class="form-control border-secondary-subtle" value="{{ old('full_name') }}" required placeholder="Apellidos y Nombres">
                                        @error('full_name') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium">Género <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-select border-secondary-subtle" required>
                                            <option value="">Seleccionar...</option>
                                            <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino</option>
                                            <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                        @error('gender') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium">Fecha de nacimiento <span class="text-danger">*</span></label>
                                        <input type="date" name="birth_date" class="form-control border-secondary-subtle" value="{{ old('birth_date') }}" required>
                                        @error('birth_date') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-medium">Fecha de solicitud <span class="text-danger">*</span></label>
                                        <input type="date" name="request_date" class="form-control border-secondary-subtle" value="{{ old('request_date', date('Y-m-d')) }}" required>
                                        @error('request_date') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-md-12">
                                        <label class="form-label fw-medium">Dirección Domiciliaria</label>
                                        <input type="text" name="address" class="form-control border-secondary-subtle" value="{{ old('address') }}" placeholder="Av., Jr., Calle y Número de vivienda">
                                        @error('address') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-outline-colegio px-4 py-2" onclick="document.getElementById('transfer-tab').click();">
                                        Siguiente Sección <i class="material-icons align-middle ms-1" style="font-size: 18px;">arrow_forward</i>
                                    </button>
                                </div>
                            </div>

                            {{-- PESTAÑA 2: DATOS DEL TRASLADO --}}
                            <div class="tab-pane fade" id="transfer-content" role="tabpanel" aria-labelledby="transfer-tab">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Colegio de procedencia <span class="text-danger">*</span></label>
                                        <input type="text" name="previous_school" class="form-control border-secondary-subtle" value="{{ old('previous_school') }}" required placeholder="Nombre de la Institución de Origen">
                                        @error('previous_school') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-medium">Código modular de I.E.</label>
                                        <input type="text" name="previous_school_code" class="form-control border-secondary-subtle" value="{{ old('previous_school_code') }}" placeholder="Ej.: 1452398">
                                        @error('previous_school_code') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-medium">Grado de procedencia</label>
                                        <input type="text" name="origin_grade" class="form-control border-secondary-subtle" value="{{ old('origin_grade') }}" placeholder="Ej.: 2° Grado de Primaria">
                                        @error('origin_grade') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-medium">Sección / Vacante solicitada en nuestra institución</label>
                                        <select name="requested_idsection" class="form-select border-secondary-subtle">
                                            <option value="">Sin sección definida todavía (Evaluación por vacante)</option>
                                            @foreach($sections as $section)
                                                @php
                                                    $course = $section->course;
                                                    $label = 'Sección ' . $section->section_name;
                                                    if ($course) {
                                                        $label .= ' / ' . ($course->degree->degree_name ?? 'Nivel');
                                                        $label .= ' / ' . ($course->subgrade->subgrade_name ?? 'Grado');
                                                        $label .= ' / ' . ($course->semester->period->period_name ?? 'Periodo');
                                                    }
                                                @endphp
                                                <option value="{{ $section->idsection }}" {{ old('requested_idsection') == $section->idsection ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('requested_idsection') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Documentos presentados <span class="text-danger">*</span></label>
                                        <textarea name="documents_presented" class="form-control border-secondary-subtle" rows="4" required placeholder="Detalle los documentos entregados. Ej.: Ficha Única de Matrícula (SIAGIE), Constancia de Vacante, Libreta de notas original, Copia de DNI del alumno y apoderado.">{{ old('documents_presented') }}</textarea>
                                        @error('documents_presented') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Observaciones internas</label>
                                        <textarea name="observations" class="form-control border-secondary-subtle" rows="4" placeholder="Anotaciones adicionales sobre el estado físico del expediente o compromisos del apoderado.">{{ old('observations') }}</textarea>
                                        @error('observations') <div class="form-text text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                {{-- Botonera inferior derecha de control final --}}
                                <div class="border-top pt-4 mt-4 d-flex justify-content-end gap-2">
                                    <a href="{{ route('transferRequests.index') }}" class="btn btn-outline-danger px-4 py-2">
                                        <i class="material-icons align-middle me-1" style="font-size: 18px;">cancel</i> Cancelar
                                    </a>
                                    <button type="submit" class="btn text-white px-4 py-2 shadow-sm fw-medium bg-colegio">
                                        <i class="material-icons align-middle me-1" style="font-size: 18px;">save</i> Guardar Solicitud
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</x-layouts.app-layout>