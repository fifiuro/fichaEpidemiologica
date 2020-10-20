@extends('template/base')

@section('content')
<br>
<div class="row">
    <br>
    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">LABORATORIO</h3>
        </div>
        <form role="form" method="POST" action="{{ url('laboratorio/actualizar') }}" id="quickForm">
            @csrf
            <div class="card-body">
                {{--  DATOS DEL PACIENTE  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">DATOS DEL PACIENTE</label>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="nombre_pacientes">Nombre / Apellidos</label>
                        {{ $find[0]["nombre"] }} {{ $find[0]["paterno"] }} {{ $find[0]["materno"] }}
                        <input type="hidden" name="id_fe" value="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="seguro_pacientes">Num. Seguro</label>
                        Seguro
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sexo">Sexo</label>
                        {{ $find[0]["sexo"] }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ci">Nº Carnet de Identidad/Pasaporte</label>
                        {{ $find[0]["ci"] }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="expedido">Expedido</label>
                        Expedido
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_nac">Fecha de Nacimiento</label>
                        {{ formato_fecha($find[0]["fecha_nacimiento"]) }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edad_pacientes">Edad</label>
                        Edad
                    </div>
                    <div class="form-group col-md-3">
                        <label for="calle">Calle</label>
                        {{ $find[0]["calle"] }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="zona">Zona</label>
                        {{ $find[0]["zona"] }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="num">Nº</label>
                        {{ $find[0]["numero"] }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono_pacientes">Teléfono</label>
                        {{ $find[0]["telefono"] }}
                    </div>
                </div>
                <hr>
                {{--  8. LABORATORIO  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">8. LABORATORIO</label>
                    <input type="hidden" name="">
                </div>
                <hr>
                @if ($estado == 1 or $estado == 2)
                    <div class="row grupo">
                        <div class="form-group col-md-6">
                            <label for="muestra_laboratorio">Se tomó la muestra para Laboratorio</label>
                            <input type="radio" name="muestra_laboratorio" id="" value="1" checked> SI
                            <input type="radio" name="muestra_laboratorio" id="" value="0"> NO
                            <input type="hidden" name="id_fe" value="{{ $id }}">
                            @if ($errors->has('muestra_laboratorio'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('muestra_laboratorio') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lugar_muestra">Lugar de toma de muestra</label>
                            <input type="text" name="lugar_muestra" id="" class="form-control" placeholder="Lugar de toma de muestra" value="{{ old('lugar_muestra') }}">
                            @if ($errors->has('lugar_muestra'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('lugar_muestra') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_mue">Tipo de muestra tomada</label>
                            <select name="id_mue" id="id_mue" class="form-control">
                                @foreach ($mue as $m)
                                    <option value="{{ $m->id_mue }}">{{ $m->muestra }}</option>
                                @endforeach
                                <option value="otro">Otro</option>
                            </select>
                            @if ($errors->has('id_mue'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('id_mue') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="otro_muestra">Otro</label>
                            <input type="text" name="otro_muestra" id="otro_muestra" class="form-control" placeholder="Otro" value="{{ old('otro_muestra') }}" disabled>
                            @if ($errors->has('otro_muestra'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('otro_muestra') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre_laboratorio">Nombre de Laboratorio que procesara la muestra</label>
                            <input type="text" name="nombre_laboratorio" id="" class="form-control" placeholder="Nombre de Laboratorio que procesara la muestra" value="{{ old('nombre_laboratorio') }}">
                            @if ($errors->has('nombre_laboratorio'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('nombre_laboratorio') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_muestra">Fecha de toma de muestra</label>
                            <input type="date" name="fecha_muestra" id="" class="form-control" placeholder="Fecha de toma de muestra" value="{{ old('fecha_muestra') }}">
                            @if ($errors->has('fecha_muestra'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('fecha_muestra') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_envio">Fecha de envío</label>
                            <input type="date" name="fecha_envio" id="" class="form-control" placeholder="Fecha envío" value="{{ old('fecha_envio') }}">
                            @if ($errors->has('fecha_envio'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('fecha_envio') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="responsable_muestra">Responsable de Toma de Muestra</label>
                            <input type="text" name="responsable_muestra" id="" class="form-control" placeholder="Responsable de Toma de Muestra" value="{{ old('responsable_muestra') }}">
                            @if ($errors->has('responsable_muestra'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('fecha_eresponsable_muestranvio') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label for="observaciones">Observaciones</label>
                            <textarea name="observaciones" id="" cols="30" rows="5" class="form-control"></textarea>
                            @if ($errors->has('observaciones'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('observaciones') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="resultado_muestra">Resultado</label>
                            <select name="resultado_muestra" id="" class="form-control">
                                <option value=""></option>
                                <option value="2">Indefinido</option>
                                <option value="1">Positivo</option>
                                <option value="0">Negativo</option>
                            </select>
                            @if ($errors->has('resultado_muestra'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('resultado_muestra') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_resultado">Fecha</label>
                            <input type="date" name="fecha_resultado" id="" class="form-control" placeholder="Fecha Resultado" value="{{ old('fecha_resultado') }}">
                            @if ($errors->has('fecha_resultado'))
                                <small class="form-text text-danger">
                                    {{ $errors->first('fecha_resultado') }}
                                </small>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="row grupo">
                        <div class="form-group col-md-6">
                            <label for="muestra_laboratorio">Se tomó la muestra para Laboratorio</label>
                            <input type="text" class="form-control" value="@if ($lab->muestra) SI @else NO @endif" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lugar_muestra">Lugar de toma de muestra</label>
                            <input type="text" class="form-control" value="{{ $lab->lugar_muestra }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_mue">Tipo de muestra tomada</label>
                            @foreach ($mue as $m)
                                @if ($lab->id_mue == $m->id_mue)
                                    <input type="text" class="form-control" value="{{ $m->muestra }}" disabled>
                                @endif
                            @endforeach
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre_laboratorio">Nombre de Laboratorio que procesara la muestra</label>
                            <input type="text" class="form-control" value="{{ $lab->nombre_laboratorio }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_muestra">Fecha de toma de muestra</label>
                            <input type="date" class="form-control" value="{{ $lab->fecha_muestra }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_envio">Fecha de envío</label>
                            <input type="date" class="form-control" value="{{ $lab->fecha_envio }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="responsable_muestra">Responsable de Toma de Muestra</label>
                            <input type="text" class="form-control" value="{{ $lab->responsable_muestra }}" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" cols="30" rows="5" disabled>{{ $lab->observaciones }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="resultado_muestra">Resultado</label>
                            @switch($lab->resultado_laboratorio)
                                @case(0)
                                    <input type="text" class="form-control" value="Negativo" disabled>
                                    @break
                                @case(1)
                                    <input type="text" class="form-control" value="Positivo" disabled>
                                    @break
                                @case(2)
                                    <input type="text" class="form-control" value="Indefinido" disabled>
                                    @break
                            @endswitch
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_resultado">Fecha</label>
                            <input type="text" class="form-control" value="{{ formato_fecha($lab->fecha_resultado) }}" disabled>
                        </div>
                    </div>
                @endif
                {{--  DATOS DEL PERSONAL QUE NOTIFICA  --}}
                {{--  <div class="row">
                    <label for="" style="font-size:18px;">DATOS DEL PERSONAL QUE NOTIFICA</label>
                </div>  --}}
                {{--  <hr>  --}}
                {{--  <div class="row grupo">
                    <div class="form-group col-md-4">
                        <label for="nombre_personal">Nombre</label>
                        <input type="text" name="nombre_personal" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre_personal') }}" required>
                        @if ($errors->has('nombre_personal'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre_personal') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paterno_personal">Paterno</label>
                        <input type="text" name="paterno_personal" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno_personal') }}" required>
                        @if ($errors->has('paterno_personal'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno_personal') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="materno_personal">Materno</label>
                        <input type="text" name="materno_personal" id="" class="form-control" placeholder="Materno" value="{{ old('materno_personal') }}">
                        @if ($errors->has('materno_personal'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno_personal') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="tel_cel_personal">Teléfono / Celular</label>
                        <input type="text" name="tel_cel_personal" id="" class="form-control" placeholder="Teléfono / Celular" value="{{ old('tel_cel_personal') }}">
                        @if ($errors->has('tel_cel_personal'))
                            <small class="form-text text-danger">
                                {{ $errors->first('tel_cel_personal') }}
                            </small>
                        @endif
                    </div>
                </div>  --}}
            </div>
            <div class="card-footer">
                @if ($estado == 1 or $estado == 2)
                    <button type="submit" class="btn btn-primary">GUARDAR</button>
                @else
                    <a href="{{ url('certificado/'.$id_fe.'/'.$lab->id_lab.'/'.$ci.'/'.$fecha) }}" class="btn btn-success" target="_blank">IMPRIMIR</a>
                @endif
                <a href="{{ url('/home') }}" class="btn btn-danger">CANCELAR</a>
            </div>
        </form>
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
