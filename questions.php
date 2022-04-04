<?php
require 'db.php';
require 'httpResponceCode.php';
$sequence=6;
$question_type=2;
$question_explanation="Doğru şıkkı işaretle";
$question_content="Php nedir";
$created_at="2022-04-04";
$updated_at="2022-04-04";
$form_id=7;
$time=60;
$score=5;
$status=1;
$arr=[
    "sequence"=>$sequence,
    "question_type"=>$question_type,
    "question_explanation"=>$question_explanation,
    "question_content"=>$question_content,
    "created_at"=>$created_at,
    "updated_at"=>$updated_at,
    "form_id"=>$form_id,
    "time"=>$time,
    "score"=>$score,
    "status"=>$status];
$arr = json_encode($arr);

###VERİ EKLEME###
function AddDataQuestions($arr){
    //echo $sequence.$question_type.$question_explanation.$question_content.$created_at.$updated_at.$form_id.$time.$score.$status;
    global $db;
    global $text;
    
    $arr = json_decode($arr,true);
    $sequence=$arr['sequence'];
    $question_type=$arr['question_type'];
    $question_explanation=$arr['question_explanation'];
    $question_content=$arr['question_content'];
    $created_at=$arr['created_at'];
    $updated_at=$arr['updated_at'];
    $form_id=$arr['form_id'];
    $time=$arr['time'];
    $score=$arr['score'];
    $status=$arr['status'];

     $sql = "INSERT INTO questions
             SET sequence = '{$sequence}',
             question_type = '{$question_type}',
             question_explanation = '{$question_explanation}',
             question_content = '{$question_content}',
             created_at = '{$created_at}',
             updated_at = '{$updated_at}',
             form_id = '{$form_id}',
             time = '{$time}',
             score = '{$score}',
             status = '{$status}'";
    
    $q = $db->query($sql);
       
    if($q){
       echo http_response_code1(200);
    }else{
       echo http_response_code1(400);
    }


}
//  AddDataQuestions($arr);


###VERİ LİSTELEME###
function ListDataQuestions(){
    global $db;
    $sql = "SELECT * FROM questions";
    $q = $db->query($sql);
    $questions = $q->fetchAll(PDO::FETCH_ASSOC);
    // $payLoad=[];
    // $payLoad['questions']=$questions;
    // $payLoad['totaltimer']=$totaltimer;
    // echo "<pre>";
    $json_veri=json_encode($questions);
    print_r($json_veri);

}
// ListDataQuestions();

$id=11;
$sequence=5;
$question_type=2;
$question_explanation="Doğru şıkkı işaretle";
$question_content="Php nedir güncel";
$created_at="2022-04-04";
$updated_at="2022-04-04";
$form_id=7;
$time=60;
$score=5;
$status=1;
$arr2=[
    "id"=>$id,
    "sequence"=>$sequence,
    "question_type"=>$question_type,
    "question_explanation"=>$question_explanation,
    "question_content"=>$question_content,
    "created_at"=>$created_at,
    "updated_at"=>$updated_at,
    "form_id"=>$form_id,
    "time"=>$time,
    "score"=>$score,
    "status"=>$status];
$arr2 = json_encode($arr2);


###VERİ GÜNCELLEME###
function UpdateDataQuestions($arr2){
    global $db;
    global $text;
    
    $arr2 = json_decode($arr2,true);
    $id=$arr2['id'];
    $sequence=$arr2['sequence'];
    $question_type=$arr2['question_type'];
    $question_explanation=$arr2['question_explanation'];
    $question_content=$arr2['question_content'];
    $created_at=$arr2['created_at'];
    $updated_at=$arr2['updated_at'];
    $form_id=$arr2['form_id'];
    $time=$arr2['time'];
    $score=$arr2['score'];
    $status=$arr2['status'];

    $sql = "UPDATE questions
            SET sequence = '{$sequence}',
             question_type = '{$question_type}',
             question_explanation = '{$question_explanation}',
             question_content = '{$question_content}',
             created_at = '{$created_at}',
             updated_at = '{$updated_at}',
             form_id = '{$form_id}',
             time = '{$time}',
             score = '{$score}',
             status = '{$status}'
             WHERE id = '{$id}'";
    
    $q = $db->query($sql);

    if($q){
       echo http_response_code1(200);
    }else{
       echo http_response_code1(400);
    }
}

// UpdateDataQuestions($arr2);


// ###VERİ PASİFE ALMA###
// function DeactivationDataQuestions($id){
    
//     global $db;

//     $sql = "UPDATE questions SET status = 0 
//             WHERE id='{$id}'";

//     $q = $db->query($sql);

//     if($q){
//         echo 'Veritabanında sorunuz pasife alınmıştır.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }
// }

// // DeactivationDataQuestions(9);


// ###PASİF VERİYİ AKTİFLEŞTİRME###

// function ActivationDataQuestions($id){
    
//     global $db;

//     $sql = "UPDATE questions SET status = 1 
//             WHERE id='{$id}'";

//     $q = $db->query($sql);

//     if($q){
//         echo 'Veritabanında sorunuz aktifleşmiştir.';
//     }else{
//         echo 'Bir hata oluştu.';
//     }
// }

// // ActivationDataQuestions(9);

function activeOrPassiveQuestions($id){

    global $db;

    $sql = "SELECT * FROM questions WHERE id ='{$id}'";
    $q = $db->query($sql);
    $questions = $q ->fetch(PDO::FETCH_ASSOC);
    //$forms = $q->fetchAll(PDO::FETCH_ASSOC);

    if($questions['status']==1){
    
        $update_sql = "UPDATE questions SET status = 0 
                WHERE id='{$id}'";
    }else{
        
        $update_sql = "UPDATE questions SET status = 1 
                WHERE id='{$id}'";

    }
    $q = $db->query($update_sql);

    //print_r($forms);

}

activeOrPassiveQuestions(9);