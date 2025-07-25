<!DOCTYPE html>
<html>
<head>
    <title>Kirim Notifikasi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Kirim Notifikasi</h2>
    <p>ke halaman 1</p>
    <input type="text" id="judul" placeholder="Judul Notifikasi">
    <input type="text" id="pesan" placeholder="Isi Pesan">
    <button onclick="kirim()">Kirim</button>

    <p>ke halaman</p>
    <input type="text" id="judul2" placeholder="Judul Notifikasi">
    <input type="text" id="pesan2" placeholder="Isi Pesan">
    <button onclick="kirim2()">Kirim</button>

    <script>
        function kirim() {
            fetch('/kirim-notifikasi', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    judul: document.getElementById('judul').value,
                    pesan: document.getElementById('pesan').value
                })
            }).then(res => res.json()).then(data => {
                alert("Notifikasi terkirim!");
            });
        }

        function kirim2() {
            fetch('/kirim-notifikasi_2', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    judul: document.getElementById('judul2').value,
                    pesan: document.getElementById('pesan2').value
                })
            }).then(res => res.json()).then(data => {
                alert("Notifikasi terkirim!");
            });
        }
        
    </script>
</body>
</html>
