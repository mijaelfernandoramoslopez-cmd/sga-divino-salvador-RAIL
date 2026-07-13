<x-layouts.app-layout title="Actualizar Solicitud de Traslado">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Panel Control</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('transferRequests.index') }}">Traslados de Ingreso</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $action == 'OBSERVADO' ? 'Observar' : 'Rechazar' }}</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header card-header-text">
                    <h4 class="card-title">
                        {{ $action == 'OBSERVADO' ? 'Observar solicitud' : 'Rechazar solicitud' }} {{ $transferRequest->request_code }}
                    </h4>
                </div>

                <div class="card-content">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:220px;">Estudiante</th>
                            <td>{{ $transferRequest->full_name }} - DNI {{ $transferRequest->dni }}</td>
                        </tr>
                        <tr>
                            <th>Colegio procedencia</th>
                            <td>{{ $transferRequest->previous_school }}</td>
                        </tr>
                    </table>

                    <form action="{{ $action == 'OBSERVADO' ? route('transferRequests.observe', $transferRequest->idtransfer_request) : route('transferRequests.reject', $transferRequest->idtransfer_request) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>{{ $action == 'OBSERVADO' ? 'Motivo de observación' : 'Motivo de rechazo' }} <span class="text-danger">*</span></label>
                            <textarea name="decision_notes" class="form-control" rows="5" required>{{ old('decision_notes', $transferRequest->decision_notes) }}</textarea>
                            @error('decision_notes') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <hr>
                        <button type="submit" class="btn {{ $action == 'OBSERVADO' ? 'btn-info' : 'btn-danger' }} text-white">
                            Guardar {{ $action == 'OBSERVADO' ? 'observación' : 'rechazo' }}
                        </button>
                        <a href="{{ route('transferRequests.show', $transferRequest->idtransfer_request) }}" class="btn btn-secondary text-white">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.app-layout>
