<?php

$filePath = __DIR__ . "/core/model/ABKezelo.php";
  if (file_exists($filePath)) {
      include_once($filePath);
  } else {
      echo "File not found: " . $filePath;
  }

  $filePath = __DIR__ . "/core/controller/AdminController.php";
  if (file_exists($filePath)) {
      include_once($filePath);
  } else {
      echo "File not found: " . $filePath;
  }

  $filePath = __DIR__ . "/core/controller/UserController.php";
  if (file_exists($filePath)) {
      include_once($filePath);
  } else {
      echo "File not found: " . $filePath;
  }


AdminController::HandleRequest();
AdminController::FoglalasHandleRequest();
UserController::OraRendHandleRequest();
AdminController::AdminHandleRequest();
UserController::UserHandeRequset();


?>