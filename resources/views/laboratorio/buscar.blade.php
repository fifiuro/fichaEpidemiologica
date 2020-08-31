@extends('template/base')

@section('content')
<br>
<div class="row">
    <br>
    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">LABORATORIO</h3>
        </div>
        <div class="card-body">
            {{--  DATOS DEL PACIENTE  --}}
            <div class="row">
                <label for="" style="font-size:18px;">DATOS DEL PACIENTE</label>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="nombre_pacientes">Nombre / Apellidos</label>
                    {{ $find[0]->nombre_pacientes }} {{ $find[0]->paterno_pacientes }} {{ $find[0]->materno_pacientes }}
                    <input type="hidden" name="id_fe" value="{{ $find[0]->id_fe }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="seguro_pacientes">Num. Seguro</label>
                    {{ $find[0]->seguro_pacientes }}
                </div>
                <div class="form-group col-md-4">
                    <label for="sexo">Sexo</label>
                    @if ($find[0]->sexo == 'm')
                        Masculino
                    @elseif($find[0]->sexo == 'f')
                        Femenino
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="ci">Nº Carnet de Identidad/Pasaporte</label>
                    {{ $find[0]->ci }}
                </div>
                <div class="form-group col-md-3">
                    <label for="expedido">Expedido</label>
                    {{ $dep[0]->departamento }}
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_nac">Fecha de Nacimiento</label>
                    {{ $find[0]->fecha_nac }}
                </div>
                <div class="form-group col-md-3">
                    <label for="edad_pacientes">Edad</label>
                    {{ $find[0]->edad }}
                </div>
                <div class="form-group col-md-3">
                    <label for="calle">Calle</label>
                    {{ $find[0]->calle }}
                </div>
                <div class="form-group col-md-3">
                    <label for="zona">Zona</label>
                    {{ $find[0]->zona}}
                </div>
                <div class="form-group col-md-3">
                    <label for="num">Nº</label>
                    {{ $find[0]->num }}
                </div>
                <div class="form-group col-md-3">
                    <label for="telefono_pacientes">Teléfono</label>
                    {{ $find[0]->telefono }}
                </div>
                <div class="form-group col-md-11">
                    <label for="menor">¿Es menor de edad?</label>
                    @if (count($menor) > 0)
                        SI
                    @else
                        NO
                    @endif
                </div>
            </div>
            <hr>
            {{-- TABLA DE RESULTADO DE LAS PRUEBAS EN LABORATORIO --}}
            <table class="table table-striped">
                <tr>
                    <th>TIPO DE MUESTRA</th>
                    <th>FECHA TOMA MUESTRA</th>
                    <th>FECHA ENVIO</th>
                    <th>RESPONSABLE</th>
                    <th>RESULTADO</th>
                    <th>FECHA RESULTADO</th>
                    <th>ACCIONES</th>
                </tr>
                @foreach ($lab as $l)
                    <tr>
                        <td>{{ $l->muestra }}</td>
                        <td>{{ $l->fecha_muestra }}</td>
                        <td>{{ $l->fecha_envio }}</td>
                        <td>{{ $l->responsable_muestra }}</td>
                        <td>
                            @if ($l->resultado_laboratorio)
                                POSITIVO
                            @else
                                NEGATIVO
                            @endif
                        </td>
                        <td>{{ $l->fecha_resultado }}</td>
                        <td>
                            {{-- Boton de Imprimir Certificado --}}
                            <a href="{{ url('certificado/'.$id.'/'.$l->id_lab) }}" class="btn btn-success" target="_blank">
                                <i class="fas fa-award"></i>
                            </a>
                        </td>
                    </tr>                        
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ url('laboratorio/nuevo/'.$id) }}" class="btn btn-primary">AGREGAR LABORATORIO</a>
            <a href="{{ url('/') }}" class="btn btn-danger">CERRAR</a>
        </div>
    </div>
</div>
@stop

@section('extra')
    $(function() {
        $('#id_mue').on('change', function(){
            if($(this).val().indexOf('otro') != -1) {
                $("#otro_muestra").attr('disabled',false);
            } else {
                $("#otro_muestra").attr('disabled',true);
            }
        });

        $('#quickForm').validate({
            rules: {
                establecimiento: {
                    required: true
                },
                red: {
                    required: true
                },
                municipio: {
                    required: true
                },
                fecha_notificacion: {
                    required: true
                },
                sem_epidem: {
                    required: true
                },
                nombre_pacientes: {
                    required: true
                },
                paterno_pacientes: {
                    required: true
                },
                nombre_personal: {
                    required:true
                },
                paterno_personal: {
                    required: true
                }
            },
            messages: {
                establecimiento: {
                    required: "Ingrese el nombre del Establecimiento."
                },
                red: {
                    required: "Ingrese Red de Salud."
                },
                municipio: {
                    required: "Ingrese el Municipio."
                },
                fecha_notificacion: {
                    required: "ingrese la Fehca de Notificación."
                },
                sem_epidem: {
                    required: "Ingrese el Sem Epidem."
                },
                nombre_pacientes: {
                    required: "Ingrese Nombre del Paciente."
                },
                paterno_pacientes: {
                    required: "Ingrese Apellido Paterno del Paciente."
                },
                nombre_personal: {
                    required: "Ingrese Nombre del Personal."
                },
                paterno_personal: {
                    required: "Ingrese Apellido Paterno del Personal."
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
