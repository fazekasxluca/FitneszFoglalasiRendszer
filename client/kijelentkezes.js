
function Kijelentkzes() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1/FitneszteremFoglalasiRendszer/index.php?outlog=kijelentkezes", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {

                if ('user_id') {
                    window.location.href = "http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=belepes";
                }

                if ('admin_id') {
                    window.location.href = "http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=belepes";
                }




            } else {
                console.error("Hiba történt a kijelentkezés során: " + xhr.status);
            }
        }
    };

    xhr.send(null);
}


