function kirimBinaan() {
    // alert("Fitur ini belum tersedia.");
            fetch('/kirim-binaan', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    isi: "Btst"
                })
            }).then(res => res.json()).then(data => {
                alert("Berhasil!");
            });
        }

function kirimPeringatan() {
    // alert("Fitur ini belum tersedia.");
            fetch('/kirim-peringatan', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    isi: "ini peringatan dari dewan"
                })
            }).then(res => res.json()).then(data => {
                alert("Berhasil!");
            });
        }