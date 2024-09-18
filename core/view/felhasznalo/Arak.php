<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Árak</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/felhasznalo/Kapcsolat.css">
    <link rel="stylesheet" href="../view/felhasznalo/FooldalFelhasznalo.css">
</head>

<body>
    <div class="container-fluid">
        <?php
        include_once("../view/felhasznalo/menuFelhasznalo.php");
        ?>
        <div class="container my-5">
          <p id="p">Árak</p>
        
        <div id="row" class="row  my-5">
            <div id="elerhetosegek" class="col-12  col-md-3 col-lg-3 col-xl-3">
                <section  id="section">Alkalmi belépőjegyek</section>
                <ul class="ul">
                    <li class="li">Napijegy <span class="span">1700 Ft.</span> </li>
                    <li class="li"> Diák/nyugdíjas napijegy <span class="span">1500 Ft.</span> </li>
                    <li class="li"> Csoportos óra <span class="span">2000 Ft</span> </li>
                </ul>

            </div>
        
            <div id="elerhetosegek" class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <section id="section">Bérletek</section>
                <ul class="ul">
                    <li class="li">Diák / nyugdíjas fitness havi bérlet <span class="span">12.000 Ft.</span> </li>
                    <li class="li"> Csoportos óra havi korlátlan bérlet<span class="span">16.000 Ft.</span> </li>
                    <li class="li">10 alkalmas csoportos óra bérlet <span class="span"> 17 500 Ft.</span></li>
                    <li class="li"> 3 havi fitness bérlet <span class="span">42.000 Ft.</span></li>
                </ul>
            </div>
            </div>
        </div>
        </div>
    </div>
  
  
  
    <div class="my-3">
   <?php include_once("../view/footer.php"); ?>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/81f5ee9471.js" crossorigin="anonymous"></script>
</body>

</html>