const id_user = window.location.pathname.split("/").pop();


function kirimPoinSeni(juri, poin){
    fetch("/kirim-poin-seni/" + id_user, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      count: parseInt(poin),
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      // alert(binaanValue + filter);
      console.log(data);
    });
}