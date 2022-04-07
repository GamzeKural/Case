<?php
require 'db.php';
require 'httpResponceCode.php';


if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['add_form_questions']){

    AddDataQuestions($_REQUEST);
}

###VERİ EKLEME###
function AddDataQuestions($arr){
    global $db;
    global $text;
    
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

    $sorgu = $db->prepare($sql);
    $sorgu->execute();

    $last_id = $db->lastInsertId();

    $sorgu = $db->query("SELECT * FROM questions WHERE id = $last_id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
    if($cikti){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully added new question',"data" => $cikti,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to add question',"response_code" => 400]);
    }


}


if(isset($_GET['list_question_datas'])){

    ListDataQuestions($_GET['list_question_datas']);
}

###VERİ LİSTELEME###
function ListDataQuestions(){
    global $db;
    $sql = "SELECT * FROM questions";
    $q = $db->query($sql);
    $questions = $q->fetchAll(PDO::FETCH_ASSOC);
    $data_count = count($questions);

    if($questions){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully listed questions',"data" => $questions,"data_count" => $data_count,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to list data',"response_code" => 400]);
    }

}
// ListDataQuestions();

// $id=11;
// $sequence=5;
// $question_type=2;
// $question_explanation="Doğru şıkkı işaretle";
// $question_content="Php nedir güncel";
// $created_at="2022-04-04";
// $updated_at="2022-04-04";
// $form_id=7;
// $time=60;
// $score=5;
// $status=1;

// $id=$_POST['id'];
// $sequence=$_POST['sequence'];
// $question_type=$_POST['question_type'];
// $question_explanation=$_POST['question_explanation'];
// $question_content=$_POST['question_content'];
// $created_at=$_POST['created_at'];
// $updated_at=$_POST['updated_at'];
// $form_id=$_POST['form_id'];
// $time=$_POST['time'];
// $score=$_POST['score'];
// $status=$_POST['status'];
// $arr2=[
//     "id"=>$id,
//     "sequence"=>$sequence,
//     "question_type"=>$question_type,
//     "question_explanation"=>$question_explanation,
//     "question_content"=>$question_content,
//     "created_at"=>$created_at,
//     "updated_at"=>$updated_at,
//     "form_id"=>$form_id,
//     "time"=>$time,
//     "score"=>$score,
//     "status"=>$status];
// $arr2 = json_encode($arr2);

if($_SERVER['REQUEST_METHOD'] == "PUT" && $_REQUEST['update_form_questions']){

    UpdateDataQuestions($_REQUEST);
}

###VERİ GÜNCELLEME###
function UpdateDataQuestions($arr){
    global $db;
    global $text;
    
    $id=$arr['id'];
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
    
    $sorgu = $db->prepare($sql);
    $sorgu->execute();
    // $last_id = $db->lastInsertId();
    $sorgu = $db->query("SELECT * FROM questions WHERE id = $id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
    if($cikti){
        echo json_encode(["message" => 'Başarıyla yeni question verisi güncelledin',"data" => $cikti,"response_code" => http_response_code1(200)]);
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

// activeOrPassiveQuestions(9);