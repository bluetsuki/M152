<?php
require_once 'crud.php';
$btn = filter_input(INPUT_POST, 'sendImg');
<<<<<<< HEAD

if ($btn == 'Envoyer') {
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $nbFiles = count($_FILES['imgPost']['name']);

    for($i = 0; $i < $nbFiles ;$i++){
        $filename = $_FILES['imgPost']['name'][$i];
        $sizeTotal += $_FILES['imgPost']['size'][$i];

=======

if ($btn == 'Envoyer') {
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $nbFiles = count($_FILES['imgPost']['name']);

    for($i = 0; $i < $nbFiles ;$i++){
        $filename = $_FILES['imgPost']['name'][$i];
        $sizeTotal += $_FILES['imgPost']['size'][$i];

>>>>>>> 50e74f40edf966fccdc36de661f619b69a477c31
        if ($_FILES['imgPost']['size'][$i] > 3000000) {
            header('Location: ?action=post');
            exit;
        }else if ($sizeTotal > 70000000) {
            header('Location: ?action=post');
            exit;
        }else {
            addImage("image", trim($filename . uniqid()), $comment, 'upload/' . $filename);
            move_uploaded_file($_FILES['imgPost']['tmp_name'][$i], 'upload/'. $filename);
        }
        header('Location: ?action=home');
        exit;
    }
}
