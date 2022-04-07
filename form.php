<?php
require 'db.php';
require 'httpResponceCode.php';

if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['add_form_data']){

    AddDataForm($_REQUEST);
}

###VERİ EKLEME###

function AddDataForm($arr){
    global $db;
    global $text;
    $formname=$arr['formname'];
    $status=$arr['status'];
    

    $sorgu = $db->prepare("INSERT INTO form( formname , status ) VALUES('$formname',$status)");
    $sorgu->execute();

    $last_id = $db->lastInsertId();
    
    $sorgu = $db->query("SELECT * FROM form WHERE id = $last_id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
    if($cikti){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully added new form',"data" => $cikti,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to add data',"response_code" => 400]);
    }

}

if(isset($_GET['list_form_datas'])){

    ListDataForms($_GET['list_form_datas']);
}

###VERİ LİSTELEME###
function ListDataForms(){
    global $db;


    $sql = "SELECT * FROM form";
    $q = $db->query($sql);
    $forms = $q->fetchAll(PDO::FETCH_ASSOC);

    $data_count = count($forms);

    if($forms){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully listed forms',"data" => $forms,"data_count" => $data_count,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to list data',"response_code" => 400]);
    }

}



if(isset($_GET['list_form_data'])){

    ListDataForm($_GET['id']);
}

###VERİ LİSTELEME###
function ListDataForm($id){
    global $db;


    $sql = "SELECT * FROM form WHERE id={$id}";
    $q = $db->query($sql);
    $forms = $q->fetch(PDO::FETCH_ASSOC);


    if($forms){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully listed form',"data" => $forms,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to list form',"response_code" => 400]);
    }

}


if($_SERVER['REQUEST_METHOD'] == "PUT" && isset($_REQUEST['update_form_data'])){

    UpdateDataForm($_REQUEST);
}


###VERİ GÜNCELLEME###
function UpdateDataForm($arr){
    global $db;
    global $text;
    
    $id=$arr['id'];
    $formname=$arr['formname'];
    $status=$arr['status'];

    $sql = "UPDATE form
            SET formname = '{$formname}',
             status = '{$status}'
             WHERE id = '{$id}'";

    $sorgu = $db->prepare($sql);
    $sorgu->execute();
    $sorgu = $db->query("SELECT * FROM form WHERE id = $id");

    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
    if($cikti){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully updated form',"data" => $cikti,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to update data',"response_code" => 400]);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

    DeleteDataForm($_GET['id']);
}
###VERİ SİLME###
function DeleteDataForm($id){
    global $db;
    global $text;

    $sql = "DELETE FROM form WHERE id={$id}";

    $query = $db->query($sql);

    $count=$query->rowCount();

    if($query){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully delete form',"effected_count" => $count,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to delete data',"response_code" => 400]);
    }

}

if($_SERVER['REQUEST_METHOD'] == "PUT" && isset($_REQUEST['activeOrPassive_form_data'])){

    activeOrPassiveForm($_REQUEST['id']);
}

function activeOrPassiveForm($id){

    global $db;
    global $text;

    $sql = "SELECT * FROM form WHERE id ='{$id}'";
    $q = $db->query($sql);
    $forms= $q ->fetch(PDO::FETCH_ASSOC);

    if($forms['status']==1){
    
        $update_sql = "UPDATE form SET status = 0 
                WHERE id='{$id}'";
    }else{
        
        $update_sql = "UPDATE form SET status = 1 
                WHERE id='{$id}'";

    }
    $q2 = $db->query($update_sql);
    $forms2= $q2 ->fetch(PDO::FETCH_ASSOC);

    $sorgu = $db->query("SELECT * FROM form WHERE id = $id");
    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

    if($cikti){
        echo json_encode(["status" => http_response_code1(200),"message" => 'You have successfully actived or passived form',"data" => $cikti,"response_code" => 200]);
    }else{
        echo json_encode(["status" => http_response_code1(400),"message" => 'Failed to actived or passived data',"response_code" => 400]);
    }

}
