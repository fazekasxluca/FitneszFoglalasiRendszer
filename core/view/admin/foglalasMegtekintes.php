
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fogalások</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/admin/FooldalAdmin.css">
</head>


<body>

    <div class="container-fluid">
        <?php include_once("../view/admin/menuAdmin.php"); ?>
    <div class="container bg-white">
        <div class="row">
            <div class="col-12 table-responsive"  style="overflow: auto;">
                <h3 class="my-4 text-center text-black py-4 w-100"  style="background-color:gray;min-width:1200px;"><span>Összesített foglalások</span></h3>
                <table class="table table-striped" id="table">

                </table>
                <br>
                <hr>
                <form method="post">
                    <label class="form-label" for="">Fitnesz óra azonosító megadása</label><br>
                    <input class="form-control" type="number" name="oraAzonosito" id="oraAzonosito"><br>
                    <button type="button" class="btn btn-primary my-3" onclick="KapacitasVisszaAllitas();">Foglalás törlés</button>
                </form>

            </div>
        </div>
    </div>

    </div>
 
    <script src="../../client/foglalasLekerdezesAdmin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>