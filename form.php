<?php
require 'db.php';
require 'httpResponceCode.php';
// print_r($_POST);
//  $formname=$_GET['formname'];
//  $status=$_GET['status'];
$formname="toefl";
$status=1;
$arr=[
      "formname"=>$formname,
      "status"=>$status
    ];
$arr = json_encode($arr);



###VERİ EKLEME###
// if(isset($_POST['formname'])){
function AddDataForm($arr){
    global $db;
    global $text;
    
    $arr = json_decode($arr,true);
    $formname=$arr['formname'];
    $status=$arr['status'];
    
     $sql = "INSERT INTO form
             SET formname = '{$formname}',
             status = '{$status}'";
    
    $q = $db->query($sql);
    if($q){
      echo http_response_code1(200);
    }else{
       echo http_response_code1(400);
    }

}
AddDataForm($arr);


###VERİ LİSTELEME###
function ListDataForm(){
    global $db;
    $sql = "SELECT * FROM form";
    $q = $db->query($sql);
    $forms = $q->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    $json_veri=json_encode($forms);
    print_r($json_veri);

}
// ListDataForm();
$id=20;
$formname="güncel2 sınav";
$status=1;
$arr2 =[
    "id"=>$id,
"formname"=>$formname,
"status"=>$status];
$arr2 = json_encode($arr2);
###VERİ GÜNCELLEME###
function UpdateDataForm($arr2){
    global $db;
    global $text;
    
    $arr2 = json_decode($arr2,true);
    $id=$arr2['id'];
    $formname=$arr2['formname'];
    $status=$arr2['status'];

    $sql = "UPDATE form
            SET formname = '{$formname}',
             status = '{$status}'
             WHERE id = '{$id}'";
    
    $q = $db->query($sql);

    if($q){
        echo http_response_code1(200);
    }else{
       echo http_response_code1(400);
    }
}
// UpdateDataForm($arr2);


// ###VERİ PASİFE ALMA###
// function DeactivationDataForm($id){
    
//     global $db;

//     $sql = "UPDATE form SET status = 0 
//             WHERE id='{$id}'";

//     $q = $db->query($sql);

//     if($q){
//         echo 'Veritabanında formunuz pasife alınmıştır.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }
// }

// //  DeactivationDataForm(7);


// ###PASİF VERİYİ AKTİFLEŞTİRME###

// function ActivationDataForm($id){
    
//     global $db;

//     $sql = "UPDATE form SET status = 1 
//             WHERE id='{$id}'";

//     $q = $db->query($sql);

//     if($q){
//         echo 'Veritabanında formunuz aktifleşmiştir.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }
// }

// //  ActivationDataForm(7);

function activeOrPassiveForm($id){

    global $db;

    $sql = "SELECT * FROM form WHERE id ='{$id}'";
    $q = $db->query($sql);
    $forms= $q ->fetch(PDO::FETCH_ASSOC);
    //$forms = $q->fetchAll(PDO::FETCH_ASSOC);

    if($forms['status']==1){
    
        $update_sql = "UPDATE form SET status = 0 
                WHERE id='{$id}'";
    }else{
        
        $update_sql = "UPDATE form SET status = 1 
                WHERE id='{$id}'";

    }
    $q = $db->query($update_sql);

    //print_r($forms);

}

// activeOrPassiveForm(6);
// }