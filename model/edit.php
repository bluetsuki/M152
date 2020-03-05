<?php
require_once 'model/crud.php';

$idEdit = FILTER_INPUT(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);
$comment = FILTER_INPUT(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
$postComment = getPost($idEdit)[0]['comment'];
$postMedia = getMedia($idEdit);
$imgPath = '';
$btn = FILTER_INPUT(INPUT_POST, 'modify');

if ($btn == 'Envoyer') {
     try {
          startTransaction();
          updComment($idEdit, $comment);
          commit();
          header('Location: ?action=home');
          exit;
     } catch (\Exception $e) {
          rollback();
     }
}

foreach ($postMedia as $key => $value) {
     $path = $value['pathImg'];
     $imgPath = <<<IMGPATH
          <img src="$path" class="ml-3 postImg">
     IMGPATH;
}
