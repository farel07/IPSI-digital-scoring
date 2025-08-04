const round = 1;

function kirimBinaan(filter) {
    // alert("Fitur ini belum tersedia.");
    const binaanValue = document.getElementById("btn_binaan_" + filter).value;
    document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = false;
    document.getElementById("btn_hapus_pelanggaran_" + filter).value = "binaan-" + binaanValue;

    document.getElementById("btn_binaan_" + filter).disabled = true;

    setTimeout(() => {
        document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
        document.getElementById("btn_binaan_" + filter).disabled = false;
    }, 4000);

    if (binaanValue != 3) {

    if (round == 1) {
        document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }
    else if (round == 2) {
        document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }
    else if (round == 3) {
        document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }
    }
    

        if (binaanValue == 1) {
            document.getElementById("btn_binaan_" + filter).value = 2;
        } else {
            document.getElementById("btn_binaan_" + filter).value = 3;
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
    document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = false;
    document.getElementById("btn_hapus_pelanggaran_" + filter).value = "peringatan-" + peringatanValue;

    document.getElementById("btn_peringatan_" + filter).disabled = true;
    setTimeout(() => {
        document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
        document.getElementById("btn_peringatan_" + filter).disabled = false;
    }, 4000);

    if (peringatanValue != 4) {

    if (round == 1) {
        document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = peringatanValue;
        // total_peringatan += 1;
    } else if (round == 2) {
        document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = peringatanValue;
    } else if (round == 3) {
        document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = peringatanValue;
    }
}

    if (peringatanValue == 1) {
        document.getElementById("btn_peringatan_" + filter).value = 2;
    } else if (peringatanValue == 2) {
        document.getElementById("btn_peringatan_" + filter).value = 3;
    } else {
        document.getElementById("btn_peringatan_" + filter).value = 4;
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
    document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = false;
        document.getElementById("btn_hapus_pelanggaran_" + filter).value = "teguran-" + teguranValue;
    document.getElementById("btn_teguran_" + filter).disabled = true;

    setTimeout(() => {
        document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
        document.getElementById("btn_teguran_" + filter).disabled = false;
    }, 4000);

    if (teguranValue != 3) {

    if (round == 1) {
        document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = teguranValue;
        // total_teguran += 1;
    } else if (round == 2) {
        document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = teguranValue;
    } else if (round == 3) {
        document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = teguranValue;
    }

}

    if (teguranValue == 1) {
        document.getElementById("btn_teguran_" + filter).value = 2;
    } else if (teguranValue == 2) {
        document.getElementById("btn_teguran_" + filter).value = 3;
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

        let total_jatuh_blue = 0;
        let total_jatuh_red = 0;

function kirimJatuh(filter) {
    let total_jatuh;
    // alert("Fitur ini belum tersedia.");
    const jatuhValue = document.getElementById("btn_jatuh_" + filter).value;
    document.getElementById("btn_hapus_jatuhan_" + filter).disabled = false;
    document.getElementById("btn_jatuh_" + filter).disabled = true;
    
    setTimeout(() => {
        document.getElementById("btn_hapus_jatuhan_" + filter).disabled = true;
        document.getElementById("btn_jatuh_" + filter).disabled = false;
    }, 4000);

    if (filter == "blue") {
        total_jatuh_blue += 1;
        total_jatuh = total_jatuh_blue;
    } else if (filter == "red") {
        total_jatuh_red += 1;
        total_jatuh = total_jatuh_red;
    }
    
    // total_jatuh += 1;
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

        

    function kirimHapus(type, filter) {
        // alert("Fitur ini belum tersedia.");
        let total_jatuh;

        if (filter == "blue") {
            total_jatuh_blue -= 1;
            total_jatuh = total_jatuh_blue;
        } else if (filter == "red") {
            total_jatuh_red -= 1;
            total_jatuh = total_jatuh_red;
        }
        if (type == "jatuhan") {
            document.getElementById("btn_hapus_jatuhan_" + filter).disabled = true;
            document.getElementById("btn_hapus_jatuhan_" + filter).value = "jatuhan";
            // type = "jatuhan";
            document.getElementById("point-jatuh-" + filter + "-" + round).innerHTML = total_jatuh;
            
        }
        else if (type == "pelanggaran") {
            document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
            let tipe = document.getElementById("btn_hapus_pelanggaran_" + filter).value;
            type = tipe

            // Reset value sesuai value sebelumnya
            if (type === "binaan-1" || type === "binaan-2" || type === "binaan-3") {
                let binaanValue = document.getElementById("btn_binaan_" + filter).value;
                if (binaanValue == "2" || binaanValue == "1") {
                    document.getElementById("btn_binaan_" + filter).value = "1";
                    document.getElementById("point-bina-" + filter + "-" + round).innerHTML = "0";
                } else {
                    document.getElementById("btn_binaan_" + filter).value = "2";
                    document.getElementById("point-bina-" + filter + "-" + round).innerHTML = "1";
                }
            } else if (type === "peringatan-1" || type === "peringatan-2" || type === "peringatan-3") {
                let peringatanValue = document.getElementById("btn_peringatan_" + filter).value;
                if (peringatanValue == "2" || peringatanValue == "1") {
                    document.getElementById("btn_peringatan_" + filter).value = "1";
                    document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = "0";
                } else if (peringatanValue == "3") {
                    document.getElementById("btn_peringatan_" + filter).value = "2";
                    document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = "1";
                } else {
                    document.getElementById("btn_peringatan_" + filter).value = "3";
                    document.getElementById("point-peringatan-" + filter + "-" + round).innerHTML = "2";
                }
            } else if (type === "teguran-1" || type === "teguran-2" || type === "teguran-3") {
                let teguranValue = document.getElementById("btn_teguran_" + filter).value;
                if (teguranValue == "2" || teguranValue == "1") {
                    document.getElementById("btn_teguran_" + filter).value = "1";
                    document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = "0";
                } else {
                    document.getElementById("btn_teguran_" + filter).value = "2";
                    document.getElementById("point-teguran-" + filter + "-" + round).innerHTML = "1";
                }
            }
        }

        

        fetch('/kirim-hapus-pelanggaran', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                type: type,
                filter: filter
            })
        }).then(res => res.json()).then(data => {
            alert(type + filter);
        });
    }

function kirimPukul(filter){
    const pukulValue = document.getElementById("btn_pukul_" + filter).value;
    count = pukulValue;

    fetch('/kirim-pukul', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                count: parseInt(count),
                filter: filter
            })
        }).then(res => res.json()).then(data => {
            alert(count + filter);
        });
}