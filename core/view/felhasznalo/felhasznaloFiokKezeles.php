<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin fiók kezelés</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/felhasznalo/FooldalFelhasznalo.css">
</head>

<body id="body">

    <div class="container-fluid">
        <?php include_once("menuFelhasznalo.php"); ?>


        <div class="container bg-white">
            <div class="row justify-content-center" style="border: 2px solid black;">
            <div class="col-6">
                    <form action="" method="post">

                        <h3 class="my-4 text-center py-3"  style="background-color:gray;">Jelszó megváltoztatás</h3> <br>
                        <label for="adminfNev">Régi jelszó</label><br>
                        <input class="form-control" type="password" placeholder="régi jelszó" name="jelszoRegi" id="jelszoRegi" required><br>
                        <label class="form-label" for="adminEmail">Új jelszó</label> <br>
                        <input class="form-control" type="password" placeholder="új jelszó" name="ujJelszo1" id="ujJelszo1" required><br>
                        <label class="form-label" for="adminJelszo">Új jelszó megerősítés</label>
                        <input class="form-control" type="password" placeholder="új jelszó" name="ujJelszo2" id="ujJelszo2" required><br>

                        <div class="my-4">
                            <button type="button" class="btn btn-success form-control" onclick="JelszoValtoztas();">Mentés</button>
                        </div>
                    </form>

                </div>
            </div>
        
          
        </div>
</body>


<script src="../../client/felhasznaloKezeles.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>