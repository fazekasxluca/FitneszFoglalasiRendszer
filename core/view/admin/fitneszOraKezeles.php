<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../view/admin/FooldalAdmin.css">
</head>

<body>
    <div class="container-fluid">
        <?php include_once("../view/admin/menuAdmin.php") ?>

        <div class="container bg-white" style="border: 1px solid black;">
            <h3 class=" my-3 text-center py-4" style="background-color:gray;">Órarend</h3>
            <div class="col-12 table-responsive"  style="overflow: auto;">

                <table class="table table-striped my-5 display:flex">
                    <thead id="thead" class="table-dark">

                        </tdead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
            <h3 class="text-center py-4" style="background-color:gray;">Órarend kezelés</h3>
            <div class="row">
                <div class="col-6 py-3">
                           
                    <form action="" method="post">
                        <label class="form-label my-2" for="nap" >Óra típusok</label> <br>
                        <select class="form-select" name="oraTipus" id="oraTipus" require>
                            <option value="Aerobic">Aerobic</option>
                            <option value="Zumba">Zumba</option>
                            <option value="Spinning">Spinning</option>
                            <option value="HotIron">HotIron</option>
                            <option value="TRX">TRX</option>
                            <option value="Jóga">Jóga</option>
                            <option value="Kangoo">Kangoo</option>
                            <option value="IronCross">IronCross</option>
                        </select><br>
                        <label for="">Aktuális nap</label><br>
                        <select class="form-select" id="nap" name="nap">
                            <option value="Hétfő">Hétfő</option>
                            <option value="Kedd">Kedd</option>
                            <option value="Szerda">Szerda</option>
                            <option value="Csütörtök">Csütörtök</option>
                            <option value="Péntek">Péntek</option>
                            <option value="Szombat">Szombat</option>
                            <option value="Vasárnap">Vasárnap</option>
                        </select>
                        <br>
                        <label class="form-label" for="kezdes">Óra kezdés</label> <br>
                        <input class="form-control" placeholder="9" type="number" name="oraKezdes" id="oraKezdes" require><br>
                        <label class="form-label" for="vege">Óra vége</label> <br>
                        <input class="form-control" placeholder="10" type="number" name="oraVege" id="oraVege" require><br>
                        <br>
                        <label style="color:red;" for="">(*Felvitel ill. törlés esetén a bal oldai űrlapon kell  az adatokat felvinni.*)</label>
                </form>
                </div>
                <div class="col-6 py-3">
                <form action="" method="post">
            
                        <label class="form-label" for="nap">Óra típusok</label> <br>
                        <select class="form-select" name="oraTipusMod" id="oraTipusMod" require>
                            <option value="Aerobic">Aerobic</option>
                            <option value="Zumba">Zumba</option>
                            <option value="Spinning">Spinning</option>
                            <option value="HotIron">HotIron</option>
                            <option value="TRX">TRX</option>
                            <option value="Jóga">Jóga</option>
                            <option value="Kangoo">Kangoo</option>
                            <option value="IronCross">IronCross</option>
                        </select><br>
                        <label for="">Aktuális nap</label><br>
                        <select class="form-select" id="napMod" name="napMod">
                            <option value="Hétfő">Hétfő</option>
                            <option value="Kedd">Kedd</option>
                            <option value="Szerda">Szerda</option>
                            <option value="Csütörtök">Csütörtök</option>
                            <option value="Péntek">Péntek</option>
                            <option value="Szombat">Szombat</option>
                            <option value="Vasárnap">Vasárnap</option>
                        </select>
                        <br>
                        <label class="form-label" for="kezdesMod">Óra kezdés</label> <br>
                        <input class="form-control" placeholder="9" type="number" name="oraKezdesMod" id="oraKezdesMod" require><br>
                        <label class="form-label" for="vege">Óra vége</label> <br>
                        <input class="form-control" placeholder="10" type="number" name="oraVegeMod" id="oraVegeMod" require><br>
                        <br>
                        
                        <label style="color:red;" for="">(*Módosístás esetén a bal oldai űrlapon kell felvinni a módosítani kivánt órát, a jobb oldai űrlapon pedig a módosítandó adatoknak kell szerepelnie.*)</label>
                    </form>
                  
                </div>
            </div>
            <div class="text-center my-3">
                <button type="button" class="btn btn-success" onclick="fitneszOraHozzaAdas();">Felvitel</button>
                <button type="button" class="btn btn-danger" onclick="fitneszOraModositas();">Módositás</button>
                <button type="button" class="btn btn-warning" onclick="fitneszOraTorles();">Törlés</button>
            </div>
        </div>
    </div>


    <script src="../../client/fitneszOraKezeles.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</body>

</html>