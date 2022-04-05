<?php
require 'db.php';
require 'httpResponceCode.php';


// $user_id=$_POST['user_id'];
// $question_id=$_POST['question_id'];
// $responseAnswer_id=$_POST['responseAnswer_id'];

// $user_id=15;
// $question_id=11;
// $responseAnswer_id=10;

// $arr=[
//     "user_id"=>$user_id,
//     "question_id"=>$question_id,
//     "responseAnswer_id"=>$responseAnswer_id
// ];

// $arr = json_encode($arr);

##GELEN VERİLERİ TABLOYA EKLEME
if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['add_form_useranswer']){

    AddDataUseranswer($_REQUEST);
}
function AddDataUseranswer($arr){
    global $db;
    global $text;

    $user_id=$arr['user_id'];
    $question_id=$arr['question_id']; //dizi şeklinde gelecek.
    $responseAnswer_id=$arr['responseAnswer_id']; //dizi şeklinde gelecek.

    $sql = "INSERT INTO userAnswers
             SET user_id = '{$user_id}',
             question_id = '{$question_id}',
             responseAnswer_id = '{$responseAnswer_id}'";

   $sorgu = $db->prepare($sql);
    $sorgu->execute();

    $last_id = $db->lastInsertId();
    
    $sorgu = $db->query("SELECT * FROM userAnswers WHERE id = $last_id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

    if($cikti){
        echo json_encode(["message" => 'Başarıyla yeni useranswer verisi ekledin',"data" => $cikti,"response_code" => http_response_code1(200)]);
    }else{
        echo http_response_code1(400);
    }

}

// AddDataUseranswer($arr);
if($_SERVER['REQUEST_METHOD'] == "GET" && $_REQUEST['list_form_useranswer']){

    ListDataUseranswer($_REQUEST);
}
###VERİ LİSTELEME###
function ListDataUseranswer($user_id){
    global $db;
    $sql = "SELECT * FROM userAnswers
            WHERE user_id = '{$user_id}'";
    $q = $db->query($sql);
    $useranswers = $q->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    $json_veri=json_encode($useranswers);
    print_r($json_veri);

}
// ListDataUseranswer(15);

// $arr=[
//     "userid"=>$user_id,
//     "answersid"=>$id,
//     "questionid"=>$question_id
//   ];

// function TotalScore(){
//     global $db;
//     $sql = "SELECT * FROM userAnswers
//             WHERE user_id = '{$user_id}'";

//     $q = $db->query($sql);
//     $useranswers = $q->fetchAll(PDO::FETCH_ASSOC);

//     // $sql2 = "SELECT is_correct FROM answers
//     // WHERE id = '{$id}'";

//     // $q = $db->query($sql2);
//     // $answercorrect = $q->fetchAll(PDO::FETCH_ASSOC);

//     // $sql3 = "SELECT score FROM questions
//     // WHERE id = '{$question_id}'";

//     // $q = $db->query($sql3);
//     // $questionscore = $q->fetchAll(PDO::FETCH_ASSOC);


//     // $scorecount=0;
//     // foreach($useranswers as $useranswer){
        
//     // }
        
// }

#SELECT * , (SELECT is_correct FROM answers WHERE answers.id = userAnswers.responseAnswer_id) as is_correct FROM form INNER JOIN questions ON questions.form_id = form.id LEFT JOIN userAnswers ON questions.id = userAnswers.question_id WHERE form.id = 7;


#SELECT * , (SELECT is_correct FROM answers WHERE answers.id = userAnswers.responseAnswer_id) as is_correct FROM form INNER JOIN questions ON questions.form_id = form.id LEFT JOIN userAnswers ON questions.id = userAnswers.question_id LEFT JOIN users ON userAnswers.user_id=users.id WHERE form.id=7 AND users.id=15;

echo "<pre>";
$sql="SELECT * , (SELECT is_correct FROM answers WHERE answers.id = userAnswers.responseAnswer_id) as is_correct FROM form INNER JOIN questions ON questions.form_id = form.id LEFT JOIN userAnswers ON questions.id = userAnswers.question_id LEFT JOIN users ON userAnswers.user_id=users.id WHERE form.id=7 AND users.id=15;";

$q = $db->query($sql);

$ua = $q->fetchAll(PDO::FETCH_ASSOC);
print_r($ua);

// $countscore=0;
// foreach($ua as $u){
// if($ua['is_correct']==1){
//     $countscore=$countscore+$ua['score'];
// }
// }
// echo $countscore;

