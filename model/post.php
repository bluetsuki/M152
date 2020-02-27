<?php
require_once 'model/crud.php';
$btn = filter_input(INPUT_POST, 'sendImg');

if ($btn == 'Envoyer') {
     $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
     $nbFiles = count($_FILES['imgPost']['name']);
     $localPath = 'media/';
     $sizeTotal = 0;

     foreach ($_FILES['imgPost']['size'] as $key => $value) {
          $sizeTotal += $value;
     }

     if ($sizeTotal > 70000000) {
          header('Location: ?action=post');
          exit;
     }
     try {
          startTransaction();

          $id = addPost($comment);
          if ($id > 0) {
               if ($sizeTotal > 0) {
                    for($i = 0; $i < $nbFiles ;$i++){
                         $localPath = 'media/';

                         $type = explode('/', mime_content_type($_FILES['imgPost']['tmp_name'][$i]))[0];
                         $ext = explode('/', mime_content_type($_FILES['imgPost']['tmp_name'][$i]))[1];
                         $localPath .= $type . '/';
                         $tmpName = $_FILES['imgPost']['tmp_name'][$i];
                         $filename = $_FILES['imgPost']['name'][$i];

                         //get the type of the file and if it isn't an image the user is return to the post page
                         if ($type != 'image' && $type != 'video' && $type != 'audio') {
                              rollback();
                              header('Location: ?action=post');
                              exit;
                         }

                         if ($_FILES['imgPost']['size'][$i] > 3000000) {
                              rollback();
                              header('Location: ?action=post');
                              exit;
                         }
                         else {
                              $path = str_replace(' ', '', $localPath) .  uniqid() . $filename;
                              if (addMedia($type, $filename, $ext, $path, $id))
                                   move_uploaded_file($tmpName, $path);
                              else
                                   rollback();
                         }
                    }
               }
          }else
          rollback();

          commit();
          header('Location: ?action=home');
          exit;
     } catch (\Exception $e) {
          rollback();
          header('Location: ?action=post');
          exit;
     }
}
