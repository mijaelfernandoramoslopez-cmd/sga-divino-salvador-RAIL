<x-layouts.app-layout title="Nueva Constancia de Notas">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-decoration-none" style="color: #005187 !important;">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('gradeCertificates.index') }}" class="text-decoration-none" style="color: #005187 !important;">Constancias de Notas</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0 mb-4" style="min-height:485px; border-top: 4px solid #005187 !important;">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="card-title mb-1 fw-bold" style="color: #005187 !important;">
                        <i class="material-icons align-middle me-2">history_edu</i> Emitir Constancia de Notas
                    </h4>
                    <p class="text-muted small mb-0">Complete la información requerida para registrar y emitir la certificación del estudiante.</p>
                </div>

                <div class="card-body p-4">
                    <div class="alert alert-warning border-0 shadow-sm d-flex align-items-start mb-4" role="alert">
                        <i class="material-icons me-2 mt-1">info</i>
                        <div>
                            <strong>Estimado usuario:</strong> Los campos marcados con un asterisco (<span class="text-danger">*</span>) son obligatorios. La constancia se generará automáticamente con las calificaciones del periodo vigente o más reciente del alumno.
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-start mb-4" role="alert">
                            <i class="material-icons me-2 mt-1">error_outline</i>
                            <div>
                                <strong class="d-block mb-1">Por favor, corrija los siguientes errores:</strong>
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('gradeCertificates.store') }}" method="POST" autocomplete="off">
                        @csrf
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-12 col-lg-8">
                                <div class="form-group">
                                    <label for="idstudent" class="form-label fw-semibold text-dark mb-2">Alumno / Estudiante <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="material-icons" style="font-size: 20px;">school</i></span>
                                        <select name="idstudent" id="idstudent" class="form-select border-start-0 ps-1" required>
                                            <option value="">-- Seleccione un alumno --</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->idstudent }}" {{ old('idstudent') == $student->idstudent ? 'selected' : '' }}>
                                                    {{ $student->full_name }} (DNI: {{ $student->dni }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-text text-secondary mt-1 small">
                                        <i class="material-icons align-middle text-muted" style="font-size: 14px;">gavel</i> Se validará automáticamente que el estudiante cuente con calificaciones en el sistema.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label for="issue_date" class="form-label fw-semibold text-dark mb-2">Fecha de Emisión <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0"><i class="material-icons" style="font-size: 20px;">calendar_today</i></span>
                                        <input type="date" class="form-control border-start-0 ps-1" name="issue_date" id="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="purpose" class="form-label fw-semibold text-dark mb-2">Motivo o Fines de la Constancia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="purpose" id="purpose" value="{{ old('purpose') }}" required maxlength="255" placeholder="Ej: Postulación a beca de estudios, Traslado externo" list="purpose-list">
                                    <datalist id="purpose-list">
                                        <option value="Trámites diversos">
                                        <option value="Postulación a beca de estudios">
                                        <option value="Traslado a otra institución educativa">
                                        <option value="Presentación ante entidad pública">
                                    </datalist>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="observations" class="form-label fw-semibold text-dark mb-2">Observaciones Adicionales <span class="text-muted fw-normal">(Opcional)</span></label>
                                    <textarea class="form-control" name="observations" id="observations" rows="2" maxlength="1000" placeholder="Anotaciones marginales que aparecerán impresas en el documento corporativo">{{ old('observations') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Vista previa dinámica cargada por JS --}}
                        <div id="student-preview" class="d-none border rounded p-4 mb-4 bg-light-subtle">
                            <h5 class="fw-bold mb-3 pb-2 border-bottom d-flex align-items-center" style="color: #005187 !important;">
                                <i class="material-icons me-2">analytics</i> Estructura de Calificaciones a Emitir
                            </h5>
                            
                            <div id="student-preview-alert" class="alert alert-danger border-0 shadow-sm d-none mb-3"></div>
                            <div id="student-preview-warnings" class="alert alert-warning border-0 shadow-sm d-none mb-3"></div>
                            
                            <div id="student-preview-data" class="d-none">
                                <div class="card p-3 border-0 bg-light rounded-3 mb-3 shadow-sm">
                                    <div class="row g-2">
                                        <div class="col-sm-4"><strong>Estudiante:</strong> <span id="pv-name" class="text-dark fw-medium"></span></div>
                                        <div class="col-sm-4"><strong>DNI / ID:</strong> <span id="pv-dni" class="text-muted font-monospace"></span></div>
                                        <div class="col-sm-4"><strong>Periodo Académico:</strong> <span id="pv-period" class="badge text-white px-2 py-1" style="background-color: #005187 !important;"></span></div>
                                    </div>
                                </div>

                                <div class="table-responsive shadow-sm rounded-3">
                                    <table class="table table-hover border align-middle mb-0" style="max-width: 650px;">
                                        <thead>
                                            <tr class="table-light">
                                                <th class="py-3 ps-4 text-dark fw-bold" style="border-bottom: 2px solid #005187 !important;">Área / Curso Curricular</th>
                                                <th class="py-3 text-center text-dark fw-bold" style="width: 150px; border-bottom: 2px solid #005187 !important;">Promedio Obtenido</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pv-courses"></tbody>
                                        <tfoot>
                                            <tr class="bg-light fw-bold border-top">
                                                <td class="text-end py-3 ps-4 text-dark fs-6">Promedio General Ponderado:</td>
                                                <td id="pv-general" class="text-center py-3 fs-6 font-monospace text-white fw-bold" style="background-color: #005187 !important;"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2 border-top pt-4">
                            <button type="submit" id="btn-generate" class="btn text-white px-4 py-2 shadow-sm d-inline-flex align-items-center" style="background-color: #005187 !important;">
                                <i class="material-icons me-1">check_circle</i> Emitir e Imprimir
                            </button>
                            <a class="btn btn-outline-secondary px-4 py-2" href="{{ route('gradeCertificates.index') }}">
                                Cancelar
                            </a>
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
        var studentDataUrl = "{{ url('/constancias-notas/datos-alumno') }}";

        $('#idstudent').on('change', function() {
            var id = $(this).val();
            var $preview = $('#student-preview');
            var $alert = $('#student-preview-alert');
            var $warnings = $('#student-preview-warnings');
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
                    $warnings.addClass('d-none');

                    if (!res.ok) {
                        $alert.text(res.message).removeClass('d-none');
                        $data.addClass('d-none');
                        $btn.prop('disabled', true);
                        return;
                    }

                    $alert.addClass('d-none');
                    $data.removeClass('d-none');
                    $btn.prop('disabled', false);

                    $('#pv-name').text(res.student.full_name);
                    $('#pv-dni').text(res.student.dni);
                    $('#pv-period').text(res.report.period_name || '—');

                    var rows = '';
                    res.report.courses.forEach(function(c) {
                        var avg = (c.average !== null && c.average !== undefined) ? Number(c.average).toFixed(2) : '—';
                        rows += '<tr><td class="ps-4 fw-medium text-dark">' + c.course + '</td><td class="text-center font-monospace">' + avg + '</td></tr>';
                    });
                    $('#pv-courses').html(rows);

                    var general = (res.report.general_average !== null && res.report.general_average !== undefined)
                        ? Number(res.report.general_average).toFixed(2) : '—';
                    $('#pv-general').text(general);

                    if (res.warnings && res.warnings.length > 0) {
                        $warnings.html('<strong>Advertencia del Sistema:</strong> ' + res.warnings.join(' ')).removeClass('d-none');
                    }
                })
                .fail(function() {
                    $preview.removeClass('d-none');
                    $alert.text('No se pudo establecer comunicación con el servidor para obtener los datos del estudiante.').removeClass('d-none');
                    $data.addClass('d-none');
                    $btn.prop('disabled', true);
                });
        });

        if ($('#idstudent').val()) {
            $('#idstudent').trigger('change');
        }
    });
</script>
@endpush

</x-layouts.app-layout>
