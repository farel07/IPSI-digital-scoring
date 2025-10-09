// const round = 1;
const id_user = window.location.pathname.split("/").pop();
// const juri_ket = "juri-" + id_user;
// const juri_ket = document.getElementById('juri_ket').value;
// console.log("ID User:", juri_ket);

// if (document.getElementById('juri_ket') !== null) {
//   // Do something with juri_ket
//   const juri_ket = document.getElementById('juri_ket').value;
//   console.log("ID User:", juri_ket);

// 1. Deklarasikan variabel dengan `let` agar nilainya bisa diubah.
//    Beri nilai awal null untuk menandakan "belum ada nilai".

let juri_ket = null;

// 2. Cari elemen berdasarkan ID-nya.
const juriElement = document.getElementById("juri_ket");

// 3. Buat kondisi: JIKA elemennya ditemukan (tidak null)...
if (juriElement) {
  // ...maka, baru definisikan variabel 'juri_ket' dengan nilainya.
  juri_ket = juriElement.value;
}

// }

function kirimBinaan(filter) {
  const binaanValue = document.getElementById("btn_binaan_" + filter).value;
  document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = false;
  document.getElementById("btn_hapus_pelanggaran_" + filter).value = "binaan-" + binaanValue;
  console.log("Kirim binaan:", binaanValue);

  document.getElementById("btn_binaan_" + filter).disabled = true;

  setTimeout(() => {
    // document.getElementById("btn_hapus_pelanggaran_" + filter).disabled =  ;
    document.getElementById("btn_binaan_" + filter).disabled = false;
  }, 2000);

  if (binaanValue != 3) {
    // Pastikan elemen ada sebelum mengubahnya
    const pointElement = document.getElementById("point-bina-" + filter + "-" + window.currentRound);
    if (pointElement) pointElement.innerHTML = binaanValue;
  }

  // PENAMBAHAN: Panggil fungsi simpan jika ada (untuk dewan)
  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
  }

  if (binaanValue == 1) {
    document.getElementById("btn_binaan_" + filter).value = 2;
  } else {
    document.getElementById("btn_binaan_" + filter).value = 3;
    // document.getElementById("btn_teguran_" + filter).value = 2;
  }

  fetch("/kirim-binaan/" + id_user, {
    method: "POST",
    headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"), "Content-Type": "application/json" },
    body: JSON.stringify({ count: parseInt(binaanValue), filter: filter }),
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
}

function kirimPeringatan(filter) {
  const peringatanValue = document.getElementById("btn_peringatan_" + filter).value;
  document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = false;
  document.getElementById("btn_hapus_pelanggaran_" + filter).value = "peringatan-" + peringatanValue;

  document.getElementById("btn_peringatan_" + filter).disabled = true;
  setTimeout(() => {
    // document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
    document.getElementById("btn_peringatan_" + filter).disabled = false;
  }, 2000);

  if (peringatanValue != 4) {
    const pointElement = document.getElementById("point-peringatan-" + filter + "-" + window.currentRound);
    if (pointElement) pointElement.innerHTML = peringatanValue;
  }

  // PENAMBAHAN: Panggil fungsi simpan jika ada (untuk dewan)
  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
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
    headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"), "Content-Type": "application/json" },
    body: JSON.stringify({ count: parseInt(peringatanValue), filter: filter }),
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
}

function kirimTeguran(filter) {
  const teguranValue = document.getElementById("btn_teguran_" + filter).value;
  document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = false;
  document.getElementById("btn_hapus_pelanggaran_" + filter).value = "teguran-" + teguranValue;
  document.getElementById("btn_teguran_" + filter).disabled = true;

  setTimeout(() => {
    // document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
    document.getElementById("btn_teguran_" + filter).disabled = false;
  }, 2000);

  if (teguranValue != 3) {
    const pointElement = document.getElementById("point-teguran-" + filter + "-" + window.currentRound);
    if (pointElement) pointElement.innerHTML = teguranValue;
  }

  // PENAMBAHAN: Panggil fungsi simpan jika ada (untuk dewan)
  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
  }

  if (teguranValue == 1) {
    document.getElementById("btn_teguran_" + filter).value = 2;
  } else if (teguranValue == 2) {
    document.getElementById("btn_teguran_" + filter).value = 3;
  }

  fetch("/kirim-teguran/" + id_user, {
    method: "POST",
    headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"), "Content-Type": "application/json" },
    body: JSON.stringify({ count: parseInt(teguranValue), filter: filter }),
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
  const jatuhValue = document.getElementById("btn_jatuh_" + filter).value;
  document.getElementById("btn_hapus_jatuhan_" + filter).disabled = false;
  document.getElementById("btn_jatuh_" + filter).disabled = true;

  setTimeout(() => {
    // document.getElementById("btn_hapus_jatuhan_" + filter).disabled = true;
    document.getElementById("btn_jatuh_" + filter).disabled = false;
  }, 2000);

  if (filter == "blue") {
    total_jatuh_blue += 1;
    total_jatuh = total_jatuh_blue;
  } else if (filter == "red") {
    total_jatuh_red += 1;
    total_jatuh = total_jatuh_red;
  }

  const pointElement = document.getElementById("point-jatuh-" + filter + "-" + window.currentRound);
  if (pointElement) pointElement.innerHTML = total_jatuh;

  // PENAMBAHAN: Panggil fungsi simpan jika ada (untuk dewan)
  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
  }

  fetch("/kirim-jatuh/" + id_user, {
    method: "POST",
    headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"), "Content-Type": "application/json" },
    body: JSON.stringify({ count: parseInt(jatuhValue), filter: filter }),
  })
    .then((res) => res.json())
    .then((data) => {
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
    document.getElementById("point-jatuh-" + filter + "-" + window.currentRound).innerHTML = total_jatuh;
  } else if (type == "pelanggaran") {
    document.getElementById("btn_hapus_pelanggaran_" + filter).disabled = true;
    let tipe = document.getElementById("btn_hapus_pelanggaran_" + filter).value;
    type = tipe;

    // Reset value sesuai value sebelumnya
    if (type === "binaan-1" || type === "binaan-2" || type === "binaan-3") {
      console.log(type);

      // console.log("Reset filter untuk hapus binaan:", type);
      let binaanValue = document.getElementById("btn_binaan_" + filter).value;
      if (binaanValue == "2" || binaanValue == "1") {
        document.getElementById("btn_binaan_" + filter).value = "1";
        document.getElementById("point-bina-" + filter + "-" + window.currentRound).innerHTML = "0";
      } else {
        document.getElementById("btn_binaan_" + filter).value = "2";
        document.getElementById("point-bina-" + filter + "-" + window.currentRound).innerHTML = "1";
      }
    } else if (type === "peringatan-1" || type === "peringatan-2" || type === "peringatan-3") {
      let peringatanValue = document.getElementById("btn_peringatan_" + filter).value;
      if (peringatanValue == "2" || peringatanValue == "1") {
        document.getElementById("btn_peringatan_" + filter).value = "1";
        document.getElementById("point-peringatan-" + filter + "-" + window.currentRound).innerHTML = "0";
      } else if (peringatanValue == "3") {
        document.getElementById("btn_peringatan_" + filter).value = "2";
        document.getElementById("point-peringatan-" + filter + "-" + window.currentRound).innerHTML = "1";
      } else {
        document.getElementById("btn_peringatan_" + filter).value = "3";
        document.getElementById("point-peringatan-" + filter + "-" + window.currentRound).innerHTML = "2";
      }
    } else if (type === "teguran-1" || type === "teguran-2" || type === "teguran-3") {
      let teguranValue = document.getElementById("btn_teguran_" + filter).value;
      if (teguranValue == "2" || teguranValue == "1") {
        document.getElementById("btn_teguran_" + filter).value = "1";
        document.getElementById("point-teguran-" + filter + "-" + window.currentRound).innerHTML = "0";
      } else {
        document.getElementById("btn_teguran_" + filter).value = "2";
        document.getElementById("point-teguran-" + filter + "-" + window.currentRound).innerHTML = "1";
      }
    }
  }

  // PENAMBAHAN: Panggil fungsi simpan SETELAH SEMUA logika hapus selesai
  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
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
      console.log(data);
      // console.log("Hapus jenis:", type);
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
  // Gunakan variabel global 'window.currentRound'
  if (typeof window.currentRound === "undefined" || typeof id_user === "undefined" || typeof juri_ket === "undefined") {
    console.error("Variabel global 'currentRound', 'id_user', atau 'juri_ket' belum didefinisikan.");
    return;
  }

  const deleteButton = document.getElementById(`btn_hapus_point_${filter}`);
  if (deleteButton) {
    if (deleteButtonTimers[filter]) {
      clearTimeout(deleteButtonTimers[filter]);
    }
    deleteButton.disabled = false;
    deleteButtonTimers[filter] = setTimeout(() => {
      deleteButton.disabled = true;
    }, 4000);
  }

  const displayElement = document.getElementById(`total-point-${filter}-${window.currentRound}`);
  if (!displayElement) {
    console.error(`Elemen display skor tidak ditemukan untuk ID: total-point-${filter}-${window.currentRound}`);
    return;
  }

  let currentText = displayElement.innerHTML.trim();
  let newText = currentText === "" || currentText === "." ? pointValue.toString() : `${currentText} ${pointValue}`;

  // Perbarui tampilan
  displayElement.innerHTML = newText;

  // ================================================================
  // MODIFIKASI: Tambahkan baris ini untuk auto-scroll ke kanan
  // `scrollWidth` adalah total lebar konten, termasuk yang tersembunyi
  // ================================================================
  displayElement.scrollLeft = displayElement.scrollWidth;

  // Simpan ke session storage (tidak berubah)
  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
  }

  // Kirim ke server (tidak berubah)
  fetch(`${endpoint}${id_user}`, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      filter: filter,
      juri_ket: juri_ket,
    }),
  })
    .then((res) => res.json())
    .catch((error) => console.error(`Error fetch ke ${endpoint}:`, error));
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
  if (typeof window.currentRound === "undefined" || typeof juri_ket === "undefined") {
    console.error("Variabel global 'currentRound' atau 'juri_ket' belum didefinisikan.");
    return;
  }

  const displayElement = document.getElementById(`total-point-${filter}-${window.currentRound}`);
  const deleteButton = document.getElementById(`btn_hapus_point_${filter}`);
  if (deleteButton) {
    deleteButton.disabled = true;
  }

  if (!displayElement) {
    console.error(`Elemen display skor tidak ditemukan untuk ID: total-point-${filter}-${window.currentRound}`);
    return;
  }

  let currentText = displayElement.innerHTML.trim(); // Simpan state sebelum diubah
  if (currentText === "" || currentText === ".") {
    return;
  }

  const pointsArray = currentText.split(" ");
  const lastPointValue = parseInt(pointsArray[pointsArray.length - 1], 10);
  let type = "";

  if (lastPointValue === 1) {
    type = "pukulan";
  } else if (lastPointValue === 2) {
    type = "tendangan";
  } else {
    console.error(`Nilai poin terakhir tidak valid untuk dihapus: ${lastPointValue}`);
    return;
  }

  pointsArray.pop();

  let newText = pointsArray.join(" ");
  if (newText === "") {
    newText = ".";
  }
  displayElement.innerHTML = newText; // Ubah tampilan secara optimis

  if (typeof window.saveHistoryToSession === "function") {
    window.saveHistoryToSession();
  }

  fetch("/kirim-hapus-point/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ filter: filter, type: type, juri_ket: juri_ket }),
  })
    // MODIFIKASI KUNCI DI SINI
    .then((res) => {
      // Kita hanya cek apakah server merespon 'OK' (status 200-299)
      // Kita tidak mencoba membaca JSON
      if (!res.ok) {
        throw new Error("Respons server bermasalah saat menghapus skor");
      }
      console.log(`Notifikasi hapus terkirim. Tipe: ${type}. Server merespon OK.`);
    })
    .catch((error) => {
      // Jika terjadi error (misalnya jaringan putus), KEMBALIKAN TAMPILAN
      console.error("Terjadi masalah dengan operasi fetch untuk hapus skor:", error);
      displayElement.innerHTML = currentText;

      // Juga simpan kembali state lama ke session storage agar konsisten
      if (typeof window.saveHistoryToSession === "function") {
        window.saveHistoryToSession();
      }

      // Beri tahu pengguna
      alert("Gagal menghapus poin terakhir. Periksa koneksi Anda dan coba lagi.");
    });
}
