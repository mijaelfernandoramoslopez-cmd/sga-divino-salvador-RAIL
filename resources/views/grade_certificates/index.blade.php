<x-layouts.app-layout title="Constancias de Notas">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-custom-blue" style="color: #005187 !important;">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('gradeCertificates.index') }}" class="text-decoration-none text-custom-blue" style="color: #005187 !important;">Constancias de Notas</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mostrar</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0 mb-4" style="min-height:485px; border-top: 4px solid #005187 !important;">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center pt-4 pb-3">
                    <h4 class="card-title mb-0 fw-bold d-flex align-items-center" style="color: #005187 !important;">
                        <i class="material-icons align-middle me-2">assignment</i> Constancias de Notas Emitidas
                    </h4>
                    <a href="{{ route('gradeCertificates.create') }}" class="btn text-white shadow-sm d-inline-flex align-items-center px-3" style="background-color: #005187 !important;" data-bs-toggle="tooltip" title="Nueva Constancia">
                        <i class='material-icons me-1'>add</i> Agregar
                    </a>
                </div>

                <div class="card-body p-0">
                    @if($errors->any())
                        <div class="p-4 pb-0">
                            <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-0" role="alert">
                                <i class="material-icons me-2">error</i>
                                <div>{{ $errors->first() }}</div>
                            </div>
                        </div>
                    @endif

                    @if($certificates->count() > 0)
                        <div class="table-responsive p-4">
                            <table class="table table-hover align-middle w-100" id="example">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">Código</th>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">Alumno</th>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">DNI</th>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">Periodo</th>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">Motivo</th>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">Fecha de Emisión</th>
                                        <th class="text-dark fw-bold py-3" style="border-bottom: 2px solid #005187 !important;">Estado</th>
                                        <th class="text-dark fw-bold py-3 text-end pe-4" style="border-bottom: 2px solid #005187 !important;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $certificate)
                                        <tr>
                                            <td class="font-monospace fw-bold" style="color: #005187 !important;">
                                                {{ $certificate->certificate_code }}
                                            </td>
                                            <td class="fw-semibold text-dark">
                                                {{ $certificate->student->full_name ?? '—' }}
                                            </td>
                                            <td>{{ $certificate->student->dni ?? '—' }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark border fw-normal">{{ $certificate->period->period_name ?? '—' }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted small">{{ \Illuminate\Support\Str::limit($certificate->purpose, 30) }}</span>
                                            </td>
                                            <td class="text-secondary small">
                                                {{ $certificate->issue_date }}
                                            </td>
                                            <td>
                                                @if($certificate->status == 1)
                                                    <span class="badge bg-success rounded-pill px-2 py-1">Vigente</span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill px-2 py-1">Anulada</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group gap-1">
                                                    <a href="{{ route('gradeCertificates.preview', $certificate->idgradecertificate) }}" class="btn btn-sm btn-outline-secondary rounded px-2 py-1" data-bs-toggle="tooltip" title="Vista previa">
                                                        <i class='material-icons' style="font-size: 18px;">visibility</i>
                                                    </a>

                                                    @if($certificate->status == 1)
                                                        <a href="{{ route('gradeCertificates.print', $certificate->idgradecertificate) }}" target="_blank" class="btn btn-sm btn-outline-success rounded px-2 py-1" data-bs-toggle="tooltip" title="Imprimir / PDF">
                                                            <i class='material-icons' style="font-size: 18px;">picture_as_pdf</i>
                                                        </a>

                                                        <a href="{{ route('gradeCertificates.showDelete', $certificate->idgradecertificate) }}" class="btn btn-sm btn-outline-danger rounded px-2 py-1" data-bs-toggle="tooltip" title="Anular Constancia">
                                                            <i class='material-icons' style="font-size: 18px;">delete_forever</i>
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
                        <div class="p-4">
                            <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center my-2" role="alert">
                                <i class="material-icons me-2">info</i>
                                <div>
                                    <strong>No hay constancias de notas emitidas.</strong> Si deseas generar una, presiona el botón "Agregar" en la esquina superior.
                                </div>
                            </div>
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