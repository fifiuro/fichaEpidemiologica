@extends('template/base')

@section('content')
    <br>
    <div class="row">
        <div class="card card-info col-md-12">
            <div class="card-header">
                <h3 class="card-title">REPORTE RESULTADO PACIENTES SARS-COV-2</h3>
            </div>
            <form role="form" method="POST" action="{{ url('resultado') }}" id="quickForm">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="text" name="fecha" class="form-control" id="nombre" placeholder="Fecha" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group text-center">
                                {{-- Boton Buscar --}}
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                {{-- Boton Nuevo --}}
                                {{-- <a href="{{ url('nuevo') }}" class="btn btn-danger">
                                    <i class="fas fa-plus"></i>
                                </a> --}}
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
                                    <th>Seguro</th>
                                    <th>Telefono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($find as $f)
                                <tr>
                                    <td>{{ $f->id_fe }}</td>
                                    <td>{{ $f->nombre_pacientes }} {{ $f->paterno_pacientes }} {{ $f->materno_pacinetes }}</td>
                                    <td>{{ $f->seguro_pacientes }}</td>
                                    <td>{{ $f->telefono }}</td>
                                    <td>
                                        {{-- Boton de Modificar --}}
                                        {{-- <a href="{{ url('centrosalud/editar/'.$f->id_cen) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                        {{-- Boton de Eliminar --}}
                                        <a href="{{ url('confirm/'.$f->id_fe) }}" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                        {{-- Boton de Imprimir --}}
                                        <a href="{{ url('imprimir/'.$f->id_fe) }}" class="btn btn-info" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        {{-- Boton de Imprimir Certificado --}}
                                        <a href="{{ url('certificado/'.$f->id_fe) }}" class="btn btn-success" target="_blank">
                                            <i class="fas fa-award"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $find->links() }}
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
