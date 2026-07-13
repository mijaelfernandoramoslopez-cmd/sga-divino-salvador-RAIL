<x-layouts.app-layout title="Traslados de Ingreso">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            
            {{-- Breadcrumb de navegación optimizado --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-decoration-none" style="color: #005187 !important;">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Traslados de Ingreso</li>
                </ol>
            </nav>

            {{-- Tarjeta Contenedora Principal --}}
            <div class="card shadow-sm border-0 mb-4" style="min-height:485px; border-top: 4px solid #005187 !important;">
                
                {{-- Cabecera con diseño Flexbox alineado --}}
                <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-1 fw-bold" style="color: #005187 !important;">
                            <i class="material-icons align-middle me-2">input</i> Solicitudes de Traslado de Ingreso
                        </h4>
                        <p class="text-muted small mb-0">Listado, evaluación y gestión de postulantes provenientes de otras instituciones educativas.</p>
                    </div>
                    <div>
                        <a href="{{ route('transferRequests.create') }}" class="btn text-white shadow-sm d-inline-flex align-items-center px-3 py-2 text-decoration-none" style="background-color: #005187 !important;" data-bs-toggle="tooltip" title="Registrar solicitud de traslado">
                            <i class="material-icons me-1">add</i> Nueva Solicitud
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if($requests->count())
                        {{-- Contenedor de Tabla Responsiva --}}
                        <div class="table-responsive shadow-sm rounded-3 border">
                            <table class="table table-hover align-middle mb-0" id="example">
                                <thead class="table-light text-dark fw-bold">
                                    <tr>
                                        <th class="py-3 ps-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Código</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Estudiante</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Colegio procedencia</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Sección solicitada</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Fecha</th>
                                        <th class="py-3 text-secondary text-center" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Estado</th>
                                        <th class="py-3 text-center text-secondary" style="width: 200px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $requestItem)
                                        @php
                                            $section = $requestItem->requestedSection;
                                            $course = $section?->course;
                                        @endphp
                                        <tr>
                                            <td class="ps-3 text-secondary font-monospace" style="font-size: 0.9rem;">{{ $requestItem->idtransfer_request }}</td>
                                            <td class="fw-bold text-dark font-monospace" style="font-size: 0.95rem;">{{ $requestItem->request_code }}</td>
                                            <td>
                                                <div class="fw-medium text-dark">{{ $requestItem->full_name }}</div>
                                                <small class="text-muted font-monospace">DNI: {{ $requestItem->dni }}</small>
                                            </td>
                                            <td class="text-secondary" style="font-size: 0.95rem;">{{ $requestItem->previous_school }}</td>
                                            <td>
                                                @if($section)
                                                    <div class="fw-medium text-dark">Sección {{ $section->section_name }}</div>
                                                    <small class="text-muted">{{ $course?->degree?->degree_name }} / {{ $course?->subgrade?->subgrade_name }}</small>
                                                @else
                                                    <span class="text-muted italic small">No especificada</span>
                                                @endif
                                            </td>
                                            <td class="text-secondary font-monospace" style="font-size: 0.9rem;">
                                                {{ optional($requestItem->request_date)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{-- Mantiene la clase dinámica de tu backend pero adaptado al redondeado de Bootstrap 5 --}}
                                                <span class="badge rounded-pill px-2.5 py-1.5 border {{ $requestItem->status_badge_class }}">
                                                    {{ $requestItem->status_name }}
                                                </span>
                                            </td>
                                            <td>
                                                {{-- Grupo de botones estilizado sin saturar las filas --}}
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('transferRequests.show', $requestItem->idtransfer_request) }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Ver solicitud">
                                                        <i class="material-icons" style="font-size: 18px;">visibility</i>
                                                    </a>

                                                    @if($requestItem->status !== 'APROBADO')
                                                        <a href="{{ route('transferRequests.approve.form', $requestItem->idtransfer_request) }}" class="btn btn-sm btn-outline-success d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Aprobar traslado">
                                                            <i class="material-icons" style="font-size: 18px;">check</i>
                                                        </a>

                                                        <a href="{{ route('transferRequests.observe.form', $requestItem->idtransfer_request) }}" class="btn btn-sm btn-outline-info d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Observar solicitud">
                                                            <i class="material-icons" style="font-size: 18px;">rate_review</i>
                                                        </a>

                                                        <a href="{{ route('transferRequests.reject.form', $requestItem->idtransfer_request) }}" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Rechazar solicitud">
                                                            <i class="material-icons" style="font-size: 18px;">close</i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Estado vacío controlado --}}
                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center my-2" role="alert">
                            <i class="material-icons me-2">warning</i>
                            <div>No se encontraron solicitudes de traslado de ingreso registradas en el sistema.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }

        $('#example').DataTable({
            dom: "<'row mb-3'<'col-md-6'B><'col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row mt-3'<'col-md-5'i><'col-md-7'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-sm btn-light border text-success fw-bold me-1',
                    text: '<span class="d-flex align-items-center"><i class="material-icons me-1" style="font-size:16px">grid_on</i> Excel</span>'
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-sm btn-light border text-danger fw-bold me-1',
                    text: '<span class="d-flex align-items-center"><i class="material-icons me-1" style="font-size:16px">picture_as_pdf</i> PDF</span>'
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-light border text-dark fw-bold',
                    text: '<span class="d-flex align-items-center"><i class="material-icons me-1" style="font-size:16px">print</i> Imprimir</span>'
                }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            responsive: true,
            pageLength: 10,
            retrieve: true
        });

        // Inicializar tooltips de Bootstrap 5
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
</x-layouts.app-layout>