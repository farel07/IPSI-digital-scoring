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

    // dewan
    // binaan
    const blueBinaanChannel = pusher.subscribe("kirim-binaan-channel");
    blueBinaanChannel.bind("terima-binaan", function (data) {
        if (data.count == 1) {
            const yellowFilter =
                "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
            const elem = document.getElementById("blue-notif-binaan-1");
            if (elem) {
                elem.style.filter = yellowFilter;
            } else {
                console.warn('Element with ID "blue-notif-binaan-1" not found.');
            }
        } else if (data.count == 2) {
            const yellowFilter =
                "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
            const elem = document.getElementById("blue-notif-binaan-2");
            if (elem) {
                elem.style.filter = yellowFilter;
            } else {
                console.warn('Element with ID "blue-notif-binaan-2" not found.');
            }
        } else {
            alert("binaan cuman 2x banh");
        }
    });

    // teguran
    const blueTeguranChannel = pusher.subscribe("kirim-teguran-channel");
    blueTeguranChannel.bind("terima-teguran", function (data) {
        if (data.count == 1) {
            const yellowFilter =
                "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
            document.getElementById("blue-notif-teguran-1").style.filter =
                yellowFilter;
        } else if (data.count == 2) {
            const yellowFilter =
                "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
            document.getElementById("blue-notif-teguran-2").style.filter =
                yellowFilter;
        } else {
            alert("teguran cuman 2x banh");
        }
    });

    // peringatan
    const bluePeringatanChannel = pusher.subscribe("kirim-peringatan-channel");
    bluePeringatanChannel.bind("terima-peringatan", function (data) {
        if (data.count == 1) {
            const yellowFilter =
                "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
            document.getElementById("blue-notif-peringatan-1").style.filter =
                yellowFilter;
        } else if (data.count == 2) {
            const yellowFilter =
                "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
            document.getElementById("blue-notif-peringatan-2").style.filter =
                yellowFilter;
        } else if (data.count == 3) {
            document.getElementById("blue-notif-peringatan-3").innerHTML = "1";
        } else {
            alert("stop :3");
        }
    });

    // jatuhan
    const jatuhanChannel = pusher.subscribe("kirim-jatuhan-channel");
    jatuhanChannel.bind("terima-jatuhan", function (data) {});
}
