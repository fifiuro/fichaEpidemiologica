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
            border-collapse: collapse;
        }

        .borde-td {
          border: 1px solid black;
        }

        .imagen {
            width: 150px;
        }

        .estado {
            font-size: 14px;
            font-weight: bold;
        }

        .titulo {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .resalta {
            font-weight: bold;
        }

        .derecha {
          text-align: right;
        }

        .izquierda {
          text-align: left;
        }

        .centro {
          text-align: center;
        }
    </style>
    <title>CNS - CERTIFICADO MEDICO</title>
</head>
<body>
    <br>
    <table>
        <tr>
            <td class="centro">
                <img class="imagen" src="{{ asset('images/escudo.png') }}" alt="Escudo de Bolivia">
            </td>
        </tr>
        <tr>
            <td class="centro estado">Estado Plurinacional de Bolivia</td>
        </tr>
        <tr>
            <td class="centro estado">Ministerio de Salud</td>
        </tr>
        <tr>
            <td class="titulo estado">CERTIFICADO MÉDICO</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>Lugar y Fecha (Fecha que no se pueda modificar):</td>
            <td></td>
        </tr>
        <tr>
            <td>Nombres y Apellidos (del Médico):</td>
            <td>{{ $lab[0]->nombre_notifica }} {{ $lab[0]->paterno_notifica }} {{ $lab[0]->materno_notifica }}</td>
        </tr>
        <tr>
            <td>Matriculo Profesional Ministerio de Salud:</td>
            <td></td>
        </tr>
    </table>
    <hr>
    <p>El/la médico de la Caja nacional de Salud que suscribe certifica:</p>
    <p>
        El/la paciente <span class="resalta">{{ $pac[0]->nombre_pacientes }} {{ $pac[0]->paterno_pacientes }} {{ $pac[0]->materno_pacientes }}</span>, con matrícula <span class="resalta">{{ $pac[0]->seguro_pacientes }}</span>, empresa <span class="resalta">"CAJA NACIONAL DE SALUD"</span>, acude a <span class="resalta">SERVICIO DE EMERGENCIAS – ETI</span>, se considera <span class="resalta">SOSPECHOSO(A)</span> de infección por <span class="resalta">CORONAVIRUS COVID - 19</span>, al momento presenta:
    </p>
    <p>
        <ul>
            @foreach ($sin as $s)
                <li>
                    {{ $s->sintoma }}
                </li>
            @endforeach
        </ul>
    </p>
    <p>
        El/la paciente cumplirá el aislamiento domiciliario, siguiendo las instrucciones descritas en el documento de <span class="resalt">COMPROMISO DEL PACIENTE PARA EL CUMPLIMIENTO DE NORMAS EN CASO DE AISLAMIENTO DOMICILIARIO</span> por el lapso de <span class="resalta">3 DÍAS. CONFIRMADA LA SOSPECHA</span>, se expedirá el certificado de incapacidad temporal correspondiente.
    </p>
    <p>
        En aplicación al Art. Quinto de los parágrafos V y VI, de la RESOLUCIÓN BI MINISTERIAL 001/20 del 13 de marzo de 2020, emitida por el MINISTERIO DE SALUD Y EL MINISTERIO DE TRABAJO, EMPLEO Y PREVENCIÓN SOCIAL.
    </p>
    <p>
        En cuanto certifico, para fines del/la interesado(a).
    </p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td class="derecha">Firma y sello del médico</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td>
                * El presente certificado médico se constituye como único documento válido a nivel nacional, para acreditar el estado de salud de la persona, el cual debe estar impreso y contener la firma y sello del médico que lo suscribe.
            </td>
        </tr>
    </table>
</body>
</html>
