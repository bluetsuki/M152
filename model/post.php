<?php
require_once 'crud.php';
$btn = filter_input(INPUT_POST, 'sendImg', FILTER_SANITIZE_STRING);
if (isset($btn)) {
    $localPath = '../upload/';
    $imgPostName = $_FILES['imgPost']['name'];
    $imgPostTemp = $_FILES['imgPost']['tmp_name'];
    move_uploaded_file($imgPostTemp, $localPath.$imgPostName);
    addImage("image", $imgPostName, 'upload/'.$imgPostName);
    header('Location: ../?action=home');
    exit;
}
