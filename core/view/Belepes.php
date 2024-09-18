<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="../view/belepes.css">
</head>

<body>
<?php include_once("../model/ABKezelo.php");


    ABKezelo::Belépés();
    ABKezelo::Regisztracio();
    
?>
    <div class="container-fluid my-3">
        
        <div  class="row my-2 justify-content-center" style="border:2px solid black;">
        <span id="span" class="text-center" style="color:black;background-color:gray;border:2px solid white;border-radius:7px;padding:10px;font-size:40px;font-family: 'Segoe UI';">Fitness Center</span>
            <div class="col-10 col-sm-8 col-md-7 col-lg-6 col-xl-3  text-center my-3">
           
                <form method="post">
                    <label class="my-3" style="margin-bottom:0px;font-size:25px;font-family: 'Segoe UI';" class="form-label text-center" for=""><span id="span" style="color:black;background-color:white;border:2px solid white;border-radius:7px;padding:10px;">Bejelentkezés</span></label><br><br>
                    <input style="padding:5px;border:1px solid black;border-radius:4px;" type="text" placeholder="felhasználónév" name="username" id="username" required><br><br>

                    <input  style="padding:5px;border:1px solid black;border-radius:4px;" type="password" style="height:30px;" placeholder="jelszó" name="pw" id="pw" required><br><br>
                    
                    <input class="btn btn-success" style="width: 190px;height:40px;border:1px solid black;color:black" type="submit" value="Belépés">
                </form>

            </div>
        </div>
        <div class="row my-2 justify-content-center" style="border:2px solid black;background-color:rgba(19, 126, 133, 0.582);">

        </div>
    </div>

    <div class="container-fluid my-3">
        <div class="row my-2 justify-content-center" style="border:2px solid black;">
            <div class="col-10 col-sm-8 col-md-7 col-lg-6 col-xl-3  text-center my-3">
                <form method="post">
                    <label class="my-3"  style="margin-bottom:0px;font-size:25px;font-family: 'Segoe UI';"class="form-label text-center" for=""><span id="span" style="color:black;background-color:white;border:2px solid white;border-radius:7px;padding:10px;">Regisztráció</span></label><br><br>
                    <input  style="padding:5px;border:1px solid black;border-radius:4px;"  type="text" placeholder="felhasználónév" name="nev" id="nev"><br><br>

                    <input  style="padding:5px;border:1px solid black;border-radius:4px;"  type="password" style="height:30px;" placeholder="jelszó" name="jelszo" id="jelszo" required><br><br>
                    <input  style="padding:5px;border:1px solid black;border-radius:4px;"  type="email" style="height:30px;" placeholder="email" name="email" id="email" required><br>
                    <br>
                    <input class="btn btn-success" style="width: 190px;height:40px;border:1px solid black;color:black" type="submit" value="Mentés">
                </form>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>