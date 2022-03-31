<?php
require 'db.php';

###VERİ EKLEME###
function AddDataQuestions($sequence, $question_type, $question_explanation, $question_content, $created_at, $updated_at, $form_id, $time, $score, $status){
    //echo $sequence.$question_type.$question_explanation.$question_content.$created_at.$updated_at.$form_id.$time.$score.$status;
    global $db;
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
        echo 'Veritabanına sorunuz eklenmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }


}
//  AddDataQuestions(1,1,'testexplanation','testcontent','2022-03-30','2022-03-30',6,150,5,1);


###VERİ LİSTELEME###
function ListDataQuestions(){
    global $db;
    $sql = "SELECT * FROM questions";
    $q = $db->query($sql);
    $questions = $q->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    $json_veri=json_encode($questions);
    print_r($json_veri);

}
ListDataQuestions();



###VERİ GÜNCELLEME###
function UpdateDataQuestions($id, $sequence, $question_type, $question_explanation, $question_content, $created_at, $updated_at, $form_id, $time, $score, $status){
    global $db;

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
        echo 'Veritabanında sorunuz güncellenmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }
}

// UpdateDataQuestions(10,1,1,'testexplanationgüncel','testcontentgüncel','2022-03-30','2022-04-30',7,130,5,1);


###VERİ PASİFE ALMA###
function DeactivationDataQuestions($id){
    
    global $db;

    $sql = "UPDATE questions SET status = 0 
            WHERE id='{$id}'";

    $q = $db->query($sql);

    if($q){
        echo 'Veritabanında sorunuz pasife alınmıştır.';
    }else{
        echo 'Bir hata oluştu.';
    }
}

// DeactivationDataQuestions(9);


###PASİF VERİYİ AKTİFLEŞTİRME###

function ActivationDataQuestions($id){
    
    global $db;

    $sql = "UPDATE questions SET status = 1 
            WHERE id='{$id}'";

    $q = $db->query($sql);

    if($q){
        echo 'Veritabanında sorunuz aktifleşmiştir.';
    }else{
        echo 'Bir hata oluştu.';
    }
}

// ActivationDataQuestions(9);