<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acta Entrega Recepción</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .signature-table {
            margin-top: 50px;
            width: 100%;
        }

        .signature-table td {
            border: none;
            padding: 20px;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid black;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>TIPO</th>
                <th>SERIAL</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->serial_number }}</td>
                    <td>{{ $record->brand }}</td>
                    <td>{{ $record->model }}</td>
                    <td>{{ $record->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="signature-table">
        <tr>
            <td>
                <div class="signature-line"></div>
                <p><strong>ENTREGA</strong></p>
                <p>MEZA PEREZ EDY JAVIER</p>
                <p>CI: 1714529219</p>
            </td>
            <td>
                <div class="signature-line"></div>
                <p><strong>RECIBE</strong></p>
                <p>{{ $receiver->name }}</p>
                <p>CI: {{ $receiver->identification_number }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
