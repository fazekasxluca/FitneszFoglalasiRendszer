

function getFormData() {
    var data = {
      
        userOra: document.getElementById('userOra').value,
        oraDatum : document.getElementById('oraDatum').value

    };
    console.log(data);
    return data;
}

function AdatLekerdezesEsFrissites() {
  
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1/FitneszteremFoglalasiRendszer/index.php?oraMethod=getOsszesFoglalas", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
    
            if (data.status === 'success' && data.data) {
                var table = document.getElementById("table");
                table.innerHTML = '';
    
                var thead = document.createElement("thead");
                var fejlecSor = '<tr>';
    
                fejlecSor += '<th>Foglalás azonosító</th>';
                fejlecSor += '<th>Óra azonosító</th>';
                fejlecSor += '<th>Foglalás dátuma</th>';
                fejlecSor += '<th>Foglalt óra dátuma</th>';
                fejlecSor += '<th>Óra Típus</th>';
                fejlecSor += '<th> Nap</th>';
                fejlecSor += '<th>Órakezdete</th>';
                fejlecSor += '<th>Óravége</th>';
                
                fejlecSor += '</tr>';
    
                thead.innerHTML = fejlecSor;
                table.appendChild(thead);
    
                var tbody = document.createElement("tbody");
    
                data.data.forEach(fejlecAdatok => {
                    var sor = `
                    <tr>
                    
                        <td>${fejlecAdatok.foglalasID}</td>
                          <td data-fitneszOraID="fitneszOraID">${fejlecAdatok.fitneszOraID}</td>
                        <td>${fejlecAdatok.foglalasDatum}</td>
                        <td>${fejlecAdatok.foglaltOraDatum}</td>
                        <td>${fejlecAdatok.oraTipus}</td>
                        <td>${fejlecAdatok.aktualisNap}</td>
                        <td>${fejlecAdatok.oraKezdete}:00</td>
                        <td>${fejlecAdatok.oraVege}:00</td>
                    </tr>`;
                    tbody.innerHTML += sor;
                });
    
                table.appendChild(tbody);


            } else {
                console.error('Hiba :', data);
            }
        }
    };
    xhr.send(null);

}

AdatLekerdezesEsFrissites();


function SzabadIdoPont() {
    var data = getFormData();

    fetch('http://127.0.0.1/FitneszteremFoglalasiRendszer/index.php?oraMethod=getSzabadIdoPont', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            var szabadIdoPont = document.getElementById("szabadIdoPont");
            szabadIdoPont.innerHTML = ""; 

            var szabadFeroHely = document.getElementById("szabadFeroHely");
            szabadFeroHely.innerHTML = "";

            var foglalas = document.getElementById("foglalas");

            if (data.data && data.data.length > 0) {
                data.data.forEach(idopont => {
                    console.log('Időpont:', idopont.kapacitas);
            
                    if (idopont.kapacitas > 0) {
                        var option = document.createElement('option');
                        var pontosIdo = `${Number(idopont.oraKezdete)} - ${Number(idopont.oraVege)}`;
            
                        option.value = pontosIdo;
                        option.textContent = pontosIdo;
                        szabadIdoPont.appendChild(option);
                        
                      
                        szabadFeroHely.innerHTML = ` Szabad férőhely száma : ${Number(idopont.kapacitas)} --- Időpont(ok) : ${Number(idopont.oraKezdete)}:00 - ${Number(idopont.oraVege)}:00`;
                
            
                    } else {
                    
                        foglalas.disabled = true;
                        alert("Elfogytak a szabad időpontok");
                    }
                });
            }else
            {
                alert("Az adott napra nem található a keresett óra");
            }
            
        })
        .catch(error => {
            console.error("Hiba: ", error);
        });
}

function getFormData2() {

    var formData = {
        oraDatum : document.getElementById('oraDatum').value,
        userOra : document.getElementById('userOra').value,
        szabadIdoPont : document.getElementById("szabadIdoPont").value
    };
    return formData;
}

function FoglalasMentes() {
    var formData = getFormData2();

    fetch('http://127.0.0.1/FitneszteremFoglalasiRendszer/index.php?oraMethod=SetFoglalas', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
              AdatLekerdezesEsFrissites();
                alert("Sikeres foglalás");
                document.getElementById("oraDatum").selectedIndex = 0;
                document.getElementById("userOra").selectedIndex = 0;
                document.getElementById("szabadIdoPont").selectedIndex = 0;
                document.getElementById("szabadFeroHely").innerHTML = '';
            
        } else if(data.status ==="error") {
           alert(data.message);
           
        }
        else
        {
            alert("Nem található az adott napra a kívánt óra");
        }
    })
    .catch(error => {
        console.error('Hiba:', error);
    });
}


var fitneszOrak = []; 

 async function fetchFitneszOrak() {
    return fetch('http://127.0.0.1/FitneszteremFoglalasiRendszer/index.php?oraMethod=getOsszesFoglalas')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                fitneszOrak = data.data;
            } else {
                console.error("Hiba");
            }
        })
        .catch(error => {
            console.error("Hiba:", error);
        });
}



function getFitneszOraID() {
    var foglalasAzonosito = document.getElementById("foglalasAzonosito").value;
    var ora = fitneszOrak.find(item => item.foglalasID == foglalasAzonosito); 
    if (ora) {
        return {
            fitneszOraID: ora.fitneszOraID,
            foglalasAzonosito: foglalasAzonosito
        };
    } else {
        return null;
    }
}

async function FoglalasTorles() {
  await  fetchFitneszOrak(); 

    var adatok = getFitneszOraID();

    if (adatok === null) {
        console.error("Nem található a foglaláshoz tartozó óra.");
        return;
    }

    fetch('http://127.0.0.1/FitneszteremFoglalasiRendszer/index.php?oraMethod=delFoglalas', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'DELETE',
        body: JSON.stringify(adatok) 
    })
    .then(response => response.json())  
    .then(data => {
        console.log(data);
       AdatLekerdezesEsFrissites();
    })
    .catch(error => {
        console.error('Hiba:', error.message);
    });
}




