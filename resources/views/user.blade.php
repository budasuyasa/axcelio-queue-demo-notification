<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">

</head>
<body>

    <table id="usertable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created_at</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($user as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script>
    $('#usertable').DataTable( {
        ajax: '/user/ajax',
        serverSide: true,
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'created_at' }
        ]
    });
</script>
</html>