@extends('template/base')

@section('content')
<br>
<div class="row">
    <br>
    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">FICHA EPIDEMIOLOGICA Y SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19</h3>
        </div>
        <form role="form" method="POST" action="">
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
                        <input type="text" name="establecimiento" id="" class="form-control" placeholder="Establecimiento de Salud" value="{{ old('establecimiento') }}">
                        @if ($errors->has('establecimiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('establecimiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="codigo">Código Establecimiento</label>
                        <input type="text" name="codigo" id="" class="form-control" placeholder="Código Establecimiento" value="{{ old('codigo') }}">
                        @if ($errors->has('codigo'))
                            <small class="form-text text-danger">
                                {{ $errors->first('codigo') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="red">Red de Salud</label>
                        <input type="text" name="codiredgo" id="" class="form-control" placeholder="Red de Salud" value="{{ old('red') }}">
                        @if ($errors->has('red'))
                            <small class="form-text text-danger">
                                {{ $errors->first('red') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="departamento">Departamento</label>
                        <select name="departamento" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('departamento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('departamento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio">Municipio</label>
                        <input type="text" name="municipio" id="" class="form-control" placeholder="Municipio" value="{{ old('municipio') }}">
                        @if ($errors->has('municipio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('municipio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_notificacion">Fecha de Notificación</label>
                        <input type="text" name="fecha_notificacion" id="" class="form-control" placeholder="Fecha de Notificación" value="{{ old('fecha_notificacion') }}">
                        @if ($errors->has('fecha_notificacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_notificacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sem_epidem">Sem Epidem</label>
                        <input type="text" name="sem_epidem" id="" class="form-control" placeholder="Sem Epidem" value="{{ old('sem_epidem') }}">
                        @if ($errors->has('sem_epidem'))
                            <small class="form-text text-danger">
                                {{ $errors->first('sem_epidem') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="caso_identificado">Caso identificado por busqueda activa</label>
                        <input type="text" name="caso_identificado" id="" class="form-control" placeholder="Establecimiento de Salud" value="{{ old('caso_identificado') }}">
                        @if ($errors->has('caso_identificado'))
                            <small class="form-text text-danger">
                                {{ $errors->first('caso_identificado') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  2. IDENTIFICACION DEL CASO/PACIENTE  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">2. IDENTIFICACION DEL CASO/PACIENTE</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="paterno">Paterno</label>
                        <input type="text" name="paterno" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno') }}">
                        @if ($errors->has('paterno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="materno">Materno</label>
                        <input type="text" name="materno" id="" class="form-control" placeholder="Materno" value="{{ old('materno') }}">
                        @if ($errors->has('materno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="" class="form-control">
                            <option value="f">Femenino</option>
                            <option value="m">Masculino</option>
                        </select>
                        @if ($errors->has('sexo'))
                            <small class="form-text text-danger">
                                {{ $errors->first('sexo') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ci">Nº Carnet de Identidad/Pasaporte</label>
                        <input type="text" name="ci" id="" class="form-control" placeholder="Nº Carnet de Identidad/Pasaporte" value="{{ old('ci') }}">
                        @if ($errors->has('ci'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ci') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_nac">Fecha de Nacimiento</label>
                        <input type="text" name="fecha_nac" id="" class="form-control" placeholder="Fecha de Nacimiento" value="{{ old('fecha_nac') }}">
                        @if ($errors->has('fecha_nac'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_nac') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="edad">Edad</label>
                        <input type="number" name="edad" id="" class="form-control" placeholder="Edad" value="{{ old('edad') }}">
                        @if ($errors->has('edad'))
                            <small class="form-text text-danger">
                                {{ $errors->first('edad') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_dep">Lugar de residencia; Departamento</label>
                        <select name="id_dep" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_dep'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_dep') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_mun">Municipio</label>
                        <input type="text" name="id_mun" id="" class="form-control" placeholder="Municipio" value="{{ old('id_mun') }}">
                        @if ($errors->has('id_mun'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_mun') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_pai">País</label>
                        <select name="ip_pai" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_pai'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_pai') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="calle">Calle</label>
                        <input type="text" name="calle" id="" class="form-control" placeholder="Calle" value="{{ old('calle') }}">
                        @if ($errors->has('calle'))
                            <small class="form-text text-danger">
                                {{ $errors->first('calle') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="zona">Zona</label>
                        <input type="text" name="zona" id="" class="form-control" placeholder="Zona" value="{{ old('zona') }}">
                        @if ($errors->has('zona'))
                            <small class="form-text text-danger">
                                {{ $errors->first('zona') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="num">Nº</label>
                        <input type="text" name="num" id="" class="form-control" placeholder="Nº" value="{{ old('num') }}">
                        @if ($errors->has('num'))
                            <small class="form-text text-danger">
                                {{ $errors->first('num') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="" class="form-control" placeholder="Teléfono" value="{{ old('telefono') }}">
                        @if ($errors->has('telefono'))
                            <small class="form-text text-danger">
                                {{ $errors->first('telefono') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-11">
                        <label for="menor">¿Es menor de edad?</label>
                        <input type="text" name="menor" id="" class="form-control" placeholder="menor" value="{{ old('menor') }}">
                        @if ($errors->has('menor'))
                            <small class="form-text text-danger">
                                {{ $errors->first('menor') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-1 text-center">
                        <button class="btn btn-success"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="form-group col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>NOMBRE</th>
                                <TH>RELACION</TH>
                                <th>TELEFONO</th>
                            </tr>
                            <tr>
                                <td>Uno</td>
                                <td>Dos</td>
                                <td>Tres</td>
                            </tr>
                        </table>
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
                        <select name="id_ocu" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_ocu'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_ocu') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otro">Otro</label>
                        <input type="text" name="otro" id="" class="form-control" placeholder="Ocupación" value="{{ old('otro') }}">
                        @if ($errors->has('otro'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vacuna_influenza">Antecedente de vacunación para influenza</label>
                        <input type="text" name="vacuna_influenza" id="" class="form-control" placeholder="Antecedente de vacunación para influenza" value="{{ old('vacuna_influenza') }}">
                        @if ($errors->has('vacuna_influenza'))
                            <small class="form-text text-danger">
                                {{ $errors->first('vacuna_influenza') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_vacunacion">Fecha</label>
                        <input type="text" name="fecha_vacunacion" id="" class="form-control" placeholder="Fecha" value="{{ old('fecha_vacunacion') }}">
                        @if ($errors->has('fecha_vacunacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_vacunacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="viaje_riesgo">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?</label>
                        <input type="text" name="viaje_riesgo" id="" class="form-control" placeholder="¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?" value="{{ old('viaje_riesgo') }}">
                        @if ($errors->has('viaje_riesgo'))
                            <small class="form-text text-danger">
                                {{ $errors->first('viaje_riesgo') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="id_pai">País</label>
                        <select name="ip_pai" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_pai'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_pai') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad">Ciudad</label>
                        <select name="ciudad" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('ciudad'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ciudad') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_retorno">Fecha de retorno de viaje</label>
                        <input type="text" name="fecha_retorno" id="" class="form-control" placeholder="Fecha de retorno de viaje" value="{{ old('fecha_retorno') }}">
                        @if ($errors->has('fecha_retorno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_retorno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="hora_retorno">Hora</label>
                        <input type="text" name="hora_retorno" id="" class="form-control" placeholder="Hora" value="{{ old('hora_retorno') }}">
                        @if ($errors->has('hora_retorno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('hora_retorno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="empresa_viaje">Empresa</label>
                        <input type="text" name="empresa_viaje" id="" class="form-control" placeholder="Empresa" value="{{ old('empresa_viaje') }}">
                        @if ($errors->has('empresa_viaje'))
                            <small class="form-text text-danger">
                                {{ $errors->first('empresa_viaje') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_vuelo">Nº vuelo</label>
                        <input type="text" name="num_vuelo" id="" class="form-control" placeholder="Nº vuelo" value="{{ old('num_vuelo') }}">
                        @if ($errors->has('num_vuelo'))
                            <small class="form-text text-danger">
                                {{ $errors->first('num_vuelo') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_asiento">Nº asiento</label>
                        <input type="text" name="num_asiento" id="" class="form-control" placeholder="Nº asiento" value="{{ old('num_asiento') }}">
                        @if ($errors->has('num_asiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('num_asiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contacto">¿Tuvo contacto con un caso confirmado de COVID+19 en los 14 días previos al inicio de sinstimos, edomicilio o establecimiento de salud?</label>
                        <input type="text" name="contacto" id="" class="form-control" placeholder="¿Tuvo contacto con un caso confirmado de COVID+19 en los 14 días previos al inicio de sinstimos, edomicilio o establecimiento de salud?" value="{{ old('contacto') }}">
                        @if ($errors->has('contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_contacto">Fecha de contacto</label>
                        <input type="text" name="fecha_contacto" id="" class="form-control" placeholder="Fecha de contacto" value="{{ old('fecha_contacto') }}">
                        @if ($errors->has('fecha_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre (del caso positivo)</label>
                        <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="paterno">Paterno (del caso positivo)</label>
                        <input type="text" name="paterno" id="" class="form-control" placeholder="Nombre" value="{{ old('paterno') }}">
                        @if ($errors->has('paterno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="materno">Materno (del caso positivo)</label>
                        <input type="text" name="materno" id="" class="form-control" placeholder="Nombre" value="{{ old('materno') }}">
                        @if ($errors->has('materno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono_contacto">Teléfono (del caso positivo)</label>
                        <input type="text" name="telefono_contacto" id="" class="form-control" placeholder="Teléfono del caso positivo" value="{{ old('telefono_contacto') }}">
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
                        <label for="id_pai">País</label>
                        <select name="ip_pai" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('id_pai'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_pai') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="departamento_contacto">Departamento / Estado</label>
                        <select name="departamento" id="" class="form-control">
                            <option value="otro">Otro</option>
                        </select>
                        @if ($errors->has('departamento_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('departamento_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio">Municipio</label>
                        <input type="text" name="municipio" id="" class="form-control" placeholder="Municipio" value="{{ old('municipio') }}">
                        @if ($errors->has('municipio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('municipio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad">Ciudad / Localidad</label>
                        <input type="text" name="ciudad" id="" class="form-control" placeholder="Ciudad / Localidad" value="{{ old('ciudad') }}">
                        @if ($errors->has('ciudad'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ciudad') }}
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
                    <div class="form-group col-md-6">
                        <label for="fecha_inicio">Fecha de inicio de síntomas</label>
                        <input type="text" name="fecha_inicio" id="" class="form-control" placeholder="Fecha de inicio de síntomas" value="{{ old('fecha_inicio') }}">
                        @if ($errors->has('fecha_inicio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_inicio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_inicio">Síntomas</label>
                        <input type="text" name="fecha_inicio" id="" class="form-control" placeholder="Fecha de inicio de síntomas" value="{{ old('fecha_inicio') }}">
                        @if ($errors->has('fecha_inicio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_inicio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="otro">Otro</label>
                        <input type="text" name="otro" id="" class="form-control" placeholder="Otro" value="{{ old('otro') }}">
                        @if ($errors->has('otro'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="id_estado">Estado actual del paciente (al momento del reporte)</label>
                        <input type="text" name="id_estado" id="" class="form-control" placeholder="Otro" value="{{ old('id_estado') }}">
                        @if ($errors->has('id_estado'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_estado') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="id_dia">Diagnostico Clinico</label>
                        <input type="text" name="id_dia" id="" class="form-control" placeholder="Diagnostico Clinico" value="{{ old('id_dia') }}">
                        @if ($errors->has('id_dia'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_dia') }}
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
                        <input type="text" name="fecha_aislamiento" id="" class="form-control" placeholder="Fecha de aislamiento" value="{{ old('fecha_aislamiento') }}">
                        @if ($errors->has('fecha_aislamiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_aislamiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lugar_aislamiento">Lugar de aislamiento</label>
                        <input type="text" name="lugar_aislamiento" id="" class="form-control" placeholder="Lugar de aislamiento" value="{{ old('lugar_aislamiento') }}">
                        @if ($errors->has('lugar_aislamiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('lugar_aislamiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_internacion">Fecha de internación</label>
                        <input type="text" name="fecha_internacion" id="" class="form-control" placeholder="Fecha de internación" value="{{ old('fecha_internacion') }}">
                        @if ($errors->has('fecha_internacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_internacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="establecimiento">Establecimiento de salud de Internación</label>
                        <input type="text" name="establecimiento" id="" class="form-control" placeholder="Establecimiento de salud de Internación" value="{{ old('establecimiento') }}">
                        @if ($errors->has('establecimiento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('establecimiento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ventilacion">Ventilación mecánica</label>
                        <input type="text" name="ventilacion" id="" class="form-control" placeholder="Ventilación mecánica" value="{{ old('ventilacion') }}">
                        @if ($errors->has('ventilacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ventilacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="terapia_intensiva">Terapia intensiva</label>
                        <input type="text" name="terapia_intensiva" id="" class="form-control" placeholder="Terapia intensiva" value="{{ old('terapia_intensiva') }}">
                        @if ($errors->has('terapia_intensiva'))
                            <small class="form-text text-danger">
                                {{ $errors->first('terapia_intensiva') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_ingreso_uti">Fecha de Ingreso a UTI</label>
                        <input type="text" name="fecha_ingreso_uti" id="" class="form-control" placeholder="Fecha de Ingreso a UTI" value="{{ old('fecha_ingreso_uti') }}">
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
                    <div class="form-group col-md-6">
                        <label for="pregunta">Presenta</label>
                        <input type="text" name="pregunta" id="" class="form-control" placeholder="Presenta" value="{{ old('pregunta') }}">
                        @if ($errors->has('pregunta'))
                            <small class="form-text text-danger">
                                {{ $errors->first('pregunta') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_enf">Enfermedad</label>
                        <input type="text" name="id_enf" id="" class="form-control" placeholder="Enfermedad" value="{{ old('id_enf') }}">
                        @if ($errors->has('id_enf'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_enf') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="otro">Otro</label>
                        <input type="text" name="otro" id="" class="form-control" placeholder="Otro" value="{{ old('otro') }}">
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
                    <div class="form-group col-md-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paterno">Paterno</label>
                        <input type="text" name="paterno" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno') }}">
                        @if ($errors->has('paterno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="materno">Materno</label>
                        <input type="text" name="materno" id="" class="form-control" placeholder="Materno" value="{{ old('materno') }}">
                        @if ($errors->has('materno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_rel">Relacion</label>
                        <input type="text" name="id_rel" id="" class="form-control" placeholder="Materno" value="{{ old('id_rel') }}">
                        @if ($errors->has('id_rel'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_rel') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="edad">Edad</label>
                        <input type="text" name="edad" id="" class="form-control" placeholder="Edad" value="{{ old('edad') }}">
                        @if ($errors->has('edad'))
                            <small class="form-text text-danger">
                                {{ $errors->first('edad') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="" class="form-control" placeholder="Teléfono" value="{{ old('telefono') }}">
                        @if ($errors->has('telefono'))
                            <small class="form-text text-danger">
                                {{ $errors->first('telefono') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="" class="form-control" placeholder="Dirección" value="{{ old('direccion') }}">
                        @if ($errors->has('direccion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('direccion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_contacto">Fecha de contacto</label>
                        <input type="text" name="fecha_contacto" id="" class="form-control" placeholder="fecha_contacto" value="{{ old('fecha_contacto') }}">
                        @if ($errors->has('fecha_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lugar_contacto">Lugar contacto</label>
                        <input type="text" name="lugar_contacto" id="" class="form-control" placeholder="fecha_contacto" value="{{ old('lugar_contacto') }}">
                        @if ($errors->has('lugar_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('lugar_contacto') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  8. LABORATORIO  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">8. LABORATORIO</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-6">
                        <label for="muestra">Se tomó la muestra para Laboratorio</label>
                        <input type="text" name="muestra" id="" class="form-control" placeholder="Se tomó la muestra para Laboratorio" value="{{ old('muestra') }}">
                        @if ($errors->has('muestra'))
                            <small class="form-text text-danger">
                                {{ $errors->first('muestra') }}
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
                        <input type="text" name="id_mue" id="" class="form-control" placeholder="Tipo de muestra tomada" value="{{ old('id_mue') }}">
                        @if ($errors->has('id_mue'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_mue') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="otro_muestra">Otro</label>
                        <input type="text" name="otro_muestra" id="" class="form-control" placeholder="Otro" value="{{ old('otro_muestra') }}">
                        @if ($errors->has('otro_muestra'))
                            <small class="form-text text-danger">
                                {{ $errors->first('otro_muestra') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nombre_laboratorio">Nombre de Laboratorio que procesara la muestra</label>
                        <input type="text" name="nombre_laboratorio" id="" class="form-control" placeholder="Nombre de Laboratorio que procesara la muestra" value="{{ old('nombre_laboratorio') }}">
                        @if ($errors->has('nombre_laboratorio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre_laboratorio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_muestra">Fecha de toma de muestra</label>
                        <input type="text" name="fecha_muestra" id="" class="form-control" placeholder="Fecha de toma de muestra" value="{{ old('fecha_muestra') }}">
                        @if ($errors->has('fecha_muestra'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_muestra') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_envio">Fecha de envío</label>
                        <input type="text" name="fecha_envio" id="" class="form-control" placeholder="Fecha envío" value="{{ old('fecha_envio') }}">
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
                        <input type="text" name="observaciones" id="" class="form-control" placeholder="Observaciones" value="{{ old('observaciones') }}">
                        @if ($errors->has('observaciones'))
                            <small class="form-text text-danger">
                                {{ $errors->first('observaciones') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="resultado">Resultado</label>
                        <input type="text" name="resultado" id="" class="form-control" placeholder="Resultado" value="{{ old('resultado') }}">
                        @if ($errors->has('resultado'))
                            <small class="form-text text-danger">
                                {{ $errors->first('resultado') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_resultado">Fecha</label>
                        <input type="text" name="fecha_resultado" id="" class="form-control" placeholder="Fecha Resultado" value="{{ old('fecha_resultado') }}">
                        @if ($errors->has('fecha_resultado'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_resultado') }}
                            </small>
                        @endif
                    </div>
                </div>
                <hr>
                {{--  DATOS DEL PERSONAL QUE NOTIFICA  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">DATOS DEL PERSONAL QUE NOTIFICA</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paterno">Paterno</label>
                        <input type="text" name="paterno" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno') }}">
                        @if ($errors->has('paterno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="materno">Materno</label>
                        <input type="text" name="paterno" id="" class="form-control" placeholder="Materno" value="{{ old('materno') }}">
                        @if ($errors->has('materno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="tel_cel">Teléfono / Celular</label>
                        <input type="text" name="tel_cel" id="" class="form-control" placeholder="Teléfono / Celular" value="{{ old('tel_cel') }}">
                        @if ($errors->has('tel_cel'))
                            <small class="form-text text-danger">
                                {{ $errors->first('tel_cel') }}
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop