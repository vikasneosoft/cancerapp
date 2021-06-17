<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style type="text/css">
        table td,
        table th {
            border: 1px solid black;
        }

    </style>
    <div class="container">
        <br />

        <table>
            <tr>
                <th>Doctor name</th>
                <th>Email</th>
            </tr>

            <tr>
                <td>{{ $doctorname }}</td>
                <td>{{ $doctoremail }}</td>
            </tr>

        </table>
    </div>
    <div>
        {!! $body !!}
    </div>
</body>

</html>
