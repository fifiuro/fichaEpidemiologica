@extends('template/base')

@section('content')
    <br>
    <div class="row">
        <div class="card card-info col-md-12">
            <div class="card-header">
                <h3 class="card-title">BUSCAR FICHA EPIDEMIOLOGICA</h3>
            </div>
            <form role="form" method="POST" action="{{ url('ficha/buscar') }}" id="quickForm">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="ci">Carnet de Identidad</label>
                                <input type="text" name="ci" class="form-control" id="ci" placeholder="Carnet de Identidad" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha Nacimiento</label>
                                <input type="date" name="fecha" class="form-control" id="fecha" placeholder="Fecha Nacimiento" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group text-center">
                                {{-- Boton Buscar --}}
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                {{-- Boton Nuevo --}}
                                <a href="{{ url('ficha/nuevo') }}" class="btn btn-danger">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @isset($estado)
        @if ($estado == 1)
            <div class="row">
                <div class="card card-info col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Resultado de la busqueda</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nombre y Apellidos</th>
                                    <th>CI</th>
                                    <th>Telefono</th>
                                    <th>Fecha Notificación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($find as $f)
                                <tr>
                                    <td>{{ $f->id_fe }}</td>
                                    <td>{{ $f->nombre }}</td>
                                    <td>{{ $f->ci }}</td>
                                    <td>{{ $f->telefono }} {{ $f->estado }}</td>
                                    <td>{{ formato_fecha($f->fecha_notificacion) }}</td>
                                    <td>
                                        {{-- Boton de Modificar --}}
                                        <a href="{{ url('ficha/editar/'.$f->id_fe.'/'.$f->ci.'/'.$f->fecha_nacimiento.'/'.$f->id_est) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- Boton de Eliminar --}}
                                        {{--  <a href="{{ url('confirm/'.$f->id_fe) }}" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>  --}}
                                        {{-- Boton de Imprimir Ficha Epidemiologica --}}
                                        <a href="{{ url('imprimir/'.$f->id_fe.'/'.$f->ci.'/'.$f->fecha_nacimiento.'/'.$f->id_est) }}" class="btn btn-primary" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        {{-- Boton de Crear Laboratorio --}}
                                        <a href="{{ url('laboratorio/editar/'.$f->id_fe.'/'.$f->ci.'/'.$f->fecha_nacimiento.'/'.$f->id_est) }}" class="btn btn-danger">
                                            <i class="fas fa-flask"></i>
                                        </a>
                                        {{-- Boton de Imprimir Certificado Medico --}}
                                        <a href="{{ url('certificado_medico/'.$f->id_fe.'/'.$f->ci.'/'.$f->fecha_nacimiento) }}" class="btn btn-info" target="_blank">
                                            <i class="far fa-file-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif($estado == 0)
            <div class="row">
                <div class="card card-info col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Resultado de la busqueda</h3>
                    </div>
                    <div class="card-body p-0">
                        <h3>{{ $mensaje }}</h3>
                    </div>
                </div>
            </div>
        @endif
    @endisset
@stop

@section('extra')
$(function() {
    $('#quickForm').validate({
        rules: {
            nombre: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Ingrese un Nombre valido para realizar la busqueda."
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass){
            $(element).removeClass('is-invalid');
        }
    });
})
@stop
