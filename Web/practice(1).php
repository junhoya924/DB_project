<?php

$id = $_GET['id'];
$password = $_GET['password'];
$type = $_GET['type'];

echo "success";
echo "<br>";

json_encode($id);
json_encode($password);
json_encode($type);

?>

