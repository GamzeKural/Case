<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


$fullNameError = $emailError = $numberError = $positionError ="";
$fullName = $email = $number = $position = $sector = "";

// print_r ($_GET);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullName"])) {
      $fullNameError = "İsim Alanı Zorunludur";
    } else {
      $fullName = test_input($_POST["fullName"]);
    }

    if (empty($_POST["email"])) { 
      $emailError = "Email Alanı Zorunludur";
    } else {
      $email = test_input($_POST["email"]);
    }
  
    if (empty($_POST["number"])) {
      $numberError = "Telefon Alanı Zorunludur";
    } else {
      $number = test_input($_POST["number"]);
    }

    if (empty($_POST["position"])) {
        $positionError = "Pozisyon Alanı Zorunludur";
      } else {
        $position = test_input($_POST["position"]);
      }

    if (empty($_POST["sector"])) {
        $sector = "";
    } else {
        $sector = test_input($_POST["sector"]);
    }
}