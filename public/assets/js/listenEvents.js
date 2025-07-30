Pusher.logToConsole = true;
const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
});

// binaan event
const channel = pusher.subscribe("kirim-binaan-channel");
channel.bind("terima-binaan", function (data) {
    document.getElementById(
        "binaan-notif"
    ).innerHTML = `<strong>${data.isi}</strong>:`;
});
