<?php
require 'db.php';

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

function ListDataQuestions(){
    global $db;
    $sql = "SELECT * FROM questions";
    $q = $db->query($sql);
    $questions = $q->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($questions);

}

ListDataQuestions();