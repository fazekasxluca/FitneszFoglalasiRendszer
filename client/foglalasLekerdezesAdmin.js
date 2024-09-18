function FoglalasAdadtokLekerdezesEsFrissites(){

var xhr = new XMLHttpRequest();
xhr.open("GET", "http://127.0.0.1/FitneszFoglalasiRendszer/index.php?foglalas=getFoglalas", true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);

        console.log(data);
        if (data.status === 'success') {
            var table = document.getElementById("table");
            table.innerHTML = '';

            var thead = document.createElement("thead");
            var fejlecSor = '<tr>';

            fejlecSor += '<th>Foglalás azonosító</th>';
            fejlecSor += '<th>Óra azonosító</th>';
            fejlecSor += '<th>Felhasználó azonosító</th>';
            fejlecSor += '<th>Felhasználó név</th>';
            fejlecSor += '<th>Foglalás dátuma</th>';
            fejlecSor += '<th>Foglalt óra dátuma</th>';
            fejlecSor += '<th>Kapacitás</th>';
            fejlecSor += '<th>Feliratkozottak</th>';
            fejlecSor += '<th>Óra Típus</th>';
            fejlecSor += '<th>Nap</th>';
            fejlecSor += '<th>Órakezdete</th>';
            fejlecSor += '<th>Óravége</th>';
            fejlecSor += '</tr>';

            thead.innerHTML = fejlecSor;
            table.appendChild(thead);

            var tbody = document.createElement("tbody");

            data.data.forEach(fejlecAdatok => {
                var sor = `<tr>
                     <td>${fejlecAdatok.foglalasID}</td>
                      <td>${fejlecAdatok.fitneszOraID}</td>
                       <td>${fejlecAdatok.felhasznaloID}</td>
                         <td>${fejlecAdatok.felhasznaloNev}</td>
                    <td>${fejlecAdatok.foglalasDatum} </td>
                     <td>${fejlecAdatok.foglaltOraDatum} </td>
                      <td>${fejlecAdatok.kapacitas}</td>
                       <td>${fejlecAdatok.feliratkozottak}</td>
                    <td>${fejlecAdatok.oraTipus}</td>
                    <td>${fejlecAdatok.aktualisNap}</td>
                    <td>${fejlecAdatok.oraKezdete}:00</td>
                    <td>${fejlecAdatok.oraVege}:00</td>
                </tr>`;
                tbody.innerHTML += sor;
            });

            table.appendChild(tbody);
        } else {
            console.error("Hiba:", data);
        }
    }
};
xhr.send(null);

}
var fitneszOrak = [];
async function fetchFitneszOrak() {
    return fetch('http://127.0.0.1/FitneszFoglalasiRendszer/index.php?foglalas=getFoglalas')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                fitneszOrak = data.data;
            } else {
                console.error("Hiba:");
            }
        })
        .catch(error => {
            console.error("Hiba:", error);
        });
}

function getFelhasznaloID() {
    var oraAzonosito = document.getElementById('oraAzonosito').value;
    var ora = fitneszOrak.find(item => item.fitneszOraID == oraAzonosito); 
    console.log("Talált id :", ora); 
    if (ora) {
        return {
            felhasznaloID: ora.felhasznaloID,
            oraAzonosito: oraAzonosito,
            foglalasID : ora.foglalasID
        };
    } else {
        return null;
    }
}



async function KapacitasVisszaAllitas()
{
    await fetchFitneszOrak();

   var adatok = getFelhasznaloID();

   if (adatok === null) {
    console.error("Nem található a foglaláshoz tartozó óra.");
    return;
}

     fetch('http://127.0.0.1/FitneszFoglalasiRendszer/index.php?foglalas=modKapacitas', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(adatok)
    })
    .then(response => {
          
         response.json(); 
    })
    .then(data =>
    {
        console.log(data);
        FoglalasAdadtokLekerdezesEsFrissites();
        document.getElementById("oraAzonosito").value = "";
    })
    .catch(error => {
        console.error('Error:', error);
    })
  
   
}
FoglalasAdadtokLekerdezesEsFrissites();