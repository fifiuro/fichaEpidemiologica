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

        .col-logo {
          width: 10%;
        }
        .imagen {
            width: 100px;
        }
        .titulo {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
        }
        .sub-titulo {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        .titulo-tabla {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }
        .sub-titulo-tabla {
          font-weight: bold;
        }
        .resultado {
          font-size: 26px;
          text-align: center;
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
    <title>CNS - CERTIFICADO</title>
</head>
<body>
  <br>
    <table>
      <tr>
        <td rowspan="3" class="col-logo">
          <img class="imagen" src="{{ asset('images/CNS_Logo.png') }}" alt="CNS">
        </td>
      </tr>
      <tr>
        <td class="titulo">H.A.I.G.O. OBRERO Nº1<br>CONSULTORIO DE SINTOMATICOS RESPIRATORIOS</td>
      </tr>
      <tr>
        <td class="sub-titulo">LABORATORIO - ORIGINAL</td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="titulo-tabla borde-td" colspan="6">INMUMOLOGÍA - PRUEBA PCR</td>
      </tr>
      <tr>
        <td class="sub-titulo-tabla borde-td">Nombre(s) y Apellidos</td>
        <td colspan="3" class="borde-td">{{ $pac[0]["nombre"] }} {{ $pac[0]["paterno"] }} {{ $pac[0]["materno"] }}</td>
        <td class="sub-titulo-tabla borde-td">Fecha de toma de muestra</td>
        <td class="borde-td">{{ $lab[0]->fecha_muestra }}</td>
      </tr>
      <tr>
        <td class="sub-titulo-tabla borde-td">Nº de asegurado</td>
        <td class="borde-td">Seguro</td>
        <td class="sub-titulo-tabla borde-td">Código de beneficiario</td>
        <td class="borde-td"></td>
        <td class="sub-titulo-tabla borde-td">Código de laboratorio</td>
        <td class="borde-td"></td>
      </tr>
      <tr>
        <td class="sub-titulo-tabla borde-td">Médico</td>
        <td colspan="3" class="borde-td">{{ $reporte[0]->nombre_notifica }} {{ $reporte[0]->paterno_notifica }} {{ $reporte[0]->materno_notifica }}</td>
        <td class="sub-titulo-tabla borde-td">Muestra de control</td>
        <td class="borde-td">{{ $lab[0]->numero }}</td>
      </tr>
    </table>
    <br>
    <table>
      <tr>
        <td class="sub-titulo-tabla">Resultado:</td>
      </tr>
      <tr>
        <td>Paciente con Anticuerpos para SARS - COV 2.</td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="resultado">
          @if (count($lab) > 0)
            @if ($lab[0]->resultado_laboratorio)
              <strong>SI DETECTADO (+)</strong>
            @else
              <strong>NO DETECTADO (-)</strong>
            @endif
          @else
            <strong>No tiene Resultado.</strong>
          @endif
        </td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table>
      <tr>
        <td class="izquierda">
          {{ $pac[0]["nombre"] }} {{ $pac[0]["paterno"] }} {{ $pac[0]["materno"] }}<br>
          Recibí conforme
        </td>
        <td class="centro">
          Dra. / Dr. {{ $reporte[0]->nombre_notifica }} {{ $reporte[0]->paterno_notifica }} {{ $reporte[0]->materno_notifica }}<br>
          Viróloga - H. Obrero Nº1
        </td>
        <td class="derecha">
          {{ $lab[0]->fecha_impresion }}<br>
          Lugar y fecha de emisión
        </td>
      </tr>
    </table>
  
    <br>
    <br>
    <br>
    <br>
    <br>
    <table>
      <tr>
        <td rowspan="3" class="col-logo">
          <img class="imagen" src="{{ asset('images/CNS_Logo.png') }}" alt="CNS">
        </td>
      </tr>
      <tr>
        <td class="titulo">H.A.I.G.O. OBRERO Nº1<br>CONSULTORIO DE SINTOMATICOS RESPIRATORIOS</td>
      </tr>
      <tr>
        <td class="sub-titulo">LABORATORIO - COPIA</td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="titulo-tabla borde-td" colspan="6">INMUMOLOGÍA - PRUEBA PCR</td>
      </tr>
      <tr>
        <td class="sub-titulo-tabla borde-td">Nombre(s) y Apellidos</td>
        <td colspan="3" class="borde-td">{{ $pac[0]["nombre"] }} {{ $pac[0]["paterno"] }} {{ $pac[0]["materno"] }}</td>
        <td class="sub-titulo-tabla borde-td">Fecha de toma de muestra</td>
        <td class="borde-td">{{ $lab[0]->fecha_muestra }}</td>
      </tr>
      <tr>
        <td class="sub-titulo-tabla borde-td">Nº de asegurado</td>
        <td class="borde-td">Seguro</td>
        <td class="sub-titulo-tabla borde-td">Código de beneficiario</td>
        <td class="borde-td"></td>
        <td class="sub-titulo-tabla borde-td">Código de laboratorio</td>
        <td class="borde-td"></td>
      </tr>
      <tr>
        <td class="sub-titulo-tabla borde-td">Médico</td>
        <td colspan="3" class="borde-td">{{ $reporte[0]->nombre_notifica }} {{ $reporte[0]->paterno_notifica }} {{ $reporte[0]->materno_notifica }}</td>
        <td class="sub-titulo-tabla borde-td">Muestra de control</td>
        <td class="borde-td">{{ $lab[0]->numero }}</td>
      </tr>
    </table>
    <br>
    <table>
      <tr>
        <td class="sub-titulo-tabla">Resultado:</td>
      </tr>
      <tr>
        <td>Paciente con Anticuerpos para SARS - COV 2.</td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="resultado">
          @if (count($lab) > 0)
            @if ($lab[0]->resultado_laboratorio)
              <strong>SI DETECTADO (+)</strong>
            @else
              <strong>NO DETECTADO (-)</strong>
            @endif
          @else
            <strong>No tiene Resultado.</strong>
          @endif
        </td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table>
      <tr>
        <td class="izquierda">
          {{ $pac[0]["nombre"] }} {{ $pac[0]["paterno"] }} {{ $pac[0]["materno"] }}<br>
          Recibí conforme
        </td>
        <td class="centro">
          Dra. / Dr. {{ $reporte[0]->nombre_notifica }} {{ $reporte[0]->paterno_notifica }} {{ $reporte[0]->materno_notifica }}<br>
          Viróloga - H. Obrero Nº1
        </td>
        <td class="derecha">
          {{ $lab[0]->fecha_impresion }}<br>
          Lugar y fecha de emisión
        </td>
      </tr>
    </table>
</body>
</html>
