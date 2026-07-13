<x-layouts.app-layout title="Resumen de Calificaciones">
    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
                <nav aria-label="breadcrumb" class="mb-0">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Calificaciones</li>
                    </ol>
                </nav>
                <a href="{{ route('grades.create') }}" class="btn d-inline-flex align-items-center gap-1 shadow-sm px-3 py-2 rounded-2 text-white" style="background-color: #005187;">
                    <i class="material-icons">add_circle</i>
                    <span class="fw-bold small">Registrar Nuevas Notas</span>
                </a>
            </div>

            <div class="mb-4">
                <h3 class="fw-bold mb-1" style="color: #005187;">
                    <i class="material-icons align-middle fs-3 me-1">analytics</i> Control y Rendimiento de Calificaciones
                </h3>
                <p class="text-muted small mb-0">Auditoría global de promedios ponderados por aula y edición directa de actas consolidadas.</p>
            </div>

            @if($grades->count() > 0)
                
                <div class="card border-0 shadow-sm p-4 mb-4 bg-light rounded-3">
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons me-2 fs-5" style="color: #005187;">tune</i>
                        <span class="fw-bold small text-uppercase text-secondary" style="letter-spacing: 0.5px;">Buscador Inteligente de Actas</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <label class="form-label text-muted small fw-bold">Periodo</label>
                            <select class="form-select border-secondary-subtle shadow-sm" id="adminFilterPeriod" onchange="filterAdminGrades()">
                                <option value="">Todos</option>
                                @foreach($grades->unique('period_name') as $g)
                                    <option value="{{ Str::slug($g->period_name) }}">{{ $g->period_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <label class="form-label text-muted small fw-bold">Grado</label>
                            <select class="form-select border-secondary-subtle shadow-sm" id="adminFilterDegree" onchange="filterAdminGrades()">
                                <option value="">Todos</option>
                                @foreach($grades->unique('degree_name') as $g)
                                    <option value="{{ Str::slug($g->degree_name) }}">{{ $g->degree_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <label class="form-label text-muted small fw-bold">Sub Grado</label>
                            <select class="form-select border-secondary-subtle shadow-sm" id="adminFilterSubgrade" onchange="filterAdminGrades()">
                                <option value="">Todos</option>
                                @foreach($grades->whereNotNull('subgrade_name')->unique('subgrade_name') as $g)
                                    <option value="{{ Str::slug($g->subgrade_name) }}">{{ $g->subgrade_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <label class="form-label text-muted small fw-bold">Sección</label>
                            <select class="form-select border-secondary-subtle shadow-sm" id="adminFilterSection" onchange="filterAdminGrades()">
                                <option value="">Todos</option>
                                @foreach($grades->unique('section_name') as $g)
                                    <option value="{{ Str::slug($g->section_name) }}">{{ $g->section_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="form-label text-muted small fw-bold">Curso / Asignatura</label>
                            <select class="form-select border-secondary-subtle shadow-sm" id="adminFilterCourse" onchange="filterAdminGrades()">
                                <option value="">Todos los Cursos</option>
                                @foreach($grades->unique('course_name') as $g)
                                    <option value="{{ Str::slug($g->course_name) }}">{{ $g->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row g-4" id="adminGradesGrid">
                    @foreach ($grades as $g)
                        @php
                            // Alerta visual de rendimiento (menor a 11 se considera desaprobado)
                            $isDanger = $g->section_average < 11;
                            $badgeColor = $isDanger ? 'bg-danger-subtle text-danger border-danger' : 'bg-success-subtle text-success border-success';
                        @endphp
                        
                        <div class="col-md-6 col-lg-4 admin-grade-card-item"
                             data-period="{{ Str::slug($g->period_name) }}"
                             data-degree="{{ Str::slug($g->degree_name) }}"
                             data-subgrade="{{ Str::slug($g->subgrade_name ?? 'na') }}"
                             data-section="{{ Str::slug($g->section_name) }}"
                             data-course="{{ Str::slug($g->course_name) }}">
                            
                            <div class="card h-100 shadow-sm border border-light-subtle rounded-3 overflow-hidden"
                                 style="transition: transform 0.2s ease, box-shadow 0.2s ease;"
                                 onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 .5rem 1rem rgba(0,0,0,.08)'"
                                 onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                                
                                <div class="card-header bg-white pt-3 pb-2 px-3 border-0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-light text-dark border px-2 py-1 small fw-semibold">
                                            {{ $g->period_name }}
                                        </span>
                                        <span class="badge text-white px-2 py-1 small" style="background-color: #005187;">
                                            Sección: {{ $g->section_name }}
                                        </span>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1 text-truncate" title="{{ $g->course_name }}">
                                        {{ $g->course_name }}
                                    </h5>
                                    <p class="text-muted small mb-0 d-flex align-items-center gap-1" style="font-size: 13px;">
                                        <i class="material-icons text-secondary fs-6">school</i> 
                                        {{ $g->degree_name }} <span class="text-secondary-subtle">|</span> {{ $g->subgrade_name ?? 'N/A' }}
                                    </p>
                                </div>

                                <div class="card-body py-2 px-3">
                                    <div class="p-3 rounded-3 bg-light border border-light-subtle">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="small text-muted fw-bold">Desglose de Promedios</span>
                                            <span class="badge bg-dark rounded-1 d-flex align-items-center gap-1 px-2 py-0.5" style="font-size: 11px;">
                                                <i class="material-icons fs-6">groups</i> {{ $g->total_students }} Alumnos
                                            </span>
                                        </div>

                                        <div class="row g-2 text-center mb-3">
                                            <div class="col-6 border-end">
                                                <small class="text-muted d-block" style="font-size: 11px;">Prom. Prácticas</small>
                                                <span class="fw-bold text-dark fs-6">{{ $g->avg_practica ?? '0.00' }}</span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block" style="font-size: 11px;">Prom. Exámenes</small>
                                                <span class="fw-bold text-dark fs-6">{{ $g->avg_examen ?? '0.00' }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center p-2 rounded-2 border {{ $badgeColor }}">
                                            <span class="small fw-bold">Promedio General del Aula</span>
                                            <span class="fs-5 fw-bold px-2.5 rounded">{{ $g->section_average }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-light py-2.5 px-3 border-top-0 d-flex gap-2">
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-warning w-100 d-flex align-items-center justify-content-center gap-1 btn-edit-grades rounded-2 py-1.5 fw-bold"
                                            data-section="{{ $g->idsection }}"
                                            data-course="{{ $g->idcourse }}"
                                            data-section-name="{{ $g->section_name }}"
                                            data-course-name="{{ $g->course_name }}">
                                        <i class="material-icons fs-5">edit_note</i> Administrar Calificaciones
                                    </button>
                                    <button type="button" 
                                        class="btn btn-sm text-white grow d-flex align-items-center justify-content-center gap-1 btn-view-averages rounded-2 py-1.5 fw-bold"
                                        style="background-color: #005187;"
                                        data-section="{{ $g->idsection }}"
                                        data-course="{{ $g->idcourse }}"
                                        data-section-name="{{ $g->section_name }}"
                                        data-course-name="{{ $g->course_name }}">
                                    <i class="material-icons fs-5">analytics</i> Ver Promedios
                                </button>

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <div class="alert alert-info border-0 shadow-sm d-flex align-items-center p-4 rounded-3" role="alert">
                    <i class="material-icons text-info me-3 fs-2">info</i>
                    <div>
                        <h5 class="fw-bold mb-1">No hay calificaciones registradas</h5>
                        <p class="mb-0 text-muted small">Actualmente no existen actas cargadas en el sistema para ningún periodo académico activo.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <div class="modal fade" id="editGradeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <!-- CORREGIDO: El formulario ahora toma el rol de modal-content -->
        <form action="{{ route('grades.update') }}" method="POST" id="formEditGrades" class="modal-content">
            @csrf
            <input type="hidden" name="idsection" id="edit_hidden_section">
            <input type="hidden" name="idcourse" id="edit_hidden_course">

            <div class="modal-header" style="background-color: #005187;">
                <h5 class="modal-title text-white">
                    <i class="material-icons align-middle">edit</i>
                    EDITAR CALIFICACIONES: <span id="edit_span_seccion" class="fw-bold"></span>
                    <br><small id="edit_span_curso"></small>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipo de Evaluación</label>
                        <select name="idevaluation_type" id="edit_evaluation_type" class="form-select" style="border-color: #005187;" required>
                            <option value="">-- Seleccione --</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaEditGradesModal">
                        <thead class="table-light">
                            <tr>
                                <th width="80">FOTO</th>
                                <th>ALUMNO</th>
                                <th width="180">CALIFICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center">Seleccione un tipo de evaluación</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                <button type="submit" class="btn text-white px-4" style="background-color: #005187;">ACTUALIZAR NOTAS</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL VER PROMEDIOS POR ALUMNO -->
<div class="modal fade" id="viewAveragesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #005187;">
                <h5 class="modal-title text-white d-flex align-items-center gap-2">
                    <i class="material-icons align-middle">analytics</i>
                    PROMEDIOS CONSOLIDADOS: <span id="view_span_seccion" class="fw-bold"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="p-2 mb-3 bg-light rounded-3 border">
                    <span class="text-muted small fw-bold d-block">Curso / Asignatura:</span>
                    <h6 class="fw-bold text-dark mb-0" id="view_span_curso"></h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden" id="tablaViewAveragesModal">
                        <thead class="table-light text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                            <tr>
                                <th width="80">Foto</th>
                                <th>Alumno</th>
                                <th width="100" class="text-center">Práctica</th>
                                <th width="100" class="text-center">Examen</th>
                                <th width="100" class="text-center">Trabajo</th>
                                <th width="100" class="text-center">Final</th>
                                <th width="120" class="text-center">Prom. Gral</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contenido dinámico mediante AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary px-4 rounded-2 fw-bold btn-sm" data-bs-dismiss="modal">CERRAR VENTANA</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function filterAdminGrades() {
        let period = document.getElementById('adminFilterPeriod').value;
        let degree = document.getElementById('adminFilterDegree').value;
        let subgrade = document.getElementById('adminFilterSubgrade').value;
        let section = document.getElementById('adminFilterSection').value;
        let course = document.getElementById('adminFilterCourse').value;

        let cards = document.querySelectorAll('.admin-grade-card-item');

        cards.forEach(card => {
            let cardPeriod = card.getAttribute('data-period');
            let cardDegree = card.getAttribute('data-degree');
            let cardSubgrade = card.getAttribute('data-subgrade');
            let cardSection = card.getAttribute('data-section');
            let cardCourse = card.getAttribute('data-course');

            let matchPeriod = (period === "" || cardPeriod === period);
            let matchDegree = (degree === "" || cardDegree === degree);
            let matchSubgrade = (subgrade === "" || cardSubgrade === subgrade);
            let matchSection = (section === "" || cardSection === section);
            let matchCourse = (course === "" || cardCourse === course);

            if (matchPeriod && matchDegree && matchSubgrade && matchSection && matchCourse) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    }

    let activeSection = null;
    let activeCourse = null;
</script>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            retrieve: true, 
            paging: true
        });
    });
</script>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const editModal = new bootstrap.Modal('#editGradeModal');

        // ABRIR MODAL
        $('.btn-edit-grades').on('click', function() {
            const idsection = $(this).data('section');
            const idcourse = $(this).data('course');
            const sectionName = $(this).data('section-name');
            const courseName = $(this).data('course-name');

            // SETEAMOS
            $('#edit_hidden_section').val(idsection);
            $('#edit_hidden_course').val(idcourse);
            $('#edit_span_seccion').text(sectionName);
            $('#edit_span_curso').text(courseName);

            // LIMPIAMOS TABLA
            $('#tablaEditGradesModal tbody').html(`<tr><td colspan="3" class="text-center">Seleccione un tipo de evaluación</td></tr>`);

            // CARGAR TIPOS EVALUACIÓN
            $.get("{{ route('grades.getEvaluationTypes') }}", function(data) {
                let select = $('#edit_evaluation_type').empty().append(`<option value="">-- Seleccione --</option>`);
                data.forEach(item => {
                    select.append(`<option value="${item.idevaluation_type}">${item.evaluation_name}</option>`);
                });
            });

            editModal.show();
        });

        // CAMBIO DE TIPO EVALUACIÓN
        $('#edit_evaluation_type').on('change', function() {
            const idevaluation_type = $(this).val();
            const idsection = $('#edit_hidden_section').val();
            const idcourse = $('#edit_hidden_course').val();
            let tbody = $('#tablaEditGradesModal tbody');

            tbody.html(`<tr><td colspan="3" class="text-center py-4">Cargando alumnos...</td></tr>`);

            $.get("{{ route('grades.getEditData') }}", {
                idsection: idsection,
                idcourse: idcourse,
                idevaluation_type: idevaluation_type
            }, function(data) {
                tbody.empty();

                if(data.length === 0) {
                    tbody.html(`<tr><td colspan="3" class="text-center">No hay alumnos registrados.</td></tr>`);
                    return;
                }

                data.forEach(alumno => {
                    let foto = alumno.photo ? `/backend/img/subidas/${alumno.photo}` : `/backend/img/user-default.png`;
                    tbody.append(`
                        <tr>
                            <td><img src="${foto}" width="45" height="45" class="rounded-circle shadow-sm" onerror="this.src='/backend/img/user-default.png'"></td>
                            <td>${alumno.full_name}</td>
                            <td><input type="number" step="0.01" min="0" max="20" class="form-control" name="notas[${alumno.idstudent}]" value="${alumno.grade ?? ''}"></td>
                        </tr>
                    `);
                });
            });
        });

        // UPDATE
        $('#formEditGrades').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                success: function(response) {
                    editModal.hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado',
                        text: 'Las notas fueron actualizadas.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => { location.reload(); });
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudieron actualizar las notas.' });
                }
            });
        });
    });
</script>

@endpush

@push('scripts')
<script>
$(document).ready(function() {
// ABRIR MODAL DE PROMEDIOS CONSOLIDADOS
const viewAveragesModal = new bootstrap.Modal('#viewAveragesModal');

$('.btn-view-averages').on('click', function() {
    const idsection = $(this).data('section');
    const idcourse = $(this).data('course');
    const sectionName = $(this).data('section-name');
    const courseName = $(this).data('course-name');

    // Inicializar textos de cabecera
    $('#view_span_seccion').text(sectionName);
    $('#view_span_curso').text(courseName);

    let tbody = $('#tablaViewAveragesModal tbody');
    tbody.html('<tr><td colspan="5" class="text-center py-4"><div class="spinner-border text-primary spinner-border-sm me-2"></div> Analizando notas...</td></tr>');

    viewAveragesModal.show();

    // Petición AJAX para obtener el consolidado de promedios
    // Busca el bloque $.get de tu '.btn-view-averages' y reemplázalo por este:
$.get("{{ route('grades.getAveragesData') }}", {
    idsection: idsection,
    idcourse: idcourse
}, function(data) {
    tbody.empty();

    if (data.length === 0) {
        tbody.html('<tr><td colspan="7" class="text-center text-muted py-3">No hay registros de alumnos en este curso.</td></tr>');
        return;
    }

    data.forEach(alumno => {
        let foto = alumno.photo ? `/backend/img/subidas/${alumno.photo}` : '/backend/img/user-default.png';
        
        let finalGrade = parseFloat(alumno.promedio_final || 0);
        let badgeStyle = finalGrade < 11 
            ? 'bg-danger-subtle text-danger border border-danger-subtle' 
            : 'bg-success-subtle text-success border border-success-subtle';

        tbody.append(`
            <tr>
                <td>
                    <img src="${foto}" width="38" height="38" class="rounded-circle shadow-sm" onerror="this.src='/backend/img/user-default.png'">
                </td>
                <td>
                    <div class="fw-bold text-dark mb-0" style="font-size: 13.5px;">${alumno.full_name}</div>
                </td>
                <td class="text-center text-secondary font-monospace small fw-semibold">${alumno.n_practica}</td>
                <td class="text-center text-secondary font-monospace small fw-semibold">${alumno.n_examen}</td>
                <td class="text-center text-secondary font-monospace small fw-semibold">${alumno.n_trabajo}</td>
                <td class="text-center text-secondary font-monospace small fw-semibold">${alumno.n_final}</td>
                <td class="text-center">
                    <span class="badge ${badgeStyle} fs-6 px-2.5 py-1.5 rounded-2 font-monospace w-100">
                        ${alumno.promedio_final}
                    </span>
                </td>
            </tr>
        `);
    });
}).fail(function() {
    tbody.html('<tr><td colspan="7" class="text-center text-danger py-3"><i class="material-icons align-middle fs-5 me-1">error</i> Error al procesar los promedios.</td></tr>');
});
});
});

</script>
@endpush

</x-layouts.app-layout>