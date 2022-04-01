<?php
require 'db.php';

###VERİ EKLEME###
function AddDataAnswers($question_id, $created_at, $updated_at, $answertext, $is_correct, $status){
    global $db;
     $sql = "INSERT INTO answers
             SET question_id = '{$question_id}',
             created_at = '{$created_at}',
             updated_at = '{$updated_at}',
             answertext = '{$answertext}',
             is_correct = '{$is_correct}',
             status = '{$status}'";
    
    $q = $db->query($sql);
       
    if($q){
        echo 'Veritabanına cevabınız eklenmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }

}
//   AddDataAnswers(10,'2022-03-31','2022-03-31','selamnaber',1,0);


###VERİ LİSTELEME###
function ListDataAnswers(){
    global $db;
    $sql = "SELECT * FROM answers";
    $q = $db->query($sql);
    $answers = $q->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    $json_veri=json_encode($answers);
    print_r($json_veri);

}
ListDataAnswers();


###VERİ GÜNCELLEME###
function UpdateDataAnswers($id,$question_id, $created_at, $updated_at, $answertext, $is_correct, $status){
    global $db;

    $sql = "UPDATE answers
            SET question_id = '{$question_id}',
            created_at = '{$created_at}',
            updated_at = '{$updated_at}',
            answertext = '{$answertext}',
            is_correct = '{$is_correct}',
            status = '{$status}'
            WHERE id = '{$id}'";
    
    $q = $db->query($sql);

    if($q){
        echo 'Veritabanında cevabınız güncellenmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }
}

// UpdateDataAnswers(5,10,'2022-03-30','2022-03-30','testanswer2',1,1);


// ###VERİ PASİFE ALMA###
// function DeactivationDataAnswers($id){
    
//     global $db;

//     $sql = "UPDATE answers SET status = 0 
//             WHERE id='{$id}'";

//     $q = $db->query($sql);

//     if($q){
//         echo 'Veritabanında cevabınız pasife alınmıştır.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }
// }

// // DeactivationDataAnswers(7);


// ###PASİF VERİYİ AKTİFLEŞTİRME###

// function ActivationDataAnswers($id){
    
//     global $db;

//     $sql = "UPDATE answers SET status = 1 
//             WHERE id='{$id}'";

//     $q = $db->query($sql);

//     if($q){
//         echo 'Veritabanında cevabınız aktifleşmiştir.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }
// }

// // ActivationDataAnswers(7);

function activeOrPassiveAnswers($id){

    global $db;

    $sql = "SELECT * FROM answers WHERE id ='{$id}'";
    $q = $db->query($sql);
    $answers= $q ->fetch(PDO::FETCH_ASSOC);
    //$forms = $q->fetchAll(PDO::FETCH_ASSOC);

    if($answers['status']==1){
    
        $update_sql = "UPDATE answers SET status = 0 
                WHERE id='{$id}'";
    }else{
        
        $update_sql = "UPDATE answers SET status = 1 
                WHERE id='{$id}'";

    }
    $q = $db->query($update_sql);

    //print_r($forms);

}

activeOrPassiveAnswers(6);