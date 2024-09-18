<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin fiók kezelés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid">
        <?php include_once("menuAdmin.php"); ?>


        <div class="container  bg-white">
            <div id="adminFelhasznalo" aria-disabled="false" class="row justify-content-center" style="border: 2px solid black;">
                <div class="col-6">
                    <form action="" method="post">

                        <h3 class="my-4 text-center py-3" style="background-color:gray;">Admin felhasználó hozzáadás</h3> <br>
                        <label for="adminfNev">Felhasználónév</label><br>
                        <input class="form-control" placeholder="vezetéknév.admin" type="text" name="adminfNev" id="adminfNev" required><br>
                        <label class="form-label" for="adminEmail">Email</label> <br>
                        <input class="form-control" placeholder="pelda@pelda.hu" type="text" name="adminEmail" id="adminEmail" required><br>
                        <label class="form-label" for="adminJelszo">Jelszó</label>
                        <input class="form-control" type="password" placeholder="jelszo" name="adminJelszo" id="adminJelszo" required><br>

                        <div class="my-4">
                            <button type="button" class="btn btn-success form-control" onclick="UjAdminHozzadas();">Mentés</button>
                        </div>
                    </form>

                </div>
         
            </div>

            <div class="row justify-content-center" style="border: 2px solid black;">
            <div class="col-6">
                    <form action="" method="post">

                        <h3 class="my-4 text-center py-3"  style="background-color:gray;">Jelszó megváltoztatás</h3> <br>
                        <label for="adminfNev">Régi jelszó</label><br>
                        <input class="form-control" type="password" placeholder="jelszo" name="jelszoRegi" id="jelszoRegi" required><br>
                        <label class="form-label" for="adminEmail">Új jelszó</label> <br>
                        <input class="form-control" type="password" placeholder="jelszo" name="ujJelszo1" id="ujJelszo1" required><br>
                        <label class="form-label" for="adminJelszo">Új jelszó megerősítés</label>
                        <input class="form-control" type="password" placeholder="jelszo" name="ujJelszo2" id="ujJelszo2" required><br>

                        <div class="my-4">
                            <button type="button" class="btn btn-success form-control" onclick="JelszoValtoztas();">Mentés</button>
                        </div>
                    </form>

                </div>
            </div>
        
          
        </div>
</body>

<?php
    $adminId = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;
    ?>
    <script>
    
        var AdminVolt = <?php echo json_encode($adminId === 1); ?>;

            if (!AdminVolt) {
                var adminFelhasznalo = document.getElementById('adminFelhasznalo');
                adminFelhasznalo.style.display = "none";
                  
            } 
    </script>
<script src="../../client/adminKezeles.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>