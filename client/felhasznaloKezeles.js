function GetjelszoAdatok() {


    var jelszoRegi = document.getElementById("jelszoRegi").value;
    var ujJelszo1 = document.getElementById("ujJelszo1").value;
    var ujJelszo2 = document.getElementById("ujJelszo2").value;

    if (!jelszoRegi || !ujJelszo1 || !ujJelszo2) {
        alert("Kérlek, töltsd ki az összes  mezőt.");
        return;
    }
    else {
        if (ujJelszo1 === ujJelszo2) {
            var data1 = {

                ujJelszo1: document.getElementById("ujJelszo1").value,
                ujJelszo2: document.getElementById("ujJelszo2").value,
                jelszoRegi: document.getElementById("jelszoRegi").value
            }
        }
        else {
            alert("A jelszavak nem egyeznek");
        }
    }

    return data1;
}

function JelszoValtoztas() {

    var jelszoData = GetjelszoAdatok();

    fetch("http://127.0.0.1/FitneszFoglalasiRendszer/index.php?felhasznalo=modJelszo", {
        headers: {
            'Content-Type': 'application/json'
        },
        method: "PUT",
        body: JSON.stringify(jelszoData)
    })
        .then(response => response.json())
        .then(data => {

            if (data.status === "success") {
                document.getElementById("jelszoRegi").value = '';
                document.getElementById("ujJelszo1").value = '';
                document.getElementById("ujJelszo2").value = '';
                alert(data.message);

            }
            else if (data.status === "error") {
                alert(data.message);
            }

        })
        .catch(error => {
            console.error(error);
        })
}