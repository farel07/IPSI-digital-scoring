const id_user = window.location.pathname.split("/").pop();
// const role_juri = document.getElementById("role_juri").value;
const filter = document.getElementById("filter").value;
// const nilaiAkhir = document.getElementById("nilaiAkhir").value;
const unit_id = document.getElementById("unit_id").value;

function kirimPoinSeni(type, poin, unit_id){

  // Ambil elemen dengan ID finalScore

    fetch("/kirim-poin-seni/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      poin: parseFloat(poin),
      type: type,
      unit_id: document.getElementById("unit_id").value,
      // role_juri: role_juri,
      filter: filter,
      // nilaiAkhir: nilaiAkhir
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      // alert(binaanValue + filter);
      console.log(data);
    });
}

