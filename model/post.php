
<?php
require_once 'crud.php';
$btn = filter_input(INPUT_POST, 'sendImg', FILTER_SANITIZE_STRING);
if (isset($btn)) {
     $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
     $localPath = '../upload/';
     $nbFiles = count($_FILES['imgPost']['name']);

     for($i=0; $i < $nbFiles ;$i++){
          $filename = $_FILES['imgPost']['name'][$i];
          move_uploaded_file($_FILES['imgPost']['tmp_name'][$i], $localPath . $filename);
          addImage("image", $filename, $comment, 'upload/' . $filename);
     }

     header('Location: ../?action=home');
     exit;
}
