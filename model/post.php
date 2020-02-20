<?php
require_once 'model/crud.php';
$btn = filter_input(INPUT_POST, 'sendImg');
// var_dump(count($_FILES['imgPost']['name']));
if ($btn == 'Envoyer') {
     $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
     $nbFiles = count($_FILES['imgPost']['name']);
     $localPath = 'media/imgUpload/';
     $sizeTotal = 0;

     foreach ($_FILES['imgPost']['size'] as $key => $value) {
          $sizeTotal += $value;
     }

     if ($sizeTotal > 70000000) {
          header('Location: ?action=post');
          exit;
     }


     $id = addPost($comment);

     for($i = 0; $i < $nbFiles ;$i++){
          $type = explode(mime_content_type($_FILES['imgPost']['tmp_name'][$i]), '/')[0];
          $filename = $_FILES['imgPost']['name'][$i];

          //get the type of the file and if it isn't an image the user is return to the post page
          if ($type != 'image') {
               header('Location: ?action=post');
               exit;
          }

          if ($_FILES['imgPost']['size'][$i] > 3000000) {
               header('Location: ?action=post');
               exit;
          }
          else {
               move_uploaded_file($_FILES['imgPost']['tmp_name'][$i], $localPath. $filename . uniqid());
               addImage($type, trim($filename . uniqid()), $localPath . $filename, $id);
          }
     }
     header('Location: ?action=home');
     exit;
}
