// public/js/binaanListener.js

/**
 * Fungsi untuk memulai listener event binaan dari Pusher.
 * @param {string} appKey - Kunci aplikasi dari Pusher.
 * @param {string} appCluster - Cluster dari Pusher.
 */
function initializeListener(appKey, appCluster) {
    if (!appKey || !appCluster) {
        console.error("Pusher Key atau Cluster tidak diberikan.");
        return;
    }

    Pusher.logToConsole = true;

    const pusher = new Pusher(appKey, {
        cluster: appCluster,
    });

    // Subscribe ke channel spesifik untuk binaan
    const channel = pusher.subscribe("kirim-binaan-channel");
    // Bind event 'terima-binaan'
    channel.bind("terima-binaan", function (data) {
        alert(`Binaan diterima: ${data.isi}`); // Menggunakan alert seperti contoh Anda
    });
}
