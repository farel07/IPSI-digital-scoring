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

    // penilaian
    const yellowFilter =
        "brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)";
    // binaan
    const blueBinaanChannel = pusher.subscribe("kirim-binaan-channel");
    blueBinaanChannel.bind("terima-binaan", function (data) {
        if (data.filter == "blue") {
            if (data.count == 1) {
                document.getElementById("blue-notif-binaan-1").style.filter =
                    yellowFilter;
            } else if (data.count == 2) {
                document.getElementById("blue-notif-binaan-2").style.filter =
                    yellowFilter;
            } else {
                alert("binaan cuman 2x banh");
            }
        } else if (data.filter == "red") {
            if (data.count == 1) {
                document.getElementById("red-notif-binaan-1").style.filter =
                    yellowFilter;
            } else if (data.count == 2) {
                document.getElementById("red-notif-binaan-2").style.filter =
                    yellowFilter;
            } else {
                alert("binaan cuman 2x banh");
            }
        } else {
            alert("cuman 2 warna side aja yaa");
        }
    });

    // teguran
    const blueTeguranChannel = pusher.subscribe("kirim-teguran-channel");
    blueTeguranChannel.bind("terima-teguran", function (data) {
        if (data.filter == "blue") {
            if (data.count == 1) {
                document.getElementById("blue-notif-teguran-1").style.filter =
                    yellowFilter;
                document.getElementById(
                    "blue-notif-teguran-1-table"
                ).innerHTML = 1;
            } else if (data.count == 2) {
                document.getElementById("blue-notif-teguran-2").style.filter =
                    yellowFilter;
                document.getElementById(
                    "blue-notif-teguran-2-table"
                ).innerHTML = 1;
            } else {
                alert("teguran cuman 2x banh");
            }
        } else if (data.filter == "red") {
            if (data.count == 1) {
                document.getElementById("red-notif-teguran-1").style.filter =
                    yellowFilter;
                document.getElementById(
                    "red-notif-teguran-1-table"
                ).innerHTML = 1;
            } else if (data.count == 2) {
                document.getElementById("red-notif-teguran-2").style.filter =
                    yellowFilter;
                document.getElementById(
                    "red-notif-teguran-2-table"
                ).innerHTML = 1;
            } else {
                alert("teguran cuman 2x banh");
            }
        } else {
            alert("cuman 2 warna side aja yaa");
        }
    });

    // peringatan
    const bluePeringatanChannel = pusher.subscribe("kirim-peringatan-channel");
    bluePeringatanChannel.bind("terima-peringatan", function (data) {
        if (data.filter == "blue") {
            if (data.count == 1) {
                document.getElementById(
                    "blue-notif-peringatan-1"
                ).style.filter = yellowFilter;
                document.getElementById(
                    "blue-notif-peringatan-1-table"
                ).innerHTML = 1;
            } else if (data.count == 2) {
                document.getElementById(
                    "blue-notif-peringatan-2"
                ).style.filter = yellowFilter;
                document.getElementById(
                    "blue-notif-peringatan-2-table"
                ).innerHTML = 1;
            } else if (data.count == 3) {
                document.getElementById(
                    "blue-notif-peringatan-3"
                ).innerHTML = 1;
            } else {
                alert("stop :3");
            }
        } else if (data.filter == "red") {
            if (data.count == 1) {
                document.getElementById("red-notif-peringatan-1").style.filter =
                    yellowFilter;
                document.getElementById(
                    "red-notif-peringatan-1-table"
                ).innerHTML = 1;
            } else if (data.count == 2) {
                document.getElementById("red-notif-peringatan-2").style.filter =
                    yellowFilter;
                document.getElementById(
                    "red-notif-peringatan-2-table"
                ).innerHTML = 1;
            } else if (data.count == 3) {
                document.getElementById("red-notif-peringatan-3").innerHTML = 1;
            } else {
                alert("stop :3");
            }
        } else {
            alert("cuman 2 warna side aja yaa");
        }
    });

    // jatuhan
    const jatuhanChannel = pusher.subscribe("kirim-jatuh-channel");
    let initBlue = 0;
    let initRed = 0;
    jatuhanChannel.bind("terima-jatuh", function (data) {
        if (data.filter == "blue") {
            document.getElementById("blue-notif-jatuhan-table").innerHTML =
                initBlue = initBlue + data.count;
        } else if (data.filter == "red") {
            document.getElementById("red-notif-jatuhan-table").innerHTML =
                initRed = initRed + data.count;
        } else {
            alert("cuman 2 warna side aja yaa");
        }
    });
}
