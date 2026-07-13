<x-layouts.app-layout title="Nueva Constancia">

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
                        <a href="{{ route('certificates.index') }}" class="text-decoration-none" style="color: #005187 !important;">Constancias</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva</li>
                </ol>
            </nav>

            {{-- Tarjeta Contenedora Principal --}}
            <div class="card shadow-sm border-0 mb-4" style="min-height:485px; border-top: 4px solid #005187 !important;">
                
                {{-- Cabecera estilizada --}}
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="card-title mb-1 fw-bold" style="color: #005187 !important;">
                        <i class="material-icons align-middle me-2">description</i> Generar Constancia de Estudios
                    </h4>
                    <p class="text-muted small mb-0">Emisión formal de documentos académicos con verificación automatizada de matrícula activa.</p>
                </div>

                <div class="card-body p-4">
                    
                    {{-- Mensaje Informativo Remodelado --}}
                    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4" role="alert" style="background-color: #f4f9fc;">
                        <i class="material-icons text-info me-2">info</i>
                        <div class="small text-dark">
                            <strong>Indicación:</strong> Los campos marcados con un asterisco (<span class="text-danger">*</span>) son de carácter obligatorio.
                        </div>
                    </div>

                    {{-- Alertas de Errores Críticos --}}
                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center mb-1">
                                <i class="material-icons me-2">error</i>
                                <strong>Por favor, corrija los siguientes inconvenientes:</strong>
                            </div>
                            <ul class="mb-0 ps-4 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('certificates.store') }}" method="POST" autocomplete="off">
                        @csrf
                        
                        {{-- Primera Fila de Inputs (Grid de Bootstrap 5) --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-12 col-lg-8">
                                <div class="mb-1">
                                    <label for="idstudent" class="form-label fw-medium text-dark">Estudiante Postulante <span class="text-danger">*</span></label>
                                    <select name="idstudent" id="idstudent" class="form-select border-secondary-subtle" required style="--bs-focus-ring-color: rgba(0, 81, 135, 0.25);">
                                        <option value="">-- Busque o seleccione un alumno --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->idstudent }}" {{ old('idstudent') == $student->idstudent ? 'selected' : '' }}>
                                                {{ $student->full_name }} (DNI: {{ $student->dni }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted mt-1 small">
                                        <i class="material-icons align-middle text-warning" style="font-size: 14px;">gavel</i> Se validará que el alumno cuente con matrícula vigente en el periodo lectivo.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="mb-1">
                                    <label class="form-label fw-medium text-dark">Fecha de Emisión <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control border-secondary-subtle" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- Segunda Fila de Inputs --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label fw-medium text-dark">Motivo / Fines de la Constancia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control border-secondary-subtle" name="purpose" value="{{ old('purpose') }}" required maxlength="255" placeholder="Ejm: Trámites de beca escolar o seguro médico" list="purpose-list">
                                    <datalist id="purpose-list">
                                        <option value="Trámites diversos">
                                        <option value="Trámites de beca escolar">
                                        <option value="Traslado a otra institución educativa">
                                        <option value="Presentación ante entidad pública">
                                        <option value="Sustento de programas sociales">
                                    </datalist>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="mb-1">
                                    <label class="form-label fw-medium text-dark">Observaciones adicionales <span class="text-muted">(Opcional)</span></label>
                                    <textarea class="form-control border-secondary-subtle" name="observations" rows="2" maxlength="1000" placeholder="Anote cualquier especificación que deba figurar al pie del documento">{{ old('observations') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Sección Dinámica: Visualización Previa de Datos del Estudiante (HU-12.8) --}}
                        <div id="student-preview" class="d-none border-top pt-4 mt-4">
                            <div class="card shadow-none bg-light border-0 mb-3">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-3 d-flex align-items-center" style="color: #005187 !important;">
                                        <i class="material-icons me-2">fact_check</i> Datos Estructurales del Documento
                                    </h5>
                                    
                                    {{-- Alerta de Error de Validación Ajax --}}
                                    <div id="student-preview-alert" class="alert alert-danger border-0 shadow-sm d-none small"></div>
                                    
                                    {{-- List Group Adaptivo y Limpio --}}
                                    <div id="student-preview-data" class="d-none" style="max-width: 750px;">
                                        <ul class="list-group list-group-flush rounded-3 border">
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2.5 flex-wrap">
                                                <span class="text-secondary small fw-medium">Estudiante:</span>
                                                <span class="fw-bold text-dark" id="pv-name">—</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2.5 flex-wrap">
                                                <span class="text-secondary small fw-medium">Documento Nacional de Identidad (DNI):</span>
                                                <span class="font-monospace text-dark" id="pv-dni">—</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2.5 flex-wrap">
                                                <span class="text-secondary small fw-medium">Nivel Escolar / Grado:</span>
                                                <span class="text-dark fw-medium" id="pv-degree">—</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2.5 flex-wrap">
                                                <span class="text-secondary small fw-medium">Sección Asignada:</span>
                                                <span class="badge bg-secondary rounded-pill" id="pv-section">—</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2.5 flex-wrap">
                                                <span class="text-secondary small fw-medium">Periodo Académico Actual:</span>
                                                <span class="text-dark font-monospace" id="pv-period">—</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Panel de Acciones Finales Inferiores --}}
                        <div class="border-top pt-4 mt-4 d-flex justify-content-end gap-2">
                            <a class="btn btn-outline-danger px-4 py-2" href="{{ route('certificates.index') }}">
                                <i class="material-icons align-middle me-1" style="font-size: 18px;">cancel</i> Cancelar
                            </a>
                            <button type="submit" id="btn-generate" class="btn text-white px-4 py-2 shadow-sm fw-medium" style="background-color: #005187 !important;">
                                <i class="material-icons align-middle me-1" style="font-size: 18px;">task_alt</i> Generar Constancia
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var studentDataUrl = "{{ url('/constancias/datos-alumno') }}";

        $('#idstudent').on('change', function() {
            var id = $(this).val();
            var $preview = $('#student-preview');
            var $alert = $('#student-preview-alert');
            var $data = $('#student-preview-data');
            var $btn = $('#btn-generate');

            if (!id) {
                $preview.addClass('d-none');
                $btn.prop('disabled', false);
                return;
            }

            $.get(studentDataUrl + '/' + id)
                .done(function(res) {
                    $preview.removeClass('d-none');

                    if (!res.ok) {
                        $alert.text(res.message).removeClass('d-none');
                        $data.addClass('d-none');
                        $btn.prop('disabled', true);
                        return;
                    }

                    $alert.addClass('d-none');
                    $data.removeClass('d-none');
                    $btn.prop('disabled', false);

                    var degree = (res.academic.degree || '—');
                    if (res.academic.subgrade) degree += ' — ' + res.academic.subgrade;

                    $('#pv-name').text(res.student.full_name);
                    $('#pv-dni').text(res.student.dni);
                    $('#pv-degree').text(degree);
                    $('#pv-section').text(res.academic.section || '—');
                    $('#pv-period').text(res.academic.period || '—');
                })
                .fail(function() {
                    $preview.removeClass('d-none');
                    $alert.text('No se pudo obtener la información del alumno de forma correcta.').removeClass('d-none');
                    $data.addClass('d-none');
                    $btn.prop('disabled', true);
                });
        });

        // Si viene de una validación fallida en el servidor mantiene el estado del preview
        if ($('#idstudent').val()) {
            $('#idstudent').trigger('change');
        }
    });
</script>
@endpush

</x-layouts.app-layout>