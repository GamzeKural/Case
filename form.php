<?php
require 'db.php';
require 'httpResponceCode.php';

// $arr=['$formname','$status'];

// class Form{
//     public $formname;
//     public $status;
// }

###VERİ EKLEME###
function AddDataForm($formname, $status){
    global $db;
    global $text;
     $sql = "INSERT INTO form
             SET formname = '{$formname}',
             status = '{$status}'";
    
    $q = $db->query($sql);
       
    if($q){
        http_response_code(201);
    }else{
        http_response_code(400);
    }

}
  AddDataForm('abc sınav',1);


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


###VERİ GÜNCELLEME###
function UpdateDataForm($id, $formname, $status){
    global $db;

    $sql = "UPDATE form
            SET formname = '{$formname}',
             status = '{$status}'
             WHERE id = '{$id}'";
    
    $q = $db->query($sql);

    if($q){
        echo 'Veritabanında formunuz güncellenmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }
}
// UpdateDataForm(6,'güncel sınav',1);


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

activeOrPassiveForm(6);