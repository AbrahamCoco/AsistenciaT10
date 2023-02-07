<style>
    table{
        border-collapse: collapse
    }
    td, th {
        border: 1px solid black
    }
</style>

<p style="text-align: center"><strong>Horas realizadas de {{ $asistencia->first()->user->tipo }}: {{ $asistencia->first()->user->name }} </strong></p>

    <table style="border">
        <thead>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
            <th>Horas realizadas</th>
        </thead>
        <tbody>
            @foreach ($asistencia as $asis)
                <tr>
                    <td> {{ $asis->hora_inicio }} </td>
                    <td> {{ $asis->hora_fin }} </td>
                    <td> 
                        @if($asis->hora_inicio && $asis->hora_fin)
                            ( {{ $minutes = Carbon\Carbon::parse($asis->hora_inicio)->diffInMinutes(Carbon\Carbon::parse($asis->hora_fin)) }} minutos )
                            {{ floor($minutes/60) }} horas y {{ $minutes % 60 }} minutos
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>