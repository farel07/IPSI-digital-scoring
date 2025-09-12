const round = 1;
const id_user = window.location.pathname.split("/").pop();
const juri_ket = 'juri-' + id_user;



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
    } else if (round == 2) {
      document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    } else if (round == 3) {
      document.getElementById("point-bina-" + filter + "-" + round).innerHTML = binaanValue;
    }
  }

  if (binaanValue == 1) {
    document.getElementById("btn_binaan_" + filter).value = 2;
  } else {
    document.getElementById("btn_binaan_" + filter).value = 3;
  }

  fetch("/kirim-binaan/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      count: parseInt(binaanValue),
      filter: filter,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      // alert(binaanValue + filter);
      console.log(data);
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

  fetch("/kirim-peringatan/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      count: parseInt(peringatanValue),
      filter: filter,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      // alert(peringatanValue + filter);
      console.log(data);
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

  fetch("/kirim-teguran/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      count: parseInt(teguranValue),
      filter: filter,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
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

  fetch("/kirim-jatuh/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      count: parseInt(jatuhValue),
      filter: filter,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      // alert(jatuhValue + filter);
      console.log(data);
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
  } else if (type == "pelanggaran") {
    document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
    let tipe = document.getElementById("btn_hapus_pelanggaran_" + filter).value;
    type = tipe;

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

  fetch("/kirim-hapus-pelanggaran/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      type: type,
      filter: filter,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      // alert(type + filter);
      console.log(data)
    });
}

// Objek untuk menyimpan referensi timer untuk setiap tim (blue/red)
const deleteButtonTimers = {};

/**
 * @param {string} filter - Warna tim, "blue" atau "red".
 * @param {number} pointValue - Nilai poin yang akan ditambahkan (1 untuk pukul, 2 untuk tendang).
 * @param {string} endpoint - URL API tujuan (misal: "/kirim-pukul/" atau "/kirim-tendang/").
 */
function kirimSkor(filter, pointValue, endpoint) {
  // Pastikan variabel global 'round', 'id_user', dan 'juri_ket' sudah tersedia
  if (typeof round === 'undefined' || typeof id_user === 'undefined' || typeof juri_ket === 'undefined') {
    console.error("Variabel global 'round', 'id_user', atau 'juri_ket' belum didefinisikan.");
    return;
  }

  // --- LOGIKA BARU UNTUK MENGAKTIFKAN TOMBOL HAPUS ---
  const deleteButton = document.getElementById(`btn_hapus_point_${filter}`);

  if (deleteButton) {
    // Hapus timer sebelumnya jika ada (untuk mereset countdown jika tombol skor dipencet lagi)
    if (deleteButtonTimers[filter]) {
      clearTimeout(deleteButtonTimers[filter]);
    }
    
    // Aktifkan tombol hapus
    deleteButton.disabled = false;
    
    // Set timer baru untuk menonaktifkan tombol setelah 4 detik
    deleteButtonTimers[filter] = setTimeout(() => {
      deleteButton.disabled = true;
    }, 4000); // 4000 milidetik = 4 detik
  }
  // --- AKHIR LOGIKA BARU ---

  const displayElement = document.getElementById(`total-point-${filter}-${round}`);

  if (!displayElement) {
    console.error(`Elemen display skor tidak ditemukan untuk ID: total-point-${filter}-${round}`);
    return;
  }

  // Ambil teks yang sudah ada
  let currentText = displayElement.innerHTML.trim();
  let newText = (currentText === "" || currentText === "0")
    ? pointValue.toString()
    : `${currentText} + ${pointValue}`;

  // Update tampilan skor
  displayElement.innerHTML = newText;

  // Kirim ke server
  fetch(`${endpoint}${id_user}`, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      filter: filter,
      juri_ket: juri_ket
    })
  })
    .then((res) => {
      if (!res.ok) throw new Error('Respons jaringan bermasalah');
      return res.json();
    })
    .then((data) => {
      console.log(`Data terkirim ke ${endpoint}:`, data);
    })
    .catch((error) => {
      console.error(`Terjadi masalah dengan operasi fetch ke ${endpoint}:`, error);
    });
}

/**
 * Fungsi yang dipanggil saat tombol PUKUL ditekan.
 */
function kirimPukul(filter) {
  kirimSkor(filter, 1, "/kirim-pukul/");
}

/**
 * Fungsi yang dipanggil saat tombol TENDANG ditekan.
 */
function kirimTendang(filter) {
  kirimSkor(filter, 2, "/kirim-tendang/");
}




// hapus pointTerbar
/**
 * @param {string} filter - Warna tim, "blue" atau "red".
 */
function kirimHapusPoint(filter) {
  // Pastikan variabel global 'round' dan 'juri_ket' sudah tersedia
  if (typeof round === 'undefined' || typeof juri_ket === 'undefined') {
    console.error("Variabel global 'round' atau 'juri_ket' belum didefinisikan.");
    return;
  }

  const displayElement = document.getElementById(`total-point-${filter}-${round}`);
  
  // --- LOGIKA BARU UNTUK MENONAKTIFKAN TOMBOL ---
  const deleteButton = document.getElementById(`btn_hapus_point_${filter}`);
  if (deleteButton) {
      deleteButton.disabled = true;
  }
  // --- AKHIR LOGIKA BARU ---

  if (!displayElement) {
    console.error(`Elemen display skor tidak ditemukan untuk ID: total-point-${filter}-${round}`);
    return;
  }

  let currentText = displayElement.innerHTML.trim();

  // Jika tidak ada skor untuk dihapus, hentikan fungsi
  if (currentText === "" || currentText === "0") {
    console.log("Tidak ada skor untuk dihapus.");
    return;
  }

  const pointsArray = currentText.split(' + ');
  
  // Ambil nilai poin terakhir untuk menentukan tipenya
  const lastPointValue = parseInt(pointsArray[pointsArray.length - 1], 10);
  let type = '';

  if (lastPointValue === 1) {
    type = 'pukulan';
  } else if (lastPointValue === 2) {
    type = 'tendangan';
  } else {
    console.error(`Nilai poin terakhir tidak valid untuk dihapus: ${lastPointValue}`);
    return;
  }

  pointsArray.pop();

  let newText = pointsArray.join(' + ');
  if (newText === "") {
    newText = "0";
  }

  displayElement.innerHTML = newText;

  fetch('/kirim-hapus-point/' + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      filter: filter,
      type: type,
      juri_ket: juri_ket
    })
  })
    .then((res) => {
      if (!res.ok) throw new Error('Respons jaringan bermasalah saat menghapus skor');
      return res.json();
    })
    .then((data) => {
      console.log(`Notifikasi hapus terkirim. Tipe: ${type}`, data);
    })
    .catch((error) => {
      console.error('Terjadi masalah dengan operasi fetch untuk hapus skor:', error);
      displayElement.innerHTML = currentText;
    });
}
