<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Notifikasi Realtime</h2>
    <div id="notif"></div>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        });

        const channel = pusher.subscribe('notifikasi-channel');
        channel.bind('notifikasi-terima', function(data) {
            document.getElementById('notif').innerHTML =
                `<strong>${data.judul}</strong>: ${data.pesan}`;
        });
    </script>
</body>
</html>
