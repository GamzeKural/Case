<?php
require 'db.php';
require 'httpResponceCode.php';
// print_r($_POST);
//  $formname=$_GET['formname'];
//  $status=$_GET['status'];
// $formname="toefl";
// $status=1;
//  $formname=$_POST['formname'];
//  $status=$_POST['status'];
// $arr=[
//       "formname"=>$formname,
//       "status"=>$status
//     ];
// $arr = json_encode($arr);

if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['add_form_data']){

    AddDataForm($_REQUEST);
}

###VERİ EKLEME###
// if(isset($_POST['formname'])){
function AddDataForm($arr){
    global $db;
    global $text;
    $formname=$arr['formname'];
    $status=$arr['status'];
    

    $sorgu = $db->prepare("INSERT INTO form( formname , status ) VALUES('$formname',$status)");
    $sorgu->execute();

    $last_id = $db->lastInsertId();
    
    $sorgu = $db->query("SELECT * FROM form WHERE id = $last_id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
    if($cikti){
        echo json_encode(["message" => 'Başarıyla yeni form verisi ekledin',"data" => $cikti,"response_code" => http_response_code1(200)]);
    }else{
        echo json_encode(["message" => 'Form verisi eklenemedi',"data" => NULL,"response_code" => http_response_code1(400)]);
    }

}
if($_SERVER['REQUEST_METHOD'] == "GET" && $_REQUEST['list_form_data']){

    ListDataForm($_REQUEST);
}

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
// $id=20;
// $formname="güncel2 sınav";
// $status=1;
// // $id=$_POST['id'];
// // $formname=$_POST['formname'];
// // $status=$_POST['status'];
// $arr2 =[
//     "id"=>$id,
// "formname"=>$formname,
// "status"=>$status];
// $arr2 = json_encode($arr2);

if($_SERVER['REQUEST_METHOD'] == "PUT" && $_REQUEST['update_form_data']){

    UpdateDataForm($_REQUEST);
}
###VERİ GÜNCELLEME###
function UpdateDataForm($arr){
    global $db;
    global $text;
    
    $id=$arr['id'];
    $formname=$arr['formname'];
    $status=$arr['status'];

    $sql = "UPDATE form
            SET formname = '{$formname}',
             status = '{$status}'
             WHERE id = '{$id}'";

    $sorgu = $db->prepare($sql);
    $sorgu->execute();
    // $last_id = $db->lastInsertId();
    $sorgu = $db->query("SELECT * FROM form WHERE id = $id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
    if($cikti){
        echo json_encode(["message" => 'Başarıyla yeni form verisi güncelledin',"data" => $cikti,"response_code" => http_response_code1(200)]);
    }else{
        echo http_response_code1(400);
    }
    
    // $q = $db->query($sql);

    // if($q){
    //     echo http_response_code1(200);
    // }else{
    //    echo http_response_code1(400);
    // }
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