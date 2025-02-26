<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processus PM2</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid black; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

<h1>Liste des Processus PM2</h1>

<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>ID</th>
        <th>Statut</th>
        <th>CPU</th>
        <th>RAM</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pm2Processes as $process)
        <tr>
            <td>{{ $process['name'] }}</td>
            <td>{{ $process['pm_id'] }}</td>
            <td style="color: {{ $process['pm2_env']['status'] == 'online' ? 'green' : 'red' }};">
                {{ $process['pm2_env']['status'] }}
            </td>
            <td>{{ $process['monit']['cpu'] }}%</td>
            <td>{{ number_format($process['monit']['memory'] / 1024 / 1024, 2) }} MB</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
