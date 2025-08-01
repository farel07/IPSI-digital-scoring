const round = 2;

function kirimBinaan(filter) {
    // alert("Fitur ini belum tersedia.");
    const binaanValue = document.getElementById("btn_binaan_" + filter).value;

    if (round == 1) {
        document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }
    else if (round == 2) {
        document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }
    else if (round == 3) {
        document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }

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
                    count: parseInt(binaanValue),
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(binaanValue + filter)
            });
        }

function kirimPeringatan(filter) {
    // alert("Fitur ini belum tersedia.");
    const peringatanValue = document.getElementById("btn_peringatan_" + filter).value;

    if (round == 1) {
        document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = peringatanValue;
        // total_peringatan += 1;
    } else if (round == 2) {
        document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = peringatanValue;
    } else if (round == 3) {
        document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = peringatanValue;
    }

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
                    count: parseInt(peringatanValue),
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(peringatanValue + filter);
            });
        }

function kirimTeguran(filter) {
    // alert("Fitur ini belum tersedia.");
    const teguranValue = document.getElementById("btn_teguran_" + filter).value;

    if (round == 1) {
        document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = teguranValue;
        // total_teguran += 1;
    } else if (round == 2) {
        document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = teguranValue;
    } else if (round == 3) {
        document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = teguranValue;
    }

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
                    count: parseInt(teguranValue),
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(teguranValue + filter);
            });
        }

        let total_jatuh = 0;

function kirimJatuh(filter) {
    // alert("Fitur ini belum tersedia.");
    const jatuhValue = document.getElementById("btn_jatuh_" + filter).value;
    total_jatuh += 1;
    if (round == 1) {
        document.getElementById("point-jatuh-" + filter + "-" + round).innerHTML = total_jatuh;
        // total_jatuh += 1;
    } else if (round == 2) {
        document.getElementById("point-jatuh-" + filter + "-" + round).innerHTML = total_jatuh;
    } else if (round == 3) {
        document.getElementById("point-jatuh-" + filter + "-" + round).innerHTML = total_jatuh;
    }

            fetch('/kirim-jatuh', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    count: parseInt(jatuhValue),
                    filter: filter
                })
            }).then(res => res.json()).then(data => {
                alert(jatuhValue + filter);
            });
        }