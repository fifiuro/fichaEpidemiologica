<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            margin: 0;
        }
        table {
            width: 100%;
        }
        .titulo {
            text-align: center;
            font-size: 12px;
        }
        .sub-titulo {
            text-align: center;
            background-color: black;
            color: white;
        }
        .resultado {
            background-color: #eae9c4;
            color: black;
        }
        .parrafo {
            text-align: justify;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th class="titulo">FICHA EPIDEMIOLOGICA Y SOLICITUD DE ESTUDIOS<br>DE LABORATORIO COVID-19</th>
        </tr>
    </table>
    <table>
        <tr>
            <td class="sub-titulo">1. DATOS DE ESTABLECIMIENTO NOTIFICADOR</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Establecimiento de Salud</td>
            <td class="resultado">
                @if (count($est) > 0) {{ $est[0]->establecimiento }} @endif
                </td>
            <td>Cod. Estab.</td>
            <td class="resultado">@if (count($est) > 0) {{ $est[0]->codigo }} @endif</td>
            <td>Red de Salud</td>
            <td class="resultado">@if (count($est) > 0) {{ $est[0]->red }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Departamento</td>
            <td class="resultado">@if (count($est) > 0) {{ $est[0]->departamento }} @endif</td>
            <td>Municipio</td>
            <td class="resultado">@if (count($est) > 0) {{ $est[0]->municipio }} @endif</td>
            <td>Fecha de Notificación</td>
            <td class="resultado">@if (count($est) > 0) {{ formato_fecha($est[0]->fecha_notificacion) }} @endif</td>
            <td>Sem Epidem</td>
            <td class="resultado">@if (count($est) > 0) {{ $est[0]->sem_epidem }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Caso identificado por búsqueda activa</td>
            <td class="resultado">
                @if (count($est) > 0)
                    @if ($est[0]->caso_identificado)
                        SI
                    @else
                        NO
                    @endif
                @endif
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="sub-titulo">2. IDENTIFICACION DEL CASO / PACIENTE</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Nombre y Apellido</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->nombre_pacientes }} {{ $iden[0]->paterno_pacientes}} {{ $iden[0]->materno_pacientes }} @endif</td>
            <td>Seguro</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->seguro_pacientes }} @endif</td>
            <td>Sexo</td>
            <td class="resultado">
                @if (count($iden) > 0)
                    @if ($iden[0]->sexo == 'm')
                        Masculino
                    @elseif ($iden[0]->sexo == 'f')
                        Femenino
                    @endif
                @endif
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Nº Carnet de Identidad / Pasaporte</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->ci }} @endif</td>
            <td>Expedido</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->departamento }} @endif</td>
            <td>Fecha de Nacimiento</td>
            <td class="resultado">@if (count($iden) > 0) {{ formato_fecha($iden[0]->fecha_nac) }} @endif</td>
            <td>Edad</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->edad }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Lugar de Residentica: País</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->pais }} @endif</td>
            <td>Departamento</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->id_dep }} @endif</td>
            <td>Municipio</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->municipio_paciente }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Calle</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->calle }} @endif</td>
            <td>Zona</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->zona }} @endif</td>
            <td>Nº</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->num }} @endif</td>
            <td>Teléfono</td>
            <td class="resultado">@if (count($iden) > 0) {{ $iden[0]->telefono }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                Si es meno de edad Nombre del 
                @if (count($men) > 0)
                    {{ $men[0]->relacion }}
                @else
                    <strong>NO ES MENOR DE EDAD</strong>
                @endif
            </td>
            <td class="resultado">
                @if (count($men) > 0) {{ $men[0]->nombre_relacion }} {{ $men[0]->paterno_relacion }} {{ $men[0]->materno_relacion }} @endif
            </td>
            <td>Teléfono del apoderado</td>
            <td class="resultado">
                @if (count($men) > 0) {{ $men[0]->tel_cel }} @endif
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="sub-titulo">3. ANTECEDENTES EPIDEMIIOLOGICOS</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Ocupación</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->ocupacion }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Antecendente de vacunación para influenza</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->vacuna_influenza }} @endif</td>
            <td>Fecha</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->fecha_vacuna }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td><strong>¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?</strong></td>
            <td class="resultado">
                @if (count($ant) > 0)
                    @if ($ant[0]->viaje_riesgo)
                        SI
                    @else
                        NO
                    @endif
                @endif
            </td>
            <td>¿Dónde (país y ciudad?</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->id_pai }} {{ $ant[0]->ciudad }} @endif</td>
            <td>Fecha de retorno de viaje</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->fecha_retorno }} @endif</td>
            <td>Hora</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->hora_retorno }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Empresa</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->empresa_viaje }} @endif</td>
            <td>Nº vuel</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->num_vuelo }} @endif</td>
            <td>Nº asiento</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->num_asieto }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td><strong>¿Tuvo contacto con un caso confirmado de COVID-19 en los 14 días previos al inicio de síntomas, en domicilio o establecimiento de salud?</strong></td>
            <td class="resultado">
                @if (count($ant) > 0)
                    @if ($ant[0]->contacto)
                        SI
                    @else
                        NO
                    @endif
                @endif
            </td>
            <td>Fecha de Contacto</td>
            <td class="resultado">@if (count($ant) > 0) {{ formato_fecha($ant[0]->fecha_contacto) }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Nombre y Apellido (del caso positivo)</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->nombre_contacto }} {{ $ant[0]->paterno_contacto }} {{ $ant[0]->materno_contacto }} @endif</td>
            <td>Teléfono del (caso positivo)</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->telefono_contacto }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="8"><strong>Lugar de contacto con el caso positivo</strong></td>
        </tr>
        <tr>
            <td>País</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->pais_contacto }} @endif</td>
            <td>Departamento/Estado</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->departamento_contacto }} @endif</td>
            <td>Municipio</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->municipio_contacto }} @endif</td>
            <td>Ciudad/Localidad</td>
            <td class="resultado">@if (count($ant) > 0) {{ $ant[0]->ciudad_contacto }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="4" class="sub-titulo">4. DATOS CLINICOS</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Fecha de inicio de síntomas</td>
            <td class="resultado">@if (count($dat) > 0) {{ formato_fecha($dat[0]->fecha_inicio) }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="resultado">
                @if (count($sin) > 0)
                    @foreach ($sin as $s)
                        {{ $s->sintoma }}, 
                    @endforeach
                @endif
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Estado actual del paciente (al momento del reporte)</td>
            <td class="resultado">@if (count($dat) >  0) {{ $dat[0]->nombre }} @endif</td>
            <td>Fecha de defuncisón</td>
            <td class="resultado">@if (count($dat) > 0) {{ $dat[0]->fecha_estado }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Diagnostico clinico</td>
            <td class="resultado">@if (count($dat) > 0) {{ $dat[0]->diagnostico }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="6" class="sub-titulo">5. DATOS EN CASO DE HOSPITALIZACION Y/O AISLAMIENTO</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Fecha de aislamiento</td>
            <td class="resultado">@if (count($hos) > 0) {{ formato_fecha($hos[0]->fecha_aislamiento) }} @endif</td>
            <td>Lugar de Aislamiento</td>
            <td class="resultado">@if (count($hos) > 0) {{ $hos[0]->lugar_aislamiento }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Fecha de internacion</td>
            <td class="resultado">@if (count($hos) > 0) {{ formato_fecha($hos[0]->fecha_internacion) }} @endif</td>
            <td>Establecimiento de salud de internación</td>
            <td class="resultado">@if (count($hos) > 0) {{ $hos[0]->establecimiento }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Ventilación mecánica</td>
            <td class="resultado">
                @if (count($hos) > 0)
                    @if ($hos[0]->ventilacion)
                        SI
                    @else
                        NO
                    @endif
                @endif
            </td>
            <td>Terapia Intensiva</td>
            <td class="resultado">
                @if (count($hos) > 0)
                    @if ($hos[0]->terapia_intensiva)
                        SI
                    @else
                        NO
                    @endif
                @endif
            </td>
            <td>Fecha Ingreso a UTI</td>
            <td class="resultado">@if (count($hos) > 0) {{ formato_fecha($hos[0]->fecha_ingreso_uti) }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="2" class="sub-titulo">6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Presenta</td>
            <td class="resultado">@if (count($enf) > 0) SI @else NO @endif</td>
        </tr>
        <tr>
            <td class="resultado">
                @if (count($enf) > 0)
                    @foreach ($enf as $f)
                        {{ $f->enfermedad }}
                    @endforeach
                @endif
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="sub-titulo">7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO (desde el inicio de los sintomas)</td>
        </tr>
    </table>
    <table>
        <tr>
            <th>NOMBRES Y APELLIDOS</th>
            <th>RELACION</th>
            <th>EDAD</th>
            <th>TELEFONO</th>
            <th>DIRECCION</th>
            <th>FECHA CONTACTO</th>
            <th>LUGAR DE CONTACTO</th>
        </tr>
        @if (count($cont) > 0)
            @foreach ($cont as $c)
            <tr>
                <td class="resultado">{{ $c->nombre_contacto }} {{ $c->paterno_contacto }} {{ $c->materno_contacto }}</td>
                <td class="resultado">{{ $c->relacion }}</td>
                <td class="resultado">{{ $c->edad }}</td>
                <td class="resultado">{{ $c->telefono }}</td>
                <td class="resultado">{{ $c->direccion }}</td>
                <td class="resultado">{{ $c->fecha_contacto }}</td>
                <td class="resultado">{{ $c->lugar_contacto }}</td>
            </tr>
            @endforeach
        @else
        <tr>
            <th class="resultado"></th>
            <th class="resultado"></th>
            <th class="resultado"></th>
            <th class="resultado"></th>
            <th class="resultado"></th>
            <th class="resultado"></th>
            <th class="resultado"></th>
        </tr>
        @endif
    </table>
    <table>
        <tr>
            <td colspan="6" class="sub-titulo">8. LABORATORIO</td>
        </tr>
        <tr>
            <td>Se tomó muestra para laboratorio</td>
            <td class="resultado">
                @if (count($lab) > 0)
                    @if ($lab[0]->muestras)
                        SI
                    @else
                        NO
                    @endif
                @endif
            </td>
            <td>Lugar de toma de muestra</td>
            <td class="resultado">@if (count($lab) > 0) {{ $lab[0]->lugar_muestra }} @endif</td>
        </tr>
        <tr>
            <td>Tipo de muestra tomada</td>
            <td class="resultado">
                @if (count($mue) > 0) 
                    @foreach ($mue as $m)
                        {{ $m->muestra }}, 
                    @endforeach
                @endif</td>
        </tr>
        <tr>
            <td>Nombre de Lab. que procesa la muestra</td>
            <td class="resultado">@if (count($lab) > 0) {{ $lab[0]->nombre_laboratorio }} @endif</td>
            <td>Fecha de toma de muestra</td>
            <td class="resultado">fecha_muestra</td>
            <td>Fecha de envio</td>
            <td class="resultado">fecha_envio</td>
        </tr>
        <tr>
            <td>Resposable de Toma de Muestra</td>
            <td class="resultado">@if (count($lab) > 0) {{ $lab[0]->responsable_muestra }} @endif</td>
            <td>Firma y sello</td>
            <td class="resultado"></td>
        </tr>
        <tr>
            <td>Observaciones</td>
            <td class="resultado">@if (count($lab) > 0) {{ $lab[0]->observaciones }} @endif</td>
        </tr>
        <tr>
            <td>Resultado de Laboratorio</td>
            <td class="resultado">
                @if (count($lab) > 0)
                    @if ($lab[0]->resultado_laboratorio)
                        POSITIVO
                    @else
                        NEGATIVO
                    @endif
                @endif
            </td>
            <td>Fecha</td>
            <td class="resultado">@if (count($lab) > 0) {{ $lab[0]->fecha_resultado }} @endif</td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="4" class="sub-titulo"><strong>DATOS DEL PERSDONAL QUE NOTIFICA</strong></td>
        </tr>
        <tr>
            <td><strong>Nombre y Apellido</strong></td>
            <td class="resultado">@if (count($per) > 0) {{ $per[0]->nombre_notifica }} {{ $per[0]->paterno_notifica }} {{ $per[0]->materno_notifica }} @endif</td>
            <td><strong>Tel. cel</strong></td>
            <td class="resultado">@if (count($per) > 0) {{ $per[0]->tel_cel_notifica }} @endif</td>
        </tr>
        <tr>
            <td><strong>Firma y sello:</strong></td>
            <td class="resultado">{{--  --}}</td>
            <td><strong>sello del EESS</strong></td>
            <td class="resultado">{{--  --}}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="parrafo">
                Este formulario tiene el caracter de declaración jurada que reealiza el equipo de salud, contiene informacion sujeta a vigilancia epidemiologica, por esta razon debe ser llenada correctamente enlas secciones necesarias y enviadas oportuinamente.
            </td>
        </tr>
    </table>
</body>
</html>