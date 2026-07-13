<x-layouts.app-layout title="Constancias de Estudios">

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
                    <li class="breadcrumb-item active" aria-current="page">Mostrar</li>
                </ol>
            </nav>

            {{-- Tarjeta Principal contenedor del Listado --}}
            <div class="card shadow-sm border-0 mb-4" style="min-height:485px; border-top: 4px solid #005187 !important;">
                
                {{-- Cabecera con diseño Flexbox alineado --}}
                <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-1 fw-bold" style="color: #005187 !important;">
                            <i class="material-icons align-middle me-2">description</i> Constancias de Estudios Emitidas
                        </h4>
                        <p class="text-muted small mb-0">Gestión, consulta e impresión de las certificaciones de matrícula de la institución.</p>
                    </div>
                    <div>
                        <a href="{{ route('certificates.create') }}" class="btn text-white shadow-sm d-inline-flex align-items-center px-3 py-2 text-decoration-none" style="background-color: #005187 !important;" data-bs-toggle="tooltip" title="Nueva Constancia">
                            <i class="material-icons me-1">add</i> Nueva Constancia
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    
                    {{-- Alertas de Errores corregidas --}}
                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                            <i class="material-icons me-2">error_outline</i>
                            <div>{{ $errors->first() }}</div>
                        </div>
                    @endif

                    @if($certificates->count() > 0)
                        {{-- Tabla responsiva integrada a los estándares Bootstrap 5 --}}
                        <div class="table-responsive shadow-sm rounded-3 border">
                            <table class="table table-hover align-middle mb-0" id="example">
                                <thead class="table-light text-dark fw-bold">
                                    <tr>
                                        <th class="py-3 ps-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Código</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Alumno</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">DNI</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Motivo</th>
                                        <th class="py-3 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Fecha Emisión</th>
                                        <th class="py-3 text-secondary text-center" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Estado</th>
                                        <th class="py-3 text-center text-secondary" style="width: 160px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $certificate)
                                        <tr>
                                            <td class="ps-3 fw-bold text-dark font-monospace">{{ $certificate->certificate_code }}</td>
                                            <td class="fw-medium text-dark">{{ $certificate->student->full_name ?? '—' }}</td>
                                            <td class="text-muted font-monospace">{{ $certificate->student->dni ?? '—' }}</td>
                                            <td><span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $certificate->purpose }}">{{ $certificate->purpose }}</span></td>
                                            <td class="text-secondary">{{ $certificate->issue_date }}</td>
                                            <td class="text-center">
                                                @if($certificate->status == 1)
                                                    <span class="badge bg-success-subtle text-success px-2 py-1 border border-success-subtle rounded-pill">Vigente</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger px-2 py-1 border border-danger-subtle rounded-pill">Anulada</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Grupo de botones limpio --}}
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('certificates.preview', $certificate->idcertificate) }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Ver Vista Previa">
                                                        <i class="material-icons" style="font-size: 18px;">visibility</i>
                                                    </a>

                                                    @if($certificate->status == 1)
                                                        <a href="{{ route('certificates.print', $certificate->idcertificate) }}" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Imprimir PDF">
                                                            <i class="material-icons" style="font-size: 18px;">picture_as_pdf</i>
                                                        </a>

                                                        <a href="{{ route('certificates.showDelete', $certificate->idcertificate) }}" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center p-2" data-bs-toggle="tooltip" title="Anular Constancia">
                                                            <i class="material-icons" style="font-size: 18px;">delete_forever</i>
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
                        {{-- Estado vacío estilizado --}}
                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center my-2" role="alert">
                            <i class="material-icons me-2">warning</i>
                            <div><strong>¡Atención!</strong> No se encontraron constancias de estudios emitidas en el sistema actualmente.</div>
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