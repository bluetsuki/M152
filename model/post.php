
<?php
require_once 'crud.php';
$btn = filter_input(INPUT_POST, 'sendImg');

if ($btn == 'Envoyer') {
     $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
     $nbFiles = count($_FILES['imgPost']['name']);
     echo $nbFiles;

     for($i = 0; $i < $nbFiles ;$i++){
          $filename = $_FILES['imgPost']['name'][$i];
          move_uploaded_file($_FILES['imgPost']['tmp_name'][$i], 'upload/'. $filename);
          addImage("image", $filename, $comment, 'upload/' . $filename);
     }
     header('Location: ?action=home');
     exit;
}
