<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($notifikasi as $n)
        <h2>{{ $n->title }}</h2>
        <p>
            {{ $n->status }}
        </p>
        @if($n->status == 'completed')
            <p>
                <a href="{{ \Storage::url($n->file_path) }}">Download</a>
            </p>
        @endif
    @endforeach

</body>
</html>
