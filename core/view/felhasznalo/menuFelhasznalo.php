<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../view/felhasznalo/FooldalFelhasznalo.css">
</head>
<body>
    
<div class="col-12">
            <div class="row">
                <nav class="navbar navbar-expand-lg bg-black">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav navbar-center">
                                <li class="nav-item">
                                    <a id="foodal" class="nav-link" href="http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=fooldalFelhasznalo">Főoldal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=oraRend">Órarend</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=foglalas">Foglalás</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=arak">Áraink</a>
                                </li>
            
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=kapcsolat">Kapcsolat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=fiokKezeles">Fiók kezelése</a>
                                </li>
                            </ul>
                            <ul class="navbarNav">
                                <li style="list-style: none;" class="nav-item">
                                    <a class="nav-link" aria-current="page"> <button id="kijelentkezes" onclick="Kijelentkzes();" class="btn btn-secondary">Kijelentkezés</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

  <script src="../../client/kijelentkezes.js"></script>
</body>
</html>