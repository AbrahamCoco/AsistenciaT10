<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Horas</title>
    <style>
        #header{
            position: fixed;
            top: 0cm;
            left: 0cm;
        }
        #header {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .texto-prueba {
            padding: 0px;
            margin: 0;
        }

        .barra1{
            width: 100%;
        }

        .barra {
            background-color: #0079b6;
            color: #0079b6;
            padding: 10px;
            margin: 0px 0px 20px 0px;
            width: 100%;
            text-align: center;
        }

        .imgHeader {
            width: 20%;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            margin-top: -105px; /* ajusta este valor para separar la imagen de la barra */
        }

        #footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            width: 100%;
            background-color: #0079b6;
        }
        .textFooter{
            text-align: center;
            color: white;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0079b6;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div id="header">
        <h3 class="texto-prueba">Ingenieria - Tecnologia - Sistemas</h3>
        <div class="barra1">
            <h4 class="barra">Holamundo</h4>
        </div>
        <img class="imgHeader" src="{{ public_path("images/LogoTerminus.png") }}" alt="">
    </div>

    @php
        $primeraAsistencia = $asistencia->first();
        $ultimaAsistencia = $asistencia->last();
    @endphp

    <p><strong>Reporte de prestador de: {{$primeraAsistencia->user->tipo}} </strong></p>
    <p>Fecha de consulta.</p>
    <p>
        Desde: {{ \Carbon\Carbon::parse($primeraAsistencia->hora_inicio)->format('d-m-Y') }}
        Hasta: {{ \Carbon\Carbon::parse($ultimaAsistencia->hora_inicio)->format('d-m-Y') }}
    </p>
    <p></p>
    <p>Nombre completo del prestador: <strong>{{$primeraAsistencia->user->name }}</strong></p>
    <table style="border">
        <thead>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
            <th>Horas realizadas</th>
        </thead>
        <tbody>
            @php
                $totalMinutos = 0;
            @endphp
            @foreach ($asistencia as $i => $asis)
                @php
                    $hora_inicio = $asis->hora_inicio ?? '';
                    $hora_fin = $asis->hora_fin ?? '';
                    $fecha = '';
                    $horas = '';
                    if ($hora_inicio && $hora_fin) {
                        $diff = date_diff(date_create($hora_inicio), date_create($hora_fin));
                        $horas = sprintf('%d horas y %d minutos', $diff->h, $diff->i);
                        $totalMinutos += $diff->h * 60 + $diff->i;
                        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $hora_inicio)->format('d-m-Y');
                    }
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $fecha }}</td>
                    <td>{{ substr($hora_inicio, 11, 5) }} hrs</td>
                    <td>{{ substr($hora_fin, 11, 5) }} hrs</td>
                    <td>{{ $horas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @php
    $horasTotales = 480;
    $minutosCompletados = 0;
    foreach ($asistencia as $asis) {
        if ($asis->hora_inicio && $asis->hora_fin) {
            $minutosCompletados += Carbon\Carbon::parse($asis->hora_inicio)->diffInMinutes(Carbon\Carbon::parse($asis->hora_fin));
        }
    }
    $horasCompletadas = floor($minutosCompletados / 60);
    $minutosCompletados = $minutosCompletados % 60;
    $horasRestantes = $horasTotales - $horasCompletadas;
    $minutosRestantes = 60 - $minutosCompletados;
    if ($minutosRestantes == 60) {
        $horasRestantes++;
        $minutosRestantes = 0;
    }
    $fechaTermino = date('d-m-Y', strtotime('+' . ceil($horasRestantes / 17.5) . ' weeks'));
    @endphp

    <br>
    <table>
        <thead>
            <th>Horas totales</th>
            <th>Horas completadas</th>
            <th>Horas restantes</th>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $horasTotales }} Horas</strong></td>
                <td>{{ $horasCompletadas }} horas y {{ $minutosCompletados }} minutos</td>
                <td>{{ $horasRestantes }} horas y {{ $minutosRestantes }} minutos</td>
            </tr>
        </tbody>
    </table>

    <p>Fecha proxima de termino: {{ $fechaTermino }}</p>


    <br>
    <p style="text-align: center;">ATENTAMENTE</p>
    <br>
    <p style="text-align: center">____________________________________________</p>
    <p style="text-align: center">Ing. Andres Gonzalez Paniagua</p>
    <p style="text-align: center">Director</p>

    <div id="footer">
        <p class="textFooter">
            <strong>Privada Concepcion 5, Miraflores, Tlaxcala, Tlaxcala</strong> - 246.311.9477 &bull; www.terminus10.com
        </p>
    </div>
</body>
</html>