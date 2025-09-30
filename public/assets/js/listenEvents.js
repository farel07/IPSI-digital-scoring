// public/js/binaanListener.js
/**
 * [FUNGSI BARU] Mengambil skor total terbaru dari server dan memperbarui UI.
 * @param {string} pertandinganId - ID pertandingan saat ini.
 */
function fetchAndUpdateAllPoints(pertandinganId) {
  if (!pertandinganId) return;

  fetch(`/get-total-points/${pertandinganId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Gagal mengambil data poin");
      }
      return response.json();
    })
    .then((data) => {
      if (data.status === "berhasil") {
        // 1. Perbarui Total Poin Utama (di halaman penilaian)
        const blueScoreElement = document.getElementById("total-point-blue");
        const redScoreElement = document.getElementById("total-point-red");

        if (blueScoreElement) {
          blueScoreElement.innerHTML = data.total_point_1;
        }
        if (redScoreElement) {
          redScoreElement.innerHTML = data.total_point_2;
        }

        const bluePukulanTable = document.getElementById("blue-notif-pukulan-table");
        const redPukulanTable = document.getElementById("red-notif-pukulan-table");

        if (bluePukulanTable) {
          bluePukulanTable.innerHTML = data.punch_point_1;
        }
        if (redPukulanTable) {
          redPukulanTable.innerHTML = data.punch_point_2;
        }

        const blueTendanganTable = document.getElementById("blue-notif-tendangan-table");
        const redTendanganTable = document.getElementById("red-notif-tendangan-table");

        if (blueTendanganTable) {
          blueTendanganTable.innerHTML = data.kick_point_1 / 2;
        }
        if (redTendanganTable) {
          redTendanganTable.innerHTML = data.kick_point_2 / 2;
        }

        const blueJatuhanTable = document.getElementById("blue-notif-jatuhan-table");
        const redJatuhanTable = document.getElementById("red-notif-jatuhan-table");

        if (blueJatuhanTable) {
          blueJatuhanTable.innerHTML = data.fall_point_1;
        }
        if (redJatuhanTable) {
          redJatuhanTable.innerHTML = data.fall_point_2;
        }
      }
    })
    .catch((error) => console.error("Error saat fetch semua poin:", error));
}

/**
 * Fungsi untuk memulai listener event binaan dari Pusher.
 * @param {string} appKey - Kunci aplikasi dari Pusher.
 * @param {string} appCluster - Cluster dari Pusher.
 * @param {string} pertandinganId - ID pertandingan saat ini.
 */

const user_id = window.location.pathname.split("/").pop();
const pertandingan_id = document.getElementById("pertandingan_id").value;
console.log("pertandingan_id:", pertandingan_id);

function initializeListener(appKey, appCluster, pertandinganId) {
  if (!appKey || !appCluster || !pertandinganId) {
    console.error("Pusher Key, Cluster, atau ID Pertandingan tidak valid saat memanggil initializeListener.");
    return; // Hentikan fungsi jika ada yang kosong
  }

  console.log("Mendengarkan event untuk pertandingan ID:", pertandinganId);
  const user_id = window.location.pathname.split("/").pop(); // Ini aman di sini

  Pusher.logToConsole = true;
  const pusher = new Pusher(appKey, {
    cluster: appCluster,
  });

  const yellowFilter = "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";

  // Listener untuk semua event yang mengubah skor
  const channels = {
    "kirim-binaan-channel": "terima-binaan",
    "kirim-teguran-channel": "terima-teguran",
    "kirim-peringatan-channel": "terima-peringatan",
    "kirim-jatuh-channel": "terima-jatuh",
    "kirim-hapus-pelanggaran-channel": "terima-hapus-pelanggaran",
  };

  // binaan
  const binaanChannel = pusher.subscribe("kirim-binaan-channel-" + pertandingan_id);
  binaanChannel.bind("terima-binaan-" + pertandingan_id, function (data) {
    if (data.filter == "blue") {
      if (data.count == 1) {
        document.getElementById("blue-notif-binaan-1").style.filter = yellowFilter;
      } else if (data.count == 2) {
        document.getElementById("blue-notif-binaan-2").style.filter = yellowFilter;
        document.getElementById("blue-notif-teguran-1").style.filter = yellowFilter;
        document.getElementById("blue-notif-teguran-1-table").innerHTML = 1;
      } else {
        alert("binaan cuman 2x banh");
      }
    } else if (data.filter == "red") {
      if (data.count == 1) {
        document.getElementById("red-notif-binaan-1").style.filter = yellowFilter;
      } else if (data.count == 2) {
        document.getElementById("red-notif-binaan-2").style.filter = yellowFilter;
        document.getElementById("red-notif-teguran-1").style.filter = yellowFilter;
        document.getElementById("red-notif-teguran-1-table").innerHTML = 1;
      } else {
        alert("binaan cuman 2x banh");
      }
    } else {
      alert("cuman 2 warna side aja yaa");
    }

    fetchAndUpdateAllPoints(pertandinganId); // [TAMBAHAN] Panggil fetch
  });

  // teguran
  const teguranChannel = pusher.subscribe("kirim-teguran-channel-" + pertandingan_id);
  teguranChannel.bind("terima-teguran-" + pertandingan_id, function (data) {
    if (data.filter == "blue") {
      if (data.count == 1) {
        document.getElementById("blue-notif-teguran-1").style.filter = yellowFilter;
        document.getElementById("blue-notif-teguran-1-table").innerHTML = 1;
      } else if (data.count == 2) {
        document.getElementById("blue-notif-teguran-2").style.filter = yellowFilter;
        document.getElementById("blue-notif-teguran-2-table").innerHTML = 1;
      } else {
        alert("teguran cuman 2x banh");
      }
    } else if (data.filter == "red") {
      if (data.count == 1) {
        document.getElementById("red-notif-teguran-1").style.filter = yellowFilter;
        document.getElementById("red-notif-teguran-1-table").innerHTML = 1;
      } else if (data.count == 2) {
        document.getElementById("red-notif-teguran-2").style.filter = yellowFilter;
        document.getElementById("red-notif-teguran-2-table").innerHTML = 1;
      } else {
        alert("teguran cuman 2x banh");
      }
    } else {
      alert("cuman 2 warna side aja yaa");
    }

    fetchAndUpdateAllPoints(pertandinganId);
  });

  // peringatan
  const peringatanChannel = pusher.subscribe("kirim-peringatan-channel-" + pertandingan_id);
  peringatanChannel.bind("terima-peringatan-" + pertandingan_id, function (data) {
    if (data.filter == "blue") {
      if (data.count == 1) {
        document.getElementById("blue-notif-peringatan-1").style.filter = yellowFilter;
        document.getElementById("blue-notif-peringatan-1-table").innerHTML = 1;
      } else if (data.count == 2) {
        document.getElementById("blue-notif-peringatan-2").style.filter = yellowFilter;
        document.getElementById("blue-notif-peringatan-2-table").innerHTML = 1;
      } else if (data.count == 3) {
        document.getElementById("blue-notif-peringatan-3").innerHTML = 1;
      } else {
        alert("stop :3");
      }
    } else if (data.filter == "red") {
      if (data.count == 1) {
        document.getElementById("red-notif-peringatan-1").style.filter = yellowFilter;
        document.getElementById("red-notif-peringatan-1-table").innerHTML = 1;
      } else if (data.count == 2) {
        document.getElementById("red-notif-peringatan-2").style.filter = yellowFilter;
        document.getElementById("red-notif-peringatan-2-table").innerHTML = 1;
      } else if (data.count == 3) {
        document.getElementById("red-notif-peringatan-3").innerHTML = 1;
      } else {
        alert("stop :3");
      }
    } else {
      alert("cuman 2 warna side aja yaa");
    }

    fetchAndUpdateAllPoints(pertandinganId);
  });

  // jatuhan
  const jatuhanChannel = pusher.subscribe("kirim-jatuh-channel-" + pertandingan_id);
  let initBlueJatuhan = 0;
  let initRedJatuhan = 0;
  jatuhanChannel.bind("terima-jatuh-" + pertandingan_id, function (data) {
    if (data.filter == "blue") {
      document.getElementById("blue-notif-jatuhan-table").innerHTML = initBlueJatuhan = initBlueJatuhan + data.count;
    } else if (data.filter == "red") {
      document.getElementById("red-notif-jatuhan-table").innerHTML = initRedJatuhan = initRedJatuhan + data.count;
    }

    fetchAndUpdateAllPoints(pertandinganId);
  });

  // hapus Pelanggaran
  const hapusPelanggaranChannel = pusher.subscribe("kirim-hapus-pelanggaran-channel-" + pertandingan_id);
  hapusPelanggaranChannel.bind("terima-hapus-pelanggaran-" + pertandingan_id, function (data) {
    if (data.filter == "blue") {
      // Reset filter ikon untuk Binaan
      if (data.type == "binaan-1") {
        document.getElementById("blue-notif-binaan-1").style.filter = "";
      } else if (data.type == "binaan-2") {
        document.getElementById("blue-notif-binaan-2").style.filter = "";
      } else if (data.type == "teguran-1") {
        document.getElementById("blue-notif-teguran-1").style.filter = "";
        document.getElementById("blue-notif-teguran-1-table").innerHTML = 0;
      } else if (data.type == "teguran-2") {
        document.getElementById("blue-notif-teguran-2").style.filter = "";
        document.getElementById("blue-notif-teguran-2-table").innerHTML = 0;
      } else if (data.type == "peringatan-1") {
        document.getElementById("blue-notif-peringatan-1").style.filter = "";
        document.getElementById("blue-notif-peringatan-1-table").innerHTML = 0;
      } else if (data.type == "peringatan-2") {
        document.getElementById("blue-notif-peringatan-2").style.filter = "";
        document.getElementById("blue-notif-peringatan-2-table").innerHTML = 0;
      } else if (data.type == "peringatan-3") {
        document.getElementById("blue-notif-peringatan-3").innerHTML = 0;
      } else if (data.type == "jatuhan") {
        var notifElement = document.getElementById("blue-notif-jatuhan-table");
        var currentValue = parseInt(notifElement.innerHTML);
        notifElement.innerHTML = currentValue - 1;
      }
    } else if (data.filter == "red") {
      // Reset filter ikon untuk Binaan
      if (data.type == "binaan-1") {
        document.getElementById("red-notif-binaan-1").style.filter = "";
      } else if (data.type == "binaan-2") {
        document.getElementById("red-notif-binaan-2").style.filter = "";
      } else if (data.type == "teguran-1") {
        document.getElementById("red-notif-teguran-1").style.filter = "";
        document.getElementById("red-notif-teguran-1-table").innerHTML = 0;
      } else if (data.type == "teguran-2") {
        document.getElementById("red-notif-teguran-2").style.filter = "";
        document.getElementById("red-notif-teguran-2-table").innerHTML = 0;
      } else if (data.type == "peringatan-1") {
        document.getElementById("red-notif-peringatan-1").style.filter = "";
        document.getElementById("red-notif-peringatan-1-table").innerHTML = 0;
      } else if (data.type == "peringatan-2") {
        document.getElementById("red-notif-peringatan-2").style.filter = "";
        document.getElementById("red-notif-peringatan-2-table").innerHTML = 0;
      } else if (data.type == "peringatan-3") {
        document.getElementById("red-notif-peringatan-3").innerHTML = 0;
      } else if (data.type == "jatuhan") {
        var notifElement = document.getElementById("red-notif-jatuhan-table");
        var currentValue = parseInt(notifElement.innerHTML);
        notifElement.innerHTML = currentValue - 1;
      }
    }

    fetchAndUpdateAllPoints(pertandinganId);
  });

  // State untuk menyimpan pukulan yang sedang menunggu konfirmasi
  const voteStatePukulan = {
    blue: {
      juri: new Set(),
      startTime: null,
      timeoutId: null,
    },
    red: {
      juri: new Set(),
      startTime: null,
      timeoutId: null,
    },
  };

  let initBluePukulan = 0;
  let initRedPukulan = 0;

  /**
   * Fungsi untuk mereset state voting.
   * @param {string} color - "blue" atau "red"
   */
  function resetVoteStatePukulan(color) {
    console.log(`Mereset state untuk tim ${color}.`);
    voteStatePukulan[color].juri.clear();
    voteStatePukulan[color].startTime = null;

    if (voteStatePukulan[color].timeoutId) {
      clearTimeout(voteStatePukulan[color].timeoutId);
      voteStatePukulan[color].timeoutId = null;
    }

    // Kembalikan semua notifikasi juri untuk tim tersebut ke warna semula
    for (let i = 1; i <= 3; i++) {
      const notifElement = document.getElementById(`${color}-notif-juri-${i}-pukul`);
      if (notifElement) {
        notifElement.classList.replace("bg-warning", "bg-light");
      }
    }
  }

  // Subscribe ke channel Pusher
  const kirimPukulanChannel = pusher.subscribe("kirim-pukul-channel-" + pertandingan_id);
  kirimPukulanChannel.bind("terima-pukul-" + pertandingan_id, function (data) {
    const color = data.filter;
    const juriId = data.juri_ket;
    const currentState = voteStatePukulan[color];

    // Jika juri ini sudah memberikan suara dalam rentang waktu ini, abaikan.
    if (currentState.juri.has(juriId)) {
      return;
    }

    // --- PERBAIKAN 1: NYALAKAN LAMPU SEGERA SETELAH EVENT DITERIMA ---
    // Selalu nyalakan lampu notifikasi untuk juri yang datanya baru masuk.
    const notifElement = document.getElementById(`${color}-notif-${juriId}-pukul`);
    if (notifElement) {
      notifElement.classList.replace("bg-light", "bg-warning");
    }
    // ---------------------------------------------------------------------

    // Cek apakah ini pukulan PERTAMA
    if (currentState.juri.size === 0) {
      console.log(`Pukulan pertama diterima untuk tim ${color} dari ${juriId}. Menunggu juri kedua...`);
      currentState.juri.add(juriId);
      currentState.startTime = new Date();

      // Atur timer 4 detik. Jika tidak ada juri kedua, reset.
      currentState.timeoutId = setTimeout(() => {
        console.log(`Waktu habis untuk tim ${color}. Pukulan tidak sah.`);
        resetVoteStatePukulan(color);
      }, 4000);
    }
    // Jika ini pukulan KEDUA (atau ketiga)
    else {
      console.log(`Pukulan kedua diterima untuk tim ${color} dari ${juriId}.`);
      currentState.juri.add(juriId);

      const selisih_waktu = (new Date().getTime() - currentState.startTime.getTime()) / 1000;

      // Cek jika minimal 2 juri masuk DAN waktunya valid
      if (currentState.juri.size >= 2 && selisih_waktu <= 4) {
        console.log(`Pukulan SAH untuk tim ${color}! Selisih waktu: ${selisih_waktu.toFixed(2)} detik.`);

        // Matikan timer "waktu habis"
        clearTimeout(currentState.timeoutId);
        currentState.timeoutId = null; // Kosongkan ID timer

        // Tambah skor
        if (color === "blue") {
          document.getElementById("blue-notif-pukulan-table").innerHTML = "count";
        } else if (color === "red") {
          document.getElementById("red-notif-pukulan-table").innerHTML = "count";
        }

        // --- PERBAIKAN 2: BERI JEDA SEBELUM MERESET ---
        // Jangan langsung reset. Beri waktu 1.5 detik agar operator bisa melihat
        // kedua lampu menyala, baru kemudian reset state.
        setTimeout(() => {
          resetVoteStatePukulan(color);
        }, 1500); // Jeda 1.5 detik
        // ------------------------------------------------------

        // Kirim ke server
        fetch(`/kirim-pukul-insert/` + id_user, {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            filter: color,
            juri_ket: juriId,
          }),
        })
          .then((res) => {
            if (!res.ok) throw new Error("Respons jaringan bermasalah");
            return res.json();
          })
          .then((data) => {
            console.log(`Data terkirim ke:`, data);
            setTimeout(() => fetchAndUpdateAllPoints(pertandinganId), 200);
          })
          .catch((error) => {
            console.error(`Terjadi masalah dengan operasi fetch ke:`, error);
          });

        // Panggil fetch setelah delay singkat untuk memastikan DB terupdate
      }
    }
  });

  // State untuk menyimpan tendangan yang sedang menunggu konfirmasi
  const voteStateTendangan = {
    blue: {
      juri: new Set(),
      startTime: null,
      timeoutId: null,
    },
    red: {
      juri: new Set(),
      startTime: null,
      timeoutId: null,
    },
  };

  let initBlueTendangan = 0;
  let initRedTendangan = 0;

  /**
   * Fungsi untuk mereset state voting.
   * @param {string} color - "blue" atau "red"
   */
  function resetVoteStateTendangan(color) {
    console.log(`Mereset state untuk tim ${color}.`);
    voteStateTendangan[color].juri.clear();
    voteStateTendangan[color].startTime = null;

    if (voteStateTendangan[color].timeoutId) {
      clearTimeout(voteStateTendangan[color].timeoutId);
      voteStateTendangan[color].timeoutId = null;
    }

    // Kembalikan semua notifikasi juri untuk tim tersebut ke warna semula
    for (let i = 1; i <= 3; i++) {
      const notifElement = document.getElementById(`${color}-notif-juri-${i}-tendang`);
      if (notifElement) {
        notifElement.classList.replace("bg-warning", "bg-light");
      }
    }
  }

  // Subscribe ke channel Pusher
  const kirimTendanganChannel = pusher.subscribe("kirim-tendang-channel-" + pertandingan_id);
  kirimTendanganChannel.bind("terima-tendang-" + pertandingan_id, function (data) {
    const color = data.filter;
    const juriId = data.juri_ket;
    const currentState = voteStateTendangan[color];

    // Jika juri ini sudah memberikan suara dalam rentang waktu ini, abaikan.
    if (currentState.juri.has(juriId)) {
      return;
    }

    // --- PERBAIKAN 1: NYALAKAN LAMPU SEGERA SETELAH EVENT DITERIMA ---
    // Selalu nyalakan lampu notifikasi untuk juri yang datanya baru masuk.
    const notifElement = document.getElementById(`${color}-notif-${juriId}-tendang`);
    if (notifElement) {
      notifElement.classList.replace("bg-light", "bg-warning");
    }
    // ---------------------------------------------------------------------

    // Cek apakah ini Tendangan PERTAMA
    if (currentState.juri.size === 0) {
      console.log(`Tendangan pertama diterima untuk tim ${color} dari ${juriId}. Menunggu juri kedua...`);
      currentState.juri.add(juriId);
      currentState.startTime = new Date();

      // Atur timer 4 detik. Jika tidak ada juri kedua, reset.
      currentState.timeoutId = setTimeout(() => {
        console.log(`Waktu habis untuk tim ${color}. Tendangan tidak sah.`);
        resetVoteStateTendangan(color);
      }, 4000);
    }
    // Jika ini Tendangan KEDUA (atau ketiga)
    else {
      console.log(`Tendangan kedua diterima untuk tim ${color} dari ${juriId}.`);
      currentState.juri.add(juriId);

      const selisih_waktu = (new Date().getTime() - currentState.startTime.getTime()) / 1000;

      // Cek jika minimal 2 juri masuk DAN waktunya valid
      if (currentState.juri.size >= 2 && selisih_waktu <= 4) {
        console.log(`Tendangan SAH untuk tim ${color}! Selisih waktu: ${selisih_waktu.toFixed(2)} detik.`);

        // Matikan timer "waktu habis"
        clearTimeout(currentState.timeoutId);
        currentState.timeoutId = null; // Kosongkan ID timer

        // Tambah skor
        if (color === "blue") {
          document.getElementById("blue-notif-tendangan-table").innerHTML = "count";
        } else if (color === "red") {
          document.getElementById("red-notif-tendangan-table").innerHTML = "count";
        }

        // --- PERBAIKAN 2: BERI JEDA SEBELUM MERESET ---
        // Jangan langsung reset. Beri waktu 1.5 detik agar operator bisa melihat
        // kedua lampu menyala, baru kemudian reset state.
        setTimeout(() => {
          resetVoteStateTendangan(color);
        }, 1500);

        // Kirim ke server
        fetch(`/kirim-tendang-insert/` + id_user, {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            filter: color,
            juri_ket: juriId,
          }),
        })
          .then((res) => {
            if (!res.ok) throw new Error("Respons jaringan bermasalah");
            return res.json();
          })
          .then((data) => {
            console.log(`Data terkirim ke:`, data);
            setTimeout(() => fetchAndUpdateAllPoints(pertandinganId), 200);
          })
          .catch((error) => {
            console.error(`Terjadi masalah dengan operasi fetch ke:`, error);
          });
      }
    }
  });

  // hapus poin pukulan/tendangan terbaru
  // State object untuk melacak permintaan PENGHAPUSAN, strukturnya sudah pas.
  const deleteVoteState = {
    blue: {
      pukulan: { juri: new Set(), timeoutId: null },
      tendangan: { juri: new Set(), timeoutId: null },
    },
    red: {
      pukulan: { juri: new Set(), timeoutId: null },
      tendangan: { juri: new Set(), timeoutId: null },
    },
  };

  /**
   * Fungsi untuk mereset state voting PENGHAPUSAN. Tidak perlu diubah.
   * @param {string} color - "blue" atau "red"
   * @param {string} type - "pukulan" atau "tendangan"
   */
  function resetDeleteState(color, type) {
    console.log(`Mereset state penghapusan untuk ${color} - ${type}.`);
    const state = deleteVoteState[color][type];
    state.juri.clear();
    if (state.timeoutId) {
      clearTimeout(state.timeoutId);
      state.timeoutId = null;
    }
  }

  // Subscribe ke channel Pusher
  const kirimHapusPukulTendang = pusher.subscribe("kirim-hapus-point-channel-" + pertandingan_id);
  kirimHapusPukulTendang.bind("terima-hapus-point-" + pertandingan_id, function (data) {
    const color = data.filter; // "blue" atau "red"
    const type = data.type; // "pukulan" atau "tendangan"
    const juriId = data.juri_ket; // "juri-1", "juri-2", dll.

    // Dapatkan state yang relevan (misal: state untuk hapus pukulan biru)
    const currentState = deleteVoteState[color][type];

    // Abaikan jika juri ini sudah meminta hapus dalam sesi ini
    if (currentState.juri.has(juriId)) {
      return;
    }

    // Catat juri yang meminta hapus
    currentState.juri.add(juriId);
    console.log(`Permintaan hapus dari ${juriId} untuk ${color}-${type}. Total permintaan: ${currentState.juri.size}`);

    // Periksa apakah syarat sudah terpenuhi (minimal 2 juri)
    if (currentState.juri.size >= 2) {
      console.log(`PENGHAPUSAN SAH untuk ${color}-${type}. Minimal 2 juri telah setuju.`);

      // Batalkan timer "waktu habis" yang mungkin berjalan dari juri pertama
      clearTimeout(currentState.timeoutId);

      // --- LOGIKA UTAMA YANG DIUBAH ---
      // 1. Buat ID elemen target secara dinamis berdasarkan data dari Pusher
      const elementId = `${color}-notif-${type}-table`; // Contoh: akan menjadi "blue-notif-pukulan-table"

      // 2. Dapatkan elemen tersebut
      const elementToUpdate = document.getElementById(elementId);

      // 3. Lakukan pengurangan jika elemennya ada
      if (elementToUpdate) {
        // Ambil nilai saat ini, ubah ke angka. Gunakan '|| 0' untuk keamanan jika kosong.
        let currentValue = parseInt(elementToUpdate.innerHTML) || 0;

        // Kurangi nilainya. Gunakan Math.max untuk mencegah nilai negatif.
        let newValue = Math.max(0, currentValue - 1);

        // Perbarui tampilan elemen dengan nilai yang baru
        elementToUpdate.innerHTML = newValue;

        // Memperbarui variabel state internal sesuai dengan warna dan tipe
        if (color === "blue") {
          if (type === "pukulan") {
            initBluePukulan = newValue;
            console.log(`Variabel initBluePukulan diperbarui menjadi: ${initBluePukulan}`);
          } else if (type === "tendangan") {
            initBlueTendangan = newValue;
            console.log(`Variabel initBlueTendangan diperbarui menjadi: ${initBlueTendangan}`);
          }
        } else if (color === "red") {
          if (type === "pukulan") {
            initRedPukulan = newValue;
            console.log(`Variabel initRedPukulan diperbarui menjadi: ${initRedPukulan}`);
          } else if (type === "tendangan") {
            initRedTendangan = newValue;
            console.log(`Variabel initRedTendangan diperbarui menjadi: ${initRedTendangan}`);
          }
        }

        // alert(`Poin ${type} untuk tim ${color} berhasil dikurangi 1.`);
      } else {
        console.error(`Elemen dengan ID '${elementId}' tidak ditemukan!`);
      }
      // --- AKHIR LOGIKA UTAMA YANG DIUBAH ---

      // Langsung reset state setelah penghapusan berhasil agar siap untuk aksi berikutnya
      resetDeleteState(color, type);

      fetchAndUpdateAllPoints(pertandinganId);
    } else {
      // Jika ini adalah juri PERTAMA yang meminta hapus, mulai timer 4 detik
      console.log("Menunggu konfirmasi juri kedua untuk penghapusan...");
      currentState.timeoutId = setTimeout(() => {
        console.log(`Waktu habis. Permintaan hapus untuk ${color}-${type} dibatalkan.`);
        // alert(`Permintaan hapus poin untuk tim ${color} tidak valid (tidak ada konfirmasi juri kedua).`);
        resetDeleteState(color, type);
      }, 4000);
    }
  });
}
