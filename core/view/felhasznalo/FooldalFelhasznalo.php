<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Főoldal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/felhasznalo/FooldalFelhasznalo.css">
    <link rel="stylesheet" href="../view/Footer.css">

</head>

<body id="body">
    <div class="container-fluid w-100">
        <?php
        include_once("menuFelhasznalo.php");
        ?>
        <div id="tableContainer" class="col-12 table-responsive w-100 my-4 container">
            <h2 id="h2" class="text-center my-3 text-black"><span id="span" style="background-color: white;border: 2px solid white;padding:5px;border-radius:7px"></span></h2>
            <div class="row">
                <table  class="table table-striped my-5y ">
                    <thead id="thead" class="table-dark">

                        </tdead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
           
        </div>
      

    </div>

 
    <?php

    $method = $_GET["actionFelhasznalo"];
    if ($_GET["actionFelhasznalo"] && $method == "oraRend") {
        echo "<script src='../../client/oraRendLekerdezes.js'></script>";
       
    }
    else
    {
      include_once("../view/footer.php");
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/81f5ee9471.js" crossorigin="anonymous"></script>
</body>

</html>