<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/felhasznalo/Foglalas.css">
    <link rel="stylesheet" href="../view/felhasznalo/FooldalFelhasznalo.css">
</head>


<?php
   $filePath = __DIR__ . "../../../model/ABKezelo.php";
   if(file_exists($filePath))
   {
    include_once($filePath);
   }
   else
   {
    echo "File not found " . $filePath;
   }

?>
<body id="body">
<div class="container-fluid w-100">
    
      <?php
      include_once("../view/felhasznalo/menuFelhasznalo.php");
      ?>
      <div class="container">

        <div class="row my-4">
            <div class="col-12  my-4 bg-white">
                <h3 class="my-4 text-center">Óra foglalás</h3>
                <form method="post">
                    <label class="form-label" for="">Óra típus</label>
                    <select class="form-select my-3" id="userOra" name="userOra">
                        <option value="Aerobic">Aerobic</option>
                        <option value="Zumba">Zumba</option>
                        <option value="TRX">TRX</option>
                        <option value="Spinning">Spinning</option>
                        <option value="Jóga">Jóga</option>
                        <option value="HotIron">HotIron</option>
                        <option value="Kangoo">Kangoo</option>
                            <option value="IronCross">IronCross</option>
                    </select>
                    <label class="form-label" for="">Foglalás a következő dátumra:</label><br>
                    <input class="form-control" type="date" name="oraDatum" id="oraDatum"><br>
                 
                    <button type="button" class="btn btn-primary form-control text-center my-3"  onclick="SzabadIdoPont();">Mutasd a szabad időpontokat</button><br><br>
                    <label class="form-label" for="">Szabad időpontok</label><br>
                    <select class="form-select" id="szabadIdoPont" name="szabadIdoPont">
                       
                    </select><br>

                    <h3  id="szabadFeroHely"></h3>
                   
                    <button type="button" class="btn btn-success text-center my-3 form-control" id="foglalas" onclick="FoglalasMentes();">Foglalás</button>

                    <br>
                </form>
            </div>
        </div>

        <hr>
        <div class="row my-4">
            <div class="col-12  table-responsive my-4 bg-white">
                <h3 class="my-4 text-center">Foglalásaim</h3>
                <form method="post">
                <table class="table table-striped my-5"   id="table">
                 
                </table>
                <br><br>
                <label class="form-label" for="">Lemondás esetén adja meg a foglalás azonosítot</label><br>
                <input class="form-control" type="number" name="foglalasAzonosito" id="foglalasAzonosito"><br><br>
                </form>
                <button type="button" class="btn btn-danger text-center my-5 form-control" id="gombElem"   onclick="FoglalasTorles();">Lemondás</button>
            </div>
        </div>
    </div>
    </div> 
    <?php include_once("../view/footer.php"); ?>   
    <script src="../../client/foglalasKezeles.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>