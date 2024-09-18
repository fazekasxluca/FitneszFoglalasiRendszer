
function GetAdminData() {


    var data = {
        adminfNev: document.getElementById("adminfNev").value,
        adminEmail: document.getElementById("adminEmail").value,
        adminJelszo: document.getElementById("adminJelszo").value
    }
    return data;
};

function UjAdminHozzadas() {
    var data = GetAdminData();

    fetch('http://127.0.0.1/FitneszFoglalasiRendszer/index.php?admin=setAdmin', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify(data)
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            document.getElementById("adminfNev").value = '';
            document.getElementById("adminEmail").value = '';
            document.getElementById("adminJelszo").value = '';
            alert("Sikeres felvitel");
        })
        .catch(error => {
            console.error('Hiba történt:', error.message);
        });
}

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
            var data2 = {

                ujJelszo1: document.getElementById("ujJelszo1").value,
                ujJelszo2: document.getElementById("ujJelszo2").value,
                jelszoRegi: document.getElementById("jelszoRegi").value
            }


        }
        else {
            alert("A jelszavak nem egyeznek");
        }
    }

    return data2;
}

function JelszoValtoztas() {

    var jelszoData = GetjelszoAdatok();

    fetch("http://127.0.0.1/FitneszFoglalasiRendszer/index.php?admin=modJelszo", {
        headers: {
            'Content-Type': 'application/json'
        },
        method: "PUT",
        body: JSON.stringify(jelszoData)
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            document.getElementById("jelszoRegi").value = '';
            document.getElementById("ujJelszo1").value = '';
            document.getElementById("ujJelszo2").value = '';
            alert("Sikeres jelszó módosítás");
        })
        .catch(error => {
            console.error(error);
        })
}