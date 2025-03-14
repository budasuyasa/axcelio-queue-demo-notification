<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a.generate {
            background-color: #3490dc;
            padding: 4px;
            border-radius: 4px;
        }

        a.generate:hover{
            background-color: #87c9ff;
        }

    </style>

    @vite('resources/js/app.js')
</head>
<body>
    <a class="generate" href="{{ route('export.pdf') }}" >Buat PDF</a>
    @foreach($notifikasi as $n)
        <h2>{{ $n->id}}: {{ $n->title }}</h2>
        <p id="status-{{ $n->id }}">
            {{ $n->status }}
        </p>
        @if($n->status == 'completed')
            <p>
                <a href="{{ \Storage::url($n->file_path) }}">Download</a>
            </p>
        @endif
    @endforeach

    <script type="module">
        Echo.channel('channel123')
            // melakukan listen pada channel sesuai nama default Event
            .listen('KirimNotif', (e) => {
                // object yang dikirim dari server dapat diakses pada variabel e
                // object adalah construct dari class NotificationSend
                console.log(e.notifikasi);

                const idNotifikasi = e.notifikasi.id;

                document.querySelector(`#status-${idNotifikasi}`).innerHTML = e.notifikasi.status;


            });
    </script>


</body>
</html>
