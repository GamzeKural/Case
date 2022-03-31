<?php
require 'db.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


$fullNameError = $emailError = $numberError = $positionError ="";
$fullName = $email = $number = $position = $sector = "";

 print_r ($_POST);

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


// function AddDataUsers(){
//     global $db;

//     $fullName = $_POST["fullName"];
//     $email = $_POST["email"];
//     $number = $_POST["number"];
//     $position = $_POST["position"];
//     $sector = $_POST["sector"];

//      $sql = "INSERT INTO users
//              SET fullName = '{$fullName}',
//              email = '{$email}',
//              number = '{$number}',
//              position = '{$position}',
//              sector = '{$sector}'";
    
//     $q = $db->query($sql);
       
//     if($q){
//         echo 'Veritabanına kullanıcınız eklenmiştir.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }

// }
//   AddDataUsers();