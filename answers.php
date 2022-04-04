<?php
require 'db.php';
require 'httpResponceCode.php';
$question_id=9;
$created_at="2022-04-04";
$updated_at="2022-04-04";
$answertext="hello";
$is_correct=0;
$status=1;
$arr=[
    "question_id"=>$question_id,
    "created_at"=>$created_at,
    "updated_at"=>$updated_at,
    "answertext"=>$answertext,
    "is_correct"=>$is_correct,
    "status"=>$status];
$arr = json_encode($arr);
###VERİ EKLEME###
function AddDataAnswers($arr){
    global $db;
    global $text;
    
    $arr = json_decode($arr,true);
    $question_id=$arr['question_id'];
    $created_at=$arr['created_at'];
    $updated_at=$arr['updated_at'];
    $answertext=$arr['answertext'];
    $is_correct=$arr['is_correct'];
    $status=$arr['status'];
     $sql = "INSERT INTO answers
             SET question_id = '{$question_id}',
             created_at = '{$created_at}',
             updated_at = '{$updated_at}',
             answertext = '{$answertext}',
             is_correct = '{$is_correct}',
             status = '{$status}'";
    
    $q = $db->query($sql);
       
    if($q){
        echo http_response_code1(200);
    }else{
        echo http_response_code1(400);
    }

}
//   AddDataAnswers($arr);


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
// ListDataAnswers();


###VERİ GÜNCELLEME###
$id=8;
$question_id=9;
$created_at="2022-04-04";
$updated_at="2022-04-04";
$answertext="hello güncel";
$is_correct=0;
$status=1;
$arr2=[
    "id"=>$id,
    "question_id"=>$question_id,
    "created_at"=>$created_at,
    "updated_at"=>$updated_at,
    "answertext"=>$answertext,
    "is_correct"=>$is_correct,
    "status"=>$status];
$arr2 = json_encode($arr2);

function UpdateDataAnswers($arr2){
    global $db;
    global $text;
    
    $arr2 = json_decode($arr2,true);
    $id=$arr2['id'];
    $question_id=$arr2['question_id'];
    $created_at=$arr2['created_at'];
    $updated_at=$arr2['updated_at'];
    $answertext=$arr2['answertext'];
    $is_correct=$arr2['is_correct'];
    $status=$arr2['status'];

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
      echo  http_response_code1(200);
    }else{
       echo http_response_code1(400);
    }
}

// UpdateDataAnswers($arr2);


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

// activeOrPassiveAnswers(6);