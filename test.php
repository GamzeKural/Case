<?php
require 'db.php';

echo "<pre>";

$sql = "SELECT * FROM `test`";

$q = $db -> query($sql);

$test = $q -> fetchAll(PDO::FETCH_ASSOC);

print_r($test);