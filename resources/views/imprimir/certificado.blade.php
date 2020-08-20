<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 0;
        }
        table {
            width: 100%;
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
        }
        .parrafo {
            text-align: justify;
        }
        .mensaje {
          font-size: 26px;
          text-align: center;
        }
        .fecha {
          text-align: right;
        }
    </style>
    <title>CNS - CERTIFICADO</title>
</head>
<body>
  <br>
    <table>
      <tr>
        <td class="col-logo">
          <img class="imagen" src="{{ asset('images/CNS_Logo.png') }}" alt="CNS">
        </td>
        <td class="titulo">H.A.I.G.O. OBRERO Nº1<br>CONSULTORIO DE SINTOMATICOS RESPIRATORIOS</td>
      </tr>
    </table>
    <table>
        <tr>
            <td class="sub-titulo"><strong>CERTIFICADO</strong></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="parrafo">Se realiza atencion de paciente: {{ $pac[0]->nombre_pacientes }} {{ $pac[0]->paterno_pacientes }} {{ $pac[0]->materno_pacientes }} con número se asegurado con Nº {{ $pac[0]->seguro_pacientes }} se realiza la toma de muestra para <strong>COVID 19</strong> en fecha @if (count($lab) > 0) {{ $lab[0]->fecha_muestra }} @endif dando como resultado:</td>
        </tr>
    </table>
    <br>
    <br>
    <table>
        <tr>
          <td class="mensaje">
            @if (count($lab) > 0)
              @if ($lab[0]->resultado_laboratorio)
                <strong>DETECTADO (+)</strong>
              @else
                <strong>DETECTADO (-)</strong>
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
      <table>
        <tr>
          <td>Es en cuanto informo para fines del interesado.</td>
        </tr>
      </table>
      <br>
      <br>
      <br>
      <table>
        <tr>
          <td class="fecha">La Paz 3 de agosto del 2020</td>
        </tr>
    </table>
</body>
</html>
