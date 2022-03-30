<?php
require 'db.php';

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

function ListDataForm(){
    global $db;
    $sql = "SELECT * FROM form";
    $q = $db->query($sql);
    $forms = $q->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($forms);

}

ListDataForm();
