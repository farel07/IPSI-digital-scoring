function kirimBinaan() {
    // alert("Fitur ini belum tersedia.");
    const binaanValue = document.getElementById("btn_binaan_blue").value;

    if (binaanValue == 1) {
        document.getElementById("btn_binaan_blue").value = 2;
    }

    fetch("/kirim-binaan", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            count: binaanValue,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            alert(binaanValue);
        });
}

function kirimPeringatan() {
    // alert("Fitur ini belum tersedia.");
    const peringatanValue = document.getElementById(
        "btn_peringatan_blue"
    ).value;

    if (peringatanValue == 1) {
        document.getElementById("btn_peringatan_blue").value = 2;
    } else if (peringatanValue == 2) {
        document.getElementById("btn_peringatan_blue").value = 3;
    }

    fetch("/kirim-peringatan", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            count: peringatanValue,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            alert("Berhasil!");
        });
}

function kirimTeguran() {
    // alert("Fitur ini belum tersedia.");
    const teguranValue = document.getElementById("btn_teguran_blue").value;

    if (teguranValue == 1) {
        document.getElementById("btn_teguran_blue").value = 2;
    }

    fetch("/kirim-teguran", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            count: teguranValue,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            alert("Berhasil!");
        });
}

function kirimJatuh() {
    // alert("Fitur ini belum tersedia.");
    const jatuhValue = document.getElementById("btn_jatuh_blue").value;

    fetch("/kirim-jatuh", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            count: jatuhValue,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            alert("Berhasil!");
        });
}
