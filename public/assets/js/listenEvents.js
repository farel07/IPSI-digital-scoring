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

    // binaan
    const channel = pusher.subscribe("kirim-binaan-channel");
    channel.bind("terima-binaan", function (data) {
        // alert(`Binaan diterima: ${data.isi}`);
        const yellowFilter =
            "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
        document.getElementById("notif-binaan").style.filter = yellowFilter;
    });

    // peringatan
    const channel2 = pusher.subscribe("kirim-peringatan-channel");
    channel2.bind("terima-peringatan", function (data) {
        alert(`peringatan: ${data.isi}`); // Menggunakan alert seperti contoh Anda
    });
}
