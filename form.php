<?php
require 'db.php';

###VERİ EKLEME###
function AddDataForm($formname, $status){
    global $db;
     $sql = "INSERT INTO form
             SET formname = '{$formname}',
             status = '{$status}'";
    
    $q = $db->query($sql);
       
    if($q){
        echo 'Veritabanına formunuz eklenmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }

}
//  AddDataForm('1.sınav',1);


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
ListDataForm();


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


###VERİ PASİFE ALMA###
function DeactivationDataForm($id){
    
    global $db;

    $sql = "UPDATE form SET status = 0 
            WHERE id='{$id}'";

    $q = $db->query($sql);

    if($q){
        echo 'Veritabanında formunuz pasife alınmıştır.';
    }else{
        echo 'Bir hata oluştu.';
    }
}

//  DeactivationDataForm(7);


###PASİF VERİYİ AKTİFLEŞTİRME###

function ActivationDataForm($id){
    
    global $db;

    $sql = "UPDATE form SET status = 1 
            WHERE id='{$id}'";

    $q = $db->query($sql);

    if($q){
        echo 'Veritabanında formunuz aktifleşmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }
}

//  ActivationDataForm(7);
