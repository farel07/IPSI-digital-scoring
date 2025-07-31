function kirimBinaan(filter) {
    // alert("Fitur ini belum tersedia.");
    const binaanValue = document.getElementById("btn_binaan_" + filter).value;

        if (binaanValue == 1) {
            document.getElementById("btn_binaan_" + filter).value = 2;
        }

            fetch('/kirim-binaan', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    count: binaanValue,
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(binaanValue + filter)
            });
        }

function kirimPeringatan(filter) {
    // alert("Fitur ini belum tersedia.");
    const peringatanValue = document.getElementById("btn_peringatan_" + filter).value;

    if (peringatanValue == 1) {
        document.getElementById("btn_peringatan_" + filter).value = 2;
    } else if (peringatanValue == 2) {
        document.getElementById("btn_peringatan_" + filter).value = 3;
    }

            fetch('/kirim-peringatan', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    count: peringatanValue,
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(peringatanValue + filter);
            });
        }

function kirimTeguran(filter) {
    // alert("Fitur ini belum tersedia.");
    const teguranValue = document.getElementById("btn_teguran_" + filter).value;

    if (teguranValue == 1) {
        document.getElementById("btn_teguran_" + filter).value = 2;
    }

            fetch('/kirim-teguran', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    count: teguranValue,
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(teguranValue + filter);
            });
        }

function kirimJatuh(filter) {
    // alert("Fitur ini belum tersedia.");
    const jatuhValue = document.getElementById("btn_jatuh_" + filter).value;

            fetch('/kirim-jatuh', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    count: jatuhValue,
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(jatuhValue + filter);
            });
        }