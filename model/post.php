<?php
require_once 'crud.php';
$btn = filter_input(INPUT_POST, 'sendImg');

if ($btn == 'Envoyer') {
     $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
     $nbFiles = count($_FILES['imgPost']['name']);
     $date = date("Y-m-d H:i:s");
     $localPath = 'media/imgUpload/';
     addPost($comment, $date);
     $id = lastId($comment, $date);
     var_dump($id);

     for($i = 0; $i < $nbFiles ;$i++){
          $filename = $_FILES['imgPost']['name'][$i];

          if ($_FILES['imgPost']['size'][$i] > 3000000) {
               header('Location: ?action=post');
               exit;
          }else {
               move_uploaded_file($_FILES['imgPost']['tmp_name'][$i], $localPath. $filename . uniqid());
               addImage("image", trim($filename . uniqid()), $localPath . $filename, $id);
          }
     }
     header('Location: ?action=home');
     exit;
}
