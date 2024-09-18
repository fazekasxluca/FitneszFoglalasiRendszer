function getFormData() {
    return {
        nap: document.getElementById('nap').value,
        oraKezdes: document.getElementById('oraKezdes').value,
        oraVege: document.getElementById('oraVege').value,
        oraTipus: document.getElementById('oraTipus').value,
    }

    
}

function getFormDataModositas() {
    return {
        nap: document.getElementById('nap').value,
        oraKezdes: document.getElementById('oraKezdes').value,
        oraVege: document.getElementById('oraVege').value,
        oraTipus: document.getElementById('oraTipus').value,
    
        napMod: document.getElementById('napMod').value,
        oraKezdesMod: document.getElementById('oraKezdesMod').value,
        oraVegeMod: document.getElementById('oraVegeMod').value,
        oraTipusMod: document.getElementById('oraTipusMod').value
    }

    
}

AdatLekerdezesEsFrissites();

function fitneszOraHozzaAdas() {
    var data = getFormData();
    fetch('http://127.0.0.1/FitneszFoglalasiRendszer/index.php?method=setFitneszOra', {
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
            AdatLekerdezesEsFrissites();
        })
        .catch(error => {
            console.error('Error:', error);
        })
}




function fitneszOraModositas() {
    var data = getFormDataModositas();
    fetch('http://127.0.0.1/FitneszFoglalasiRendszer/index.php?method=modFitneszOra', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'PUT',
        body: JSON.stringify(data)
    })
     .then(response => response.json())
        .then(data => {

            console.log(data);
            AdatLekerdezesEsFrissites();


        })
}

function fitneszOraTorles() {
    var data = getFormData();
    fetch('http://127.0.0.1/FitneszFoglalasiRendszer/index.php?method=delFitneszOra', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'DELETE',
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            console.log('Óra törölve:', data);
            AdatLekerdezesEsFrissites();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function AdatLekerdezesEsFrissites() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://127.0.0.1/FitneszFoglalasiRendszer/index.php?method=getFitneszOra', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);

                var tbody = document.getElementById('tbody');
                var thead = document.getElementById('thead');

                var napokSorrend = ["Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap"];

                var oraCsoportok = {};

                data.data.forEach(ora => {
                    var idopont = `${ora.oraKezdete}-${ora.oraVege}`;
                    if (!oraCsoportok[idopont]) {
                        oraCsoportok[idopont] = {};
                    }
                    oraCsoportok[idopont][ora.aktualisNap] = ora;
                });


                var headRow = '<tr><th>Idő</th>';
                napokSorrend.forEach(nap => {
                    headRow += `<th>${nap}</th>`;
                });
                headRow += '</tr>';
                thead.innerHTML = headRow;


                tbody.innerHTML = '';
                for (var idopont in oraCsoportok) {
                    var sor = `<tr><td>${idopont}</td>`;
                    napokSorrend.forEach(nap => {
                        var ora = oraCsoportok[idopont][nap];
                        sor += `<td>${ora ? ora.oraTipus : ''}</td>`;
                    });
                    sor += '</tr>';
                    tbody.innerHTML += sor;
                }
            } else {
                console.error('Hiba:', xhr.statusText);
            }
        }
    };

    xhr.send(null);
}
