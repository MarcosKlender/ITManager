<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acta Entrega Recepción</title>

    <style>
        .header-table {
            border: none;
            width: 100%;
        }

        .header-table td {
            border: none;
        }

        .logo {
            text-align: right;
        }

        .header {
            text-align: right;
            font-weight: bold;
        }

        .title {
            text-align: center;
            font-weight: bold;
        }

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
    <table class="header-table">
        <tr>
            <td>
                <p>Consejo Nacional Electoral de Santo Domingo de los Tsáchilas<br>
                    Unidad de Seguridad Informática y Proyectos Tecnológicos Electorales</p>
            </td>
            <td class="logo">
                <img src="{{ public_path('images/cne-logo.png') }}" alt="Logo CNE" height="80px">
            </td>
        </tr>
    </table>

    <p class="header">Santo Domingo, {{ $currentDate }}<br>
        Acta Nro. {{ $fileName }}</p>

    <br>
    <p class="title">ACTA ENTREGA - RECEPCIÓN</p>
    <br>

    <p>
        En las instalaciones de la Delegación Provincial Electoral de Santo Domingo de los Tsáchilas
        se procede a la suscripción de la presente acta donde consta la entrega de acuerdo al siguiente detalle:
    </p>

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
            @foreach ($filteredRecords as $record)
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

    <p>
        Para constancia de lo actuado en fe de conformidad y aceptación, suscriben la presente acta en dos ejemplares de
        igual tenor y efecto las personas que han intervenido en esta diligencia:
    </p>

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
