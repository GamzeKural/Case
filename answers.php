<?php
require 'db.php';

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

//  AddDataAnswers(9,'2022-03-30','2022-03-30','testanswer',1,1);

function ListDataAnswers(){
    global $db;
    $sql = "SELECT * FROM answers";
    $q = $db->query($sql);
    $answers = $q->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($answers);

}

ListDataAnswers();

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

UpdateDataAnswers(5,10,'2022-03-30','2022-03-30','testanswer2',1,1);