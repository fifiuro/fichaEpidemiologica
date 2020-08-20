@extends('template/base')

@section('content')
<br>
<div class="row">
    <br>
    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">FICHA EPIDEMIOLOGICA Y SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19</h3>
        </div>
        <form role="form" method="POST" action="{{ url('nuevo') }}" id="quickForm">
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
                        <input type="text" name="red" id="" class="form-control" placeholder="Red de Salud" value="{{ old('red') }}" required>
                        @if ($errors->has('red'))
                            <small class="form-text text-danger">
                                {{ $errors->first('red') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="departamento">Departamento</label>
                        <select name="departamento" id="" class="form-control" required>
                            @foreach ($dep as $d)
                                <option value="{{ $d->id_dep }}">{{ $d->departamento }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('departamento'))
                            <small class="form-text text-danger">
                                {{ $errors->first('departamento') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio">Municipio</label>
                        <input type="text" name="municipio" id="" class="form-control" placeholder="Municipio" value="{{ old('municipio') }}" required>
                        @if ($errors->has('municipio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('municipio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_notificacion">Fecha de Notificación</label>
                        <input type="date" name="fecha_notificacion" id="" class="form-control" value="{{ old('fecha_notificacion') }}" required>
                        @if ($errors->has('fecha_notificacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_notificacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sem_epidem">Sem Epidem</label>
                        <input type="text" name="sem_epidem" id="" class="form-control" placeholder="Sem Epidem" value="{{ old('sem_epidem') }}" required>
                        @if ($errors->has('sem_epidem'))
                            <small class="form-text text-danger">
                                {{ $errors->first('sem_epidem') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="caso_identificado">Caso identificado por busqueda activa</label>
                        <input type="radio" name="caso_identificado" id="" value="1" checked> SI
                        <input type="radio" name="caso_identificado" id="" value="0"> NO
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
                        <label for="nombre_pacientes">Nombre</label>
                        <input type="text" name="nombre_pacientes" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre_pacientes') }}" required>
                        @if ($errors->has('nombre_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="paterno_pacientes">Paterno</label>
                        <input type="text" name="paterno_pacientes" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno_pacientes') }}" required>
                        @if ($errors->has('paterno_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno_pacientes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="materno_pacientes">Materno</label>
                        <input type="text" name="materno_pacientes" id="" class="form-control" placeholder="Materno" value="{{ old('materno_pacientes') }}">
                        @if ($errors->has('materno_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno_pacientes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="seguro_pacientes">Num. Seguro</label>
                        <input type="text" name="seguro_pacientes" id="" class="form-control" placeholder="Materno" value="{{ old('seguro_pacientes') }}">
                        @if ($errors->has('seguro_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('seguro_pacientes') }}
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
                    <div class="form-group col-md-3">
                        <label for="ci">Nº Carnet de Identidad/Pasaporte</label>
                        <input type="text" name="ci" id="" class="form-control" placeholder="Nº Carnet de Identidad/Pasaporte" value="{{ old('ci') }}">
                        @if ($errors->has('ci'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ci') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="expedido">Expedido</label>
                        <select name="expedido" id="" class="form-control">
                            @foreach ($dep as $d)
                                <option value="{{ $d->id_dep }}">{{ $d->departamento }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('ci'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ci') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_nac">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nac" id="" class="form-control" placeholder="Fecha de Nacimiento" value="{{ old('fecha_nac') }}">
                        @if ($errors->has('fecha_nac'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_nac') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="edad_pacientes">Edad</label>
                        <input type="text" name="edad_pacientes" id="" class="form-control" placeholder="Edad" value="{{ old('edad_pacientes') }}">
                        @if ($errors->has('edad_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('edad_pacientes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_pai_pacientes">Lugar de residencia: País</label>
                        <select name="id_pai_pacientes" id="" class="form-control">
                            @foreach ($pai as $p)
                                <option value="{{ $p->id_pai }}">{{ $p->pais }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_pai_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_pai_pacientes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="id_dep_pacientes">Departamento</label>
                        <select name="id_dep_pacientes" id="" class="form-control">
                            @foreach ($dep as $d)
                                <option value="{{ $d->id_dep }}">{{ $d->departamento }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_dep_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('id_dep_pacientes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="municipio_paciente">Municipio</label>
                        <input type="text" name="municipio_paciente" id="" class="form-control" placeholder="Municipio" value="{{ old('municipio_paciente') }}">
                        @if ($errors->has('municipio_paciente'))
                            <small class="form-text text-danger">
                                {{ $errors->first('municipio_paciente') }}
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
                        <label for="telefono_pacientes">Teléfono</label>
                        <input type="text" name="telefono_pacientes" id="" class="form-control" placeholder="Teléfono" value="{{ old('telefono_pacientes') }}">
                        @if ($errors->has('telefono_pacientes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('telefono_pacientes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-11">
                        <label for="menor">¿Es menor de edad?</label>
                        <input type="radio" name="menor" value="1" checked> SI
                        <input type="radio" name="menor" value="0"> NO
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
                                <td>
                                    <input type="text" name="nombre_relacion" id="" class="form-control" placeholder="Nombre">
                                    <input type="text" name="paterno_relacion" id="" class="form-control" placeholder="Paterno">
                                    <input type="text" name="materno_relacion" id="" class="form-control" placeholder="Materno">
                                </td>
                                <td>
                                    <select name="id_rel_pacientes" id="" class="form-control">
                                        @foreach ($rel as $r)
                                            <option value="{{ $r->id_rel }}">{{ $r->relacion }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="tel_cel_pacientes" id="" class="form-control" placeholder="Telefono / Celular">
                                </td>
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
                        <select name="id_ocu" id="id_ocu" class="form-control">
                            @foreach ($ocu as $o)
                                <option value="{{ $o->id_ocu }}">{{ $o->ocupacion }}</option>
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
                        <input type="radio" name="vacuna_influenza" id="" value="1" checked> SI
                        <input type="radio" name="vacuna_influenza" id="" value="0"> NO
                        @if ($errors->has('vacuna_influenza'))
                            <small class="form-text text-danger">
                                {{ $errors->first('vacuna_influenza') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_vacunacion">Fecha</label>
                        <input type="date" name="fecha_vacunacion" id="" class="form-control" placeholder="Fecha" value="{{ old('fecha_vacunacion') }}">
                        @if ($errors->has('fecha_vacunacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_vacunacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="viaje_riesgo">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?</label>
                        <input type="radio" name="viaje_riesgo" id="" value="1" checked> SI
                        <input type="radio" name="viaje_riesgo" id="" value="0"> NO
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
                                <option value="{{ $p->id_pai }}">{{ $p->pais }}</option>
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
                        <input type="text" name="ciudad_antecedentes" id="" class="form-control" placeholder="ciudad_antecedentes">
                        @if ($errors->has('ciudad_antecedentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ciudad_antecedentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_retorno">Fecha de retorno de viaje</label>
                        <input type="date" name="fecha_retorno" id="" class="form-control" placeholder="Fecha de retorno de viaje" value="{{ old('fecha_retorno') }}">
                        @if ($errors->has('fecha_retorno'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_retorno') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="hora_retorno">Hora</label>
                        <input type="time" name="hora_retorno" id="" class="form-control" placeholder="Hora" value="{{ old('hora_retorno') }}">
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
                        <label for="contacto_antecedentes">¿Tuvo contacto con un caso confirmado de COVID+19 en los 14 días previos al inicio de sinstimos, edomicilio o establecimiento de salud?</label>
                        <input type="radio" name="contacto_antecedentes" id="" value="1" checked> SI
                        <input type="radio" name="contacto_antecedentes" id="" value="0"> NO
                        @if ($errors->has('contacto_antecedentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('contacto_antecedentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_contacto_antecentes">Fecha de contacto</label>
                        <input type="date" name="fecha_contacto_antecentes" id="" class="form-control" placeholder="Fecha de contacto" value="{{ old('fecha_contacto_antecentes') }}">
                        @if ($errors->has('fecha_contacto_antecentes'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_contacto_antecentes') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombre_contacto">Nombre (del caso positivo)</label>
                        <input type="text" name="nombre_contacto" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre_contacto') }}">
                        @if ($errors->has('nombre_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('nombre_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="paterno_contacto">Paterno (del caso positivo)</label>
                        <input type="text" name="paterno_contacto" id="" class="form-control" placeholder="Nombre" value="{{ old('paterno_contacto') }}">
                        @if ($errors->has('paterno_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('paterno_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="materno_contacto">Materno (del caso positivo)</label>
                        <input type="text" name="materno_contacto" id="" class="form-control" placeholder="Nombre" value="{{ old('materno_contacto') }}">
                        @if ($errors->has('materno_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('materno_contacto') }}
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
                        <label for="id_pai_contacto">País</label>
                        <select name="id_pai_contacto" id="" class="form-control">
                            @foreach ($pai as $p)
                                <option value="{{ $p->id_pai }}">{{ $p->pais }}</option>
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
                        <input type="text" name="departamento_contacto" id="" class="form-control" placeholder="Departamento / Estado" value="{{ old('departamento_contacto') }}">
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
                        <input type="text" name="municipio_contacto" id="" class="form-control" placeholder="Municipio" value="{{ old('municipio_contacto') }}">
                        @if ($errors->has('municipio_contacto'))
                            <small class="form-text text-danger">
                                {{ $errors->first('municipio_contacto') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_contacto">Ciudad / Localidad</label>
                        <input type="text" name="ciudad_contacto" id="" class="form-control" placeholder="Ciudad / Localidad" value="{{ old('ciudad_contacto') }}">
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
                    <div class="form-group col-md-12">
                        <label for="fecha_inicio">Fecha de inicio de síntomas</label>
                        <input type="date" name="fecha_inicio" id="" class="form-control" placeholder="Fecha de inicio de síntomas" value="{{ old('fecha_inicio') }}">
                        @if ($errors->has('fecha_inicio'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_inicio') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sintoma">Síntomas</label>
                        {{--  <select name="sintoma[]" id="" class="form-control" multiple>  --}}
                        <select name="sintoma[]" id="sintoma" class="select2" multiple="multiple" data-placeholder="Sintoma" style="width: 100%;">
                            @foreach ($sin as $s)
                                <option value="{{ $s->id_sin }}">{{ $s->sintoma }}</option>
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
                                <option value="{{ $e->id_est }}">{{ $e->nombre }}</option>
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
                        <input type="date" name="fecha_estado" id="fecha_estado" class="form-control" disabled>
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
                                <option value="{{ $d->id_dia }}">{{ $d->diagnostico }}</option>
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
                        <input type="date" name="fecha_aislamiento" id="" class="form-control" placeholder="Fecha de aislamiento" value="{{ old('fecha_aislamiento') }}">
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
                        <input type="date" name="fecha_internacion" id="" class="form-control" placeholder="Fecha de internación" value="{{ old('fecha_internacion') }}">
                        @if ($errors->has('fecha_internacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('fecha_internacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="establecimiento_internacion">Establecimiento de salud de Internación</label>
                        <input type="text" name="establecimiento_internacion" id="" class="form-control" placeholder="Establecimiento de salud de Internación" value="{{ old('establecimiento') }}">
                        @if ($errors->has('establecimiento_internacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('establecimiento_internacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ventilacion">Ventilación mecánica</label>
                        <input type="radio" name="ventilacion" id="" value="1" checked> SI
                        <input type="radio" name="ventilacion" id="" value="0"> NO
                        @if ($errors->has('ventilacion'))
                            <small class="form-text text-danger">
                                {{ $errors->first('ventilacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="terapia_intensiva">Terapia intensiva</label>
                        <input type="radio" name="terapia_intensiva" id="" value="1" checked> SI
                        <input type="radio" name="terapia_intensiva" id="" value="0"> NO
                        @if ($errors->has('terapia_intensiva'))
                            <small class="form-text text-danger">
                                {{ $errors->first('terapia_intensiva') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_ingreso_uti">Fecha de Ingreso a UTI</label>
                        <input type="date" name="fecha_ingreso_uti" id="" class="form-control" placeholder="Fecha de Ingreso a UTI" value="{{ old('fecha_ingreso_uti') }}">
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
                        <input type="radio" name="pregunta" id="" value="1" checked> SI
                        <input type="radio" name="pregunta" id="" value="0"> NO
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
                                <option value="{{ $e->id_enf }}">{{ $e->enfermedad }}</option>
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
                            <tr>
                                <td>
                                    <input type="text" name="nombre_sospechoso[]" id="" class="form-control" placeholder="Nombre" value="{{ old('nombre_sospechoso') }}">
                                    <input type="text" name="paterno_sospechoso[]" id="" class="form-control" placeholder="Paterno" value="{{ old('paterno_sospechoso') }}">
                                    <input type="text" name="materno_sospechoso[]" id="" class="form-control" placeholder="Materno" value="{{ old('materno_sospechoso') }}">
                                </td>
                                <td>
                                    <select name="id_rel[]" id="" class="form-control">
                                        @foreach ($rel as $r)
                                            <option value="{{ $r->id_rel }}">{{ $r->relacion }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="edad_sospechoso[]" id="" class="form-control" placeholder="Edad" value="{{ old('edad_sospechoso') }}">
                                </td>
                                <td>
                                    <input type="text" name="telefono_sospechoso[]" id="" class="form-control" placeholder="Teléfono" value="{{ old('telefono_sospechoso') }}">
                                </td>
                                <td>
                                    <input type="text" name="direccion_sospechoso[]" id="" class="form-control" placeholder="Dirección" value="{{ old('direccion_sospechoso') }}">
                                </td>
                                <td>
                                    <input type="date" name="fecha_sospechoso[]" id="" class="form-control" placeholder="fecha_contacto" value="{{ old('fecha_sospechoso') }}">
                                </td>
                                <td>
                                    <input type="text" name="lugar_sospechoso[]" id="" class="form-control" placeholder="Lugar de Contacto" value="{{ old('lugar_sospechoso') }}">
                                    <button type="button" id="eliminar_sospechosos" class="btn btn-danger botones"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                {{--  8. LABORATORIO  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">8. LABORATORIO</label>
                </div>
                <hr>
                <div class="row grupo">
                    <div class="form-group col-md-6">
                        <label for="muestra_laboratorio">Se tomó la muestra para Laboratorio</label>
                        <input type="radio" name="muestra_laboratorio" id="" value="1" checked> SI
                        <input type="radio" name="muestra_laboratorio" id="" value="0"> NO
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
                <hr>
                {{--  DATOS DEL PERSONAL QUE NOTIFICA  --}}
                <div class="row">
                    <label for="" style="font-size:18px;">DATOS DEL PERSONAL QUE NOTIFICA</label>
                </div>
                <hr>
                <div class="row grupo">
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
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">GUARDAR</button>
                <a href="{{ url('/') }}" class="btn btn-danger">CANCELAR</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('extra')
    $(function() {
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
