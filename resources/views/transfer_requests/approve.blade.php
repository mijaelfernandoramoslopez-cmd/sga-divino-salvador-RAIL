<x-layouts.app-layout title="Aprobar Traslado">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('transferRequests.index') }}">Traslados de Ingreso</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Aprobar</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Aprobar solicitud {{ $transferRequest->request_code }}</h4>
                </div>

                <div class="card-content">
                    @if($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                    <div class="alert alert-info">
                        Al aprobar, el sistema creará el usuario del alumno, el perfil del estudiante y su matrícula activa.
                    </div>

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

                    <form action="{{ route('transferRequests.approve', $transferRequest->idtransfer_request) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="mt-3 mb-3" style="border-bottom:1px solid #eee; padding-bottom:10px;">
                            <strong>Datos de acceso del alumno</strong>
                        </h5>

                        <div class="row">
                            <div class="col-md-4">
                                <label>
                                    Usuario <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}"
                                    placeholder="Ingrese el usuario del alumno"
                                    required
                                >

                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>
                                    Correo <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="correo@ejemplo.com"
                                    required
                                >

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>
                                    Contraseña <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Mínimo 6 caracteres"
                                    required
                                >

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3" style="border-bottom:1px solid #eee; padding-bottom:10px;">
                            <strong>Matrícula de ingreso</strong>
                        </h5>

                        <div class="row">
                            <div class="col-md-8">
                                <label>
                                    Sección <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="idsection"
                                    class="form-control @error('idsection') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Seleccionar sección...</option>

                                    @foreach($sections as $section)
                                        @php
                                            $course = $section->course;
                                            $label = 'Sección ' . $section->section_name;

                                            if ($course) {
                                                $label .= ' / ' . ($course->degree->degree_name ?? 'Nivel');
                                                $label .= ' / ' . ($course->subgrade->subgrade_name ?? 'Grado');
                                                $label .= ' / ' . ($course->semester->period->period_name ?? 'Periodo');
                                            }

                                            $selected = old('idsection', $transferRequest->requested_idsection) == $section->idsection;
                                        @endphp

                                        <option value="{{ $section->idsection }}" {{ $selected ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('idsection')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>
                                    Fecha de matrícula <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="enrollment_date"
                                    class="form-control @error('enrollment_date') is-invalid @enderror"
                                    value="{{ old('enrollment_date', date('Y-m-d')) }}"
                                    required
                                >

                                @error('enrollment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Nota de aprobación</label>

                                <textarea
                                    name="decision_notes"
                                    class="form-control @error('decision_notes') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Escriba una observación opcional sobre la aprobación del traslado"
                                >{{ old('decision_notes') }}</textarea>

                                @error('decision_notes')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-success text-white">
                            Aprobar y Matricular
                        </button>

                        <a href="{{ route('transferRequests.show', $transferRequest->idtransfer_request) }}" class="btn btn-danger text-white">
                            Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.app-layout>
