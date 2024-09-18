
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../view/admin/FooldalAdmin.css">
</head>
<body>
        <div class="col-12">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark  bg-black">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav navbar-center">
                                 <li class="nav-item">
                                    <a id="fooldal" class="nav-link" href="http://127.0.0.1/FitneszFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=fooldalAdmin">Főoldal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=foglalasok">Foglalások kezelése</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1/FitneszFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=fitneszOraKezeles">Fitneszórák kezelése</a>
                                </li>
                                <li id="adminFiok" class="nav-item" aria-disabled="true">
                                    <a  id="tartalom" class="nav-link" href="http://127.0.0.1/FitneszFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=adminFiokokKezeles">Admin fiókok  kezelése</a>
                                </li>
                            </ul>

                            <ul class="navbarNav">
                                <li style="list-style: none;" class="nav-item">
                                    <a class="nav-link" aria-current="page"> <button id="kijelentkezes"  class="btn btn-secondary" onclick="Kijelentkzes();">Kijelentkezés</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <?php
    $adminId = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;
    ?>
    <script>
    
        var AdminVolt = <?php echo json_encode($adminId === 1); ?>;

            if (!AdminVolt) {
                var adminFiokLi = document.getElementById('adminFiok');
                var tartalom =  document.getElementById('tartalom');
                if (adminFiokLi) {
                    adminFiokLi.style.display = 'block';
                    tartalom.innerHTML = "Fiók kezelése"
                }
            } else {
                var adminFiokLi = document.getElementById('adminFiok');
                if (adminFiokLi) {
                    adminFiokLi.style.display = 'block'; 
                    adminFiokLi.setAttribute('aria-disabled', 'false');
                }
            }
    </script>
        <script src="../../client/kijelentkezes.js"></script>
</body>
</html>