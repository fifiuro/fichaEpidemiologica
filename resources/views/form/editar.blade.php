@extends('template/base')

@section('content')
<br>
<div class="row">
    <br>
    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">MODIFICANDO FICHA EPIDEMIOLOGICA Y SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19</h3>
        </div>
        <form role="form" method="POST" action="{{ url('ficha/actualizar') }}" id="quickForm">
            @csrf
            <div class="card-body">
                {{--  1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-4">
                        <label for="establecimiento">Establecimiento de Salud</label>
                        <input type="text" class="form-control" value="{{ $cs[0]["establecimiento"] }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="codigo">Código Establecimiento</label>
                        <input type="text" class="form-control" value="{{ $cs[0]["codigo"] }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="red">Red de Salud</label>
                        <input type="text" class="form-control" value="{{ $cs[0]["red_salud"] }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="departamento">Departamento</label>
                        <input type="text" class="form-control" value="{{ $cs[0]["departamento"] }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="municipio">Municipio</label>
                        <input type="text" class="form-control" value="{{ $cs[0]["municipio"] }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_notificacion">Fecha de Notificación</label>
                        <input type="date" name="fecha_notificacion" class="form-control" value="{{ $fe->fecha_notificacion }}" required>
                        <input type="hidden" name="id_fe" value="{{ $fe->id_fe }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sem_epidem">Sem Epidem</label>
                        <input type="number" name="sem_epidem" class="form-control" value="{{ $fe->sem_epidem }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="caso_identificado">Caso identificado por busqueda activa</label>
                        @if ($fe->caso_identificado)
                            <input type="radio" name="caso_identificado" id="" value="1" checked> SI
                            <input type="radio" name="caso_identificado" id="" value="0"> NO
                        @else
                            <input type="radio" name="caso_identificado" id="" value="1"> SI
                            <input type="radio" name="caso_identificado" id="" value="0" checked> NO
                        @endif
                    </div>
                </div>
                <hr>
                {{--  2. IDENTIFICACION DEL CASO/PACIENTE  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">2. IDENTIFICACION DEL CASO/PACIENTE</label>
                </div>
                <hr>
                <div class="row grupo" id="resultadoPaciente">
                    <div class="form-group col-md-4">
                        <label>Nombres y Apellidos</label>
                        <input type="text" id="resultadoPecienteNombre" class="form-control" value="{{ $pa[0]["nombre"] }} {{ $pa[0]["paterno"] }} {{ $pa[0]["materno"] }}" disabled>
                        <input type="hidden" name="id_pac" id="id_pac" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Num. Seguro</label>
                        <input type="text" id="resltadoPacienteSeguro" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Sexo</label>
                        <input type="text" id="resultadoPacienteSexo" class="form-control" value="{{ $pa[0]["sexo"] }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Nº Carnet de Identidad/Pasaporte</label>
                        <input type="text" id="resultadoPacienteCi" class="form-control" value="{{ $pa[0]["ci"] }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Expedido</label>
                        <input type="text" id="resultadoPacienteExpedido" class="form-control" value="{{ $pa[0]["expedido"] }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" id="resultadoPacienteFecha" class="form-control" value="{{ $pa[0]["fecha_nacimiento"] }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Edad</label>
                        <input type="text" id="resultadoPacienteEdad" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Teléfono / Celular</label>
                        <input type="text" id="resultadoPacienteTelefono" class="form-control" value="{{ $pa[0]["telefono"] }}" disabled>
                    </div>
                </div>
                <hr>
                {{--  3. ANTECEDENTES EPIDEMIOLOGICOS  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">3. ANTECEDENTES EPIDEMIOLOGICOS</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-6">
                        <label for="id_ocu">Ocupación</label>
                        <select name="id_ocu" id="id_ocu" class="form-control">
                            @foreach ($ocu as $o)
                                @if ($o->id_ocu == $ocupacion->id_ocu)
                                <option value="{{ $o->id_ocu }}" selected>{{ $o->ocupacion }}</option>
                                @else
                                    <option value="{{ $o->id_ocu }}">{{ $o->ocupacion }}</option>
                                @endif
                            @endforeach
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_ocu'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_ocu') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otro_ocupacion">Otro</label>
                        <input type="text" name="otro_ocupacion" id="otro_ocupacion" class="form-control" placeholder="Ocupación" value="{{ old('otro_ocupacion') }}" disabled>
                        @if ($errors->has('otro_ocupacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro_ocupacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vacuna_influenza">Antecedente de vacunación para influenza</label>
                        <input type="hidden" name="id_ant" value="{{ $antecendentes->id_ant }}" required>
                        @if ($antecendentes->vacuna_influenza)
                            <input type="radio" name="vacuna_influenza" id="" value="1" checked> SI
                            <input type="radio" name="vacuna_influenza" id="" value="0"> NO
                        @else
                            <input type="radio" name="vacuna_influenza" id="" value="1"> SI
                            <input type="radio" name="vacuna_influenza" id="" value="0" checked> NO                            
                        @endif
                        @if ($errors->has('vacuna_influenza'))
                            <small class="form-text text-danger">
                                {{ $errors->first('vacuna_influenza') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_vacunacion">Fecha</label>
                        <input type="date" name="fecha_vacunacion" id="" class="form-control" placeholder="Fecha" value="{{ $antecendentes->fecha_vacunacion }}">
                        @if ($errors->has('fecha_vacunacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_vacunacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="viaje_riesgo">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?</label>
                        @if ($antecendentes->viaje_riesgo)
                            <input type="radio" name="viaje_riesgo" id="" value="1" checked> SI
                            <input type="radio" name="viaje_riesgo" id="" value="0"> NO
                        @else
                            <input type="radio" name="viaje_riesgo" id="" value="1"> SI
                            <input type="radio" name="viaje_riesgo" id="" value="0" checked> NO
                        @endif
                        @if ($errors->has('viaje_riesgo'))
                            <small class="form-text text-danger">
                                {{ $errors->first('viaje_riesgo') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="id_pai_antcedentes">País</label>
                        <select name="id_pai_antcedentes" id="" class="form-control">
                            @foreach ($pai as $p)
                                @if ($pais_viaje->id_pai == $p->id_pai)
                                    <option value="{{ $p->id_pai }}" selected>{{ $p->pais }}</option>
                                @else
                                    <option value="{{ $p->id_pai }}">{{ $p->pais }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('id_pai_antcedentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_pai_antcedentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_antecedentes">Ciudad</label>
                        <input type="text" name="ciudad_antecedentes" id="" class="form-control" placeholder="ciudad_antecedentes" value="{{ $antecendentes->ciudad }}">
                        @if ($errors->has('ciudad_antecedentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ciudad_antecedentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_retorno">Fecha de retorno de viaje</label>
                        <input type="date" name="fecha_retorno" id="" class="form-control" placeholder="Fecha de retorno de viaje" value="{{ $antecendentes->fecha_retorno }}">
                        @if ($errors->has('fecha_retorno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_retorno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="hora_retorno">Hora</label>
                        <input type="time" name="hora_retorno" id="" class="form-control" placeholder="Hora" value="{{ $antecendentes->hora_retorno }}">
                        @if ($errors->has('hora_retorno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('hora_retorno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="empresa_viaje">Empresa</label>
                        <input type="text" name="empresa_viaje" id="" class="form-control" placeholder="Empresa" value="{{ $antecendentes->empresa_viaje }}">
                        @if ($errors->has('empresa_viaje'))
                            <small class="form-text text-danger">
                                {{ $errors->first('empresa_viaje') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_vuelo">Nº vuelo</label>
                        <input type="text" name="num_vuelo" id="" class="form-control" placeholder="Nº vuelo" value="{{ $antecendentes->num_vuelo }}">
                        @if ($errors->has('num_vuelo'))
                            <small class="form-text text-danger">
                                {{ $errors->first('num_vuelo') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_asiento">Nº asiento</label>
                        <input type="text" name="num_asiento" id="" class="form-control" placeholder="Nº asiento" value="{{ $antecendentes->num_asiento }}">
                        @if ($errors->has('num_asiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('num_asiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contacto_antecedentes">¿Tuvo contacto con un caso confirmado de COVID+19 en los 14 días previos al inicio de sinstimos, edomicilio o establecimiento de salud?</label>
                        @if ($antecendentes->contacto)
                            <input type="radio" name="contacto_antecedentes" id="" value="1" checked> SI
                            <input type="radio" name="contacto_antecedentes" id="" value="0"> NO
                        @else
                            <input type="radio" name="contacto_antecedentes" id="" value="1"> SI
                            <input type="radio" name="contacto_antecedentes" id="" value="0" checked> NO
                        @endif
                        @if ($errors->has('contacto_antecedentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('contacto_antecedentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_contacto_antecentes">Fecha de contacto</label>
                        <input type="date" name="fecha_contacto_antecentes" id="" class="form-control" placeholder="Fecha de contacto" value="{{ $antecendentes->fecha_contacto }}">
                        @if ($errors->has('fecha_contacto_antecentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_contacto_antecentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombre_contacto">Nombre (del caso positivo)</label>
                        <input type="text" name="nombre_contacto" id="" class="form-control" placeholder="Nombre" value="{{ $antecendentes->nombre_contacto }}">
                        @if ($errors->has('nombre_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="paterno_contacto">Paterno (del caso positivo)</label>
                        <input type="text" name="paterno_contacto" id="" class="form-control" placeholder="Nombre" value="{{ $antecendentes->paterno_contacto }}">
                        @if ($errors->has('paterno_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="materno_contacto">Materno (del caso positivo)</label>
                        <input type="text" name="materno_contacto" id="" class="form-control" placeholder="Nombre" value="{{ $antecendentes->materno_contacto }}">
                        @if ($errors->has('materno_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono_contacto">Teléfono (del caso positivo)</label>
                        <input type="text" name="telefono_contacto" id="" class="form-control" placeholder="Teléfono del caso positivo" value="{{ $antecendentes->telefono_contacto }}">
                        @if ($errors->has('telefono_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('telefono_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="telefono_contacto">Lugar de contacto con el caso positivo</label>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="id_pai_contacto">País</label>
                        <select name="id_pai_contacto" id="" class="form-control">
                            @foreach ($pai as $p)
                                @if ($antecendentes->pais_contacto == $p->id_pai)
                                    <option value="{{ $p->id_pai }}" selected>{{ $p->pais }}</option>
                                @else
                                    <option value="{{ $p->id_pai }}">{{ $p->pais }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('id_pai_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_pai_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="departamento_contacto">Departamento / Estado</label>
                        <input type="text" name="departamento_contacto" id="" class="form-control" placeholder="Departamento / Estado" value="{{ $antecendentes->departamento_contacto }}">
                        {{--  <select name="departamento_contacto" id="" class="form-control">
                            @foreach ($dep as $d)
                                <option value="{{ $d->id_dep }}">{{ $d->departamento }}</option>
                            @endforeach
                        </select>  --}}
                        @if ($errors->has('departamento_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('departamento_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio_contacto">Municipio</label>
                        <input type="text" name="municipio_contacto" id="" class="form-control" placeholder="Municipio" value="{{ $antecendentes->municipio_contacto }}">
                        @if ($errors->has('municipio_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('municipio_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_contacto">Ciudad / Localidad</label>
                        <input type="text" name="ciudad_contacto" id="" class="form-control" placeholder="Ciudad / Localidad" value="{{ $antecendentes->ciudad_contacto }}">
                        @if ($errors->has('ciudad_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ciudad_contacto') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  4. DATOS CLINICOS  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">4. DATOS CLINICOS</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-4">
                        <label for="fecha_inicio">Fecha de inicio de síntomas</label>
                        <input type="date" name="fecha_inicio" id="" class="form-control" placeholder="Fecha de inicio de síntomas" value="{{ $dc->fecha_inicio }}">
                        <input type="hidden" name="id_dc" value="{{ $dc->id_dc }}">
                        @if ($errors->has('fecha_inicio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_inicio') }}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="row grupo">
                    <div class="form-group col-md-6">
                        <label for="sintoma">Síntomas {{ count($sintoma) }}</label>
                        <select name="sintoma[]" id="sintoma" class="select2" multiple="multiple" data-placeholder="Sintoma" style="width: 100%;">
                            @foreach ($sin as $s)
                                @if (in_array($s->id_sin,$sintoma,false))
                                    <option value="{{ $s->id_sin }}" selected>{{ $s->sintoma }}</option>
                                @else
                                    <option value="{{ $s->id_sin }}">{{ $s->sintoma }}</option>
                                @endif
                            @endforeach
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('fecha_inicio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_inicio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otro_sintoma">Otro</label>
                        <input type="text" name="otro_sintoma" id="otro_sintoma" class="form-control" placeholder="Otro" value="{{ old('otro') }}" disabled>
                        @if ($errors->has('otro_sintoma'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro_sintoma') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_estado">Estado actual del paciente (al momento del reporte)</label>
                        <select name="id_estado" id="id_estado" class="form-control">
                            @foreach ($est as $e)
                                @if ($dc->id_est == $e->id_est)
                                    <option value="{{ $e->id_est }}" selected>{{ $e->nombre }}</option>
                                @else
                                    <option value="{{ $e->id_est }}">{{ $e->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('id_estado'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_estado') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_estado">Fecha de defuncion</label>
                        <input type="date" name="fecha_estado" id="fecha_estado" class="form-control" value="{{ $dc->fecha_estado }}" disabled>
                        @if ($errors->has('fecha_estado'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_estado') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_dia">Diagnostico Clinico</label>
                        <select name="id_dia" id="id_dia" class="form-control">
                            @foreach ($dia as $d)
                                @if ($dc->id_dia == $d->id_dia)
                                    <option value="{{ $d->id_dia }}" selected>{{ $d->diagnostico }}</option>
                                @else
                                    <option value="{{ $d->id_dia }}">{{ $d->diagnostico }}</option>
                                @endif
                            @endforeach
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_dia'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_dia') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otro_diagnostico">Otro</label>
                        <input type="text" name="otro_diagnostico" id="otro_diagnostico" class="form-control" disabled>
                        @if ($errors->has('otro_diagnostico'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro_diagnostico') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  5. DATOS EN CASO DE HOSPITALIZACION Y/O AISLAMIENTO  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">5. DATOS EN CASO DE HOSPITALIZACION Y/O AISLAMIENTO</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-6">
                        <label for="fecha_aislamiento">Fecha de aislamiento</label>
                        <input type="date" name="fecha_aislamiento" id="" class="form-control" placeholder="Fecha de aislamiento" value="{{ $ho->fecha_aislamiento }}">
                        <input type="hidden" name="id_hos" value="{{ $ho->id_hos }}">
                        @if ($errors->has('fecha_aislamiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_aislamiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lugar_aislamiento">Lugar de aislamiento</label>
                        <input type="text" name="lugar_aislamiento" id="" class="form-control" placeholder="Lugar de aislamiento" value="{{ $ho->lugar_aislamiento }}">
                        @if ($errors->has('lugar_aislamiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('lugar_aislamiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_internacion">Fecha de internación</label>
                        <input type="date" name="fecha_internacion" id="" class="form-control" placeholder="Fecha de internación" value="{{ $ho->fecha_internacion }}">
                        @if ($errors->has('fecha_internacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_internacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="establecimiento_internacion">Establecimiento de salud de Internación</label>
                        <input type="text" name="establecimiento_internacion" id="" class="form-control" placeholder="Establecimiento de salud de Internación" value="{{ $ho->establecimiento }}">
                        @if ($errors->has('establecimiento_internacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('establecimiento_internacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ventilacion">Ventilación mecánica</label>
                        @if ($ho->ventilacion)
                            <input type="radio" name="ventilacion" id="" value="1" checked> SI
                            <input type="radio" name="ventilacion" id="" value="0"> NO                            
                        @else
                            <input type="radio" name="ventilacion" id="" value="1"> SI
                            <input type="radio" name="ventilacion" id="" value="0" checked> NO                            
                        @endif

                        @if ($errors->has('ventilacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ventilacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="terapia_intensiva">Terapia intensiva</label>
                        @if ($ho->terapia_intensiva)
                            <input type="radio" name="terapia_intensiva" id="" value="1" checked> SI
                            <input type="radio" name="terapia_intensiva" id="" value="0"> NO
                        @else
                            <input type="radio" name="terapia_intensiva" id="" value="1"> SI
                            <input type="radio" name="terapia_intensiva" id="" value="0" checked> NO
                        @endif
                        @if ($errors->has('terapia_intensiva'))
                            <small class="form-text text-danger">
                                {{ $errors->first('terapia_intensiva') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_ingreso_uti">Fecha de Ingreso a UTI</label>
                        <input type="date" name="fecha_ingreso_uti" id="" class="form-control" placeholder="Fecha de Ingreso a UTI" value="{{ $ho->fecha_ingreso_uti }}">
                        @if ($errors->has('fecha_ingreso_uti'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_ingreso_uti') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-12">
                        <label for="pregunta">Presenta</label>
                        @if (count($eb) > 0)
                            <input type="radio" name="pregunta" id="" value="1" checked> SI
                            <input type="radio" name="pregunta" id="" value="0"> NO
                            <input type="hidden" name="id_eb" value="@if(count($eb) > 0) {{ $eb->id_eb }} @else 0 @endif">
                        @else
                            <input type="radio" name="pregunta" id="" value="1"> SI
                            <input type="radio" name="pregunta" id="" value="0" checked> NO
                            <input type="hidden" name="id_eb" value="@if(count($eb) > 0) {{ $eb->id_eb }} @else 0 @endif">
                        @endif
                        @if ($errors->has('pregunta'))
                            <small class="form-text text-danger">
                                {{ $errors->first('pregunta') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_enf">Enfermedad</label>
                        <select name="id_enf[]" id="id_enf" class="select2" multiple="multiple" data-placeholder="Sintoma" style="width: 100%;">
                            @foreach ($enf as $e)
                                @if (array_search($e->id_enf,$enfermedad))
                                    <option value="{{ $e->id_enf }}" selected>{{ $e->enfermedad }}</option>
                                @else
                                    <option value="{{ $e->id_enf }}">{{ $e->enfermedad }}</option>
                                @endif
                            @endforeach
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_enf'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_enf') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otro_enfermedad">Otro</label>
                        <input type="text" name="otro_enfermedad" id="otro_enfermedad" class="form-control" placeholder="Otro" value="{{ old('otro_enfermedad') }}" disabled>
                        @if ($errors->has('otro'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO (desde el inicio de los sintomas)  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO (desde el inicio de los sintomas)</label>
                </div>
                <hr>
                <div class="row grupo">
                    <table id="tabla_sospechosos" class="table table-striped">
                        <tr>
                            <td colspan="7">
                                <button type="button" id="mas_sospechosos" class="btn btn-success"><i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <th>NOMBRE Y APELLIDOS</th>
                            <th>RELACION</th>
                            <th>EDAD</th>
                            <th>TELEFONO</th>
                            <th>DIRECCION</th>
                            <th>FECHA CONTACTO</th>
                            <th>LUGAR CONTACTO</th>
                        </tr>
                        <tbody>
                            @foreach ($co as $c)
                                <tr>
                                    <td>
                                        <input type="hidden" name="id_cont[]" value="{{ $c->id_cont }}">
                                        <input type="text" name="nombre_sospechoso[]" id="" class="form-control" placeholder="Nombre" value="{{ $c->nombre_contacto }}">
                                        <input type="text" name="paterno_sospechoso[]" id="" class="form-control" placeholder="Paterno" value="{{ $c->paterno_contacto }}">
                                        <input type="text" name="materno_sospechoso[]" id="" class="form-control" placeholder="Materno" value="{{ $c->materno_contacto }}">
                                    </td>
                                    <td>
                                        <select name="id_rel[]" id="" class="form-control">
                                            @foreach ($rel as $r)
                                                @if ($c->id_rel == $r->id_rel)
                                                    <option value="{{ $r->id_rel }}" selected>{{ $r->relacion }}</option>
                                                @else
                                                    <option value="{{ $r->id_rel }}">{{ $r->relacion }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="edad_sospechoso[]" id="" class="form-control" placeholder="Edad" value="{{ $c->edad }}">
                                    </td>
                                    <td>
                                        <input type="text" name="telefono_sospechoso[]" id="" class="form-control" placeholder="Teléfono" value="{{ $c->telefono }}">
                                    </td>
                                    <td>
                                        <input type="text" name="direccion_sospechoso[]" id="" class="form-control" placeholder="Dirección" value="{{ $c->direccion }}">
                                    </td>
                                    <td>
                                        <input type="date" name="fecha_sospechoso[]" id="" class="form-control" placeholder="fecha_contacto" value="{{ $c->fecha_contacto }}">
                                    </td>
                                    <td>
                                        <input type="text" name="lugar_sospechoso[]" id="" class="form-control" placeholder="Lugar de Contacto" value="{{ $c->lugar_contacto }}">
                                        <button type="button" id="eliminar_sospechosos" class="btn btn-danger botones"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">MODIFICAR</button>
                <a href="{{ url('home') }}" class="btn btn-danger">CANCELAR</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('extra')
    $(function() {
        // BUSQUEDA DE DATOS PERSONAS
        $('#busquedaPacienteBoton').click(function(){
            if($('#nombre').val() != '') {
                $.ajax({
                    url: 'http://192.168.0.104/api-project/public/api/students/'+$('#ci').val()+'/'+$('#fecha').val(),
                    dataType: "json",
                    method: "GET",
                    success: function(result)
                    {
                        alert("Coincidencia encontrada.");
                        $("#resultadoPaciente").show(1000);
                        $.each(result, function(i,item){
                            $('#id_pac').val(result[i].id_pac);
                            $('#resultadoPecienteNombre').val(result[i].nombre+' '+result[i].paterno+' '+result[i].materno);
                            if(result[i].sexo == 'M') {
                                $('#resultadoPacienteSexo').val('Masculino');
                            } else if (result[i].sexo == 'F') {
                                $('#resultadoPacienteSexo').val('Femenino');
                            }
                            $('#resultadoPacienteCi').val(result[i].ci+'-'+result[i].complemento);
                            $('#resultadoPacienteExpedido').val(result[i].expedido);
                            $('#resultadoPacienteFecha').val(result[i].fecha_nacimiento);
                            $('#resultadoPacienteTelefono').val(result[i].telefono);
                        });
                        $('#loader').css('display','none');
                    },
                    fail: function() {
                        alert("fallo");
                    },
                    beforeSend: function() {
                        $('#loader').css('display','inline');
                    },
                    error: function(xhr, status, error) {
                        alert("No se encontro ninguna coincidencia.");
                    }
                });
            }
        });

        $('.select2').select2()

        $('#sintoma').on('change', function(){
            if($(this).val().indexOf('otro') != -1) {
                $("#otro_sintoma").attr('disabled',false);
            } else {
                $("#otro_sintoma").attr('disabled',true);
            }
        });

        $('#id_estado').on('change', function(){
            if($('#id_estado option:selected').text() == "Fallecido") {
                $("#fecha_estado").attr('disabled',false);
            } else {
                $("#fecha_estado").attr('disabled',true);
                $("#fecha_estado").attr('value','');
            }
        });

        $('#id_dia').on('change', function(){
            if($(this).val().indexOf('otro') != -1) {
                $("#otro_diagnostico").attr('disabled',false);
            } else {
                $("#otro_diagnostico").attr('disabled',true);
            }
        });

        $('#id_ocu').on('change', function(){
            if($(this).val().indexOf('otro') != -1) {
                $("#otro_ocupacion").attr('disabled',false);
            } else {
                $("#otro_ocupacion").attr('disabled',true);
            }
        });

        $('#id_enf').on('change', function(){
            if($(this).val().indexOf('otro') != -1) {
                $("#otro_enfermedad").attr('disabled',false);
            } else {
                $("#otro_enfermedad").attr('disabled',true);
            }
        });

        $("#mas_sospechosos").on('click', function() {
            $('#tabla_sospechosos > tbody:last').append('<tr><td><input type="text" name="nombre_sospechoso[]" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre_sospechoso') }}"><input type="text" name="paterno_sospechoso[]" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno_sospechoso') }}"><input type="text" name="materno_sospechoso[]" id="" class="form-control" placeholder="Materno" value="{{ old('materno_sospechoso') }}"></td><td><select name="id_rel[]" id="" class="form-control">@foreach ($rel as $r)<option value="{{ $r->id_rel }}">{{ $r->relacion }}</option>@endforeach</select></td><td><input type="number" name="edad_sospechoso[]" id="" class="form-control" placeholder="Edad" value="{{ old('edad_sospechoso') }}"></td><td><input type="text" name="telefono_sospechoso[]" id="" class="form-control" placeholder="Teléfono" value="{{ old('telefono_sospechoso') }}"></td><td><input type="text" name="direccion_sospechoso[]" id="" class="form-control" placeholder="Dirección" value="{{ old('direccion_sospechoso') }}"></td><td><input type="date" name="fecha_sospechoso[]" id="" class="form-control" placeholder="fecha_contacto" value="{{ old('fecha_sospechoso') }}"></td><td><input type="text" name="lugar_sospechoso[]" id="" class="form-control" placeholder="Lugar de Contacto" value="{{ old('lugar_sospechoso') }}"><button type="button" id="eliminar_sospechosos" class="btn btn-danger botones"><i class="fas fa-times"></i></button></td></tr>');
        });

        $("#tabla_sospechosos").on('click', '.botones', function() {
            $(this).parents("tr").remove();
        });

        $('#id_mue').on('change', function(){
            if($(this).val().indexOf('otro') != -1) {
                $("#otro_muestra").attr('disabled',false);
            } else {
                $("#muestra").attr('disabled',true);
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
