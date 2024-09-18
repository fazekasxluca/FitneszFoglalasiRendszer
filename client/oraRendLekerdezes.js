var xhr = new XMLHttpRequest();
xhr.open('GET', 'http://127.0.0.1/FitneszFoglalasiRendszer/index.php?method=getFitneszOra', true);
xhr.setRequestHeader('Content-Type', 'application/json');

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);

            var tbody = document.getElementById('tbody');
            var thead = document.getElementById('thead');
            var span = document.getElementById("span");
            var h2 = document.getElementById("h2");

            span.innerHTML= "Órarend";
            var napokSorrend = ["Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap"];

            var oraCsoportok = {};

            data.data.forEach(ora => {
                var idopont = `${ora.oraKezdete}-${ora.oraVege}`;
                if (!oraCsoportok[idopont]) {
                    oraCsoportok[idopont] = {};
                }
                oraCsoportok[idopont][ora.aktualisNap] = ora;
            });

            var fejlecSor = '<tr><th>Idő</th>';
            napokSorrend.forEach(nap => {
                fejlecSor += `<th>${nap}</th>`;
            });
            fejlecSor += '</tr>';
            thead.innerHTML = fejlecSor;

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
            h2.appendChild(span);
        } else {
            console.error('Hiba:', xhr.statusText);
        }
    }
};

xhr.send(null);