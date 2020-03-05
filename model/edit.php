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

     $imgPath .= <<<IDPOST
     <div><div><div class="imgModif float-right"><a href="?action=edit&edit=$idEdit"><button><img class="defImg" src="media/img/keyboard-regular.svg"></button></a><a href="?action=home&rm=$idEdit"><button><img class="defImg" src="media/img/trash-alt-regular.svg"></button></a></div></div>
     IDPOST;

     switch ($value['typeMedia']) {
          case 'image':
          $imgPath .= '<img src="'. $value['pathImg'] .'" class="mx-auto d-block mt-3 postImg" alt="...">';
          break;

          case 'video':
          $imgPath .= '<video class="mx-auto d-block mt-3" width="448" height="336" controls autoplay loop><source src="'. $value['pathImg'] .'" type="video/'. $value['extension'] .'"></video>';
          break;

          case 'audio':
          $imgPath .= '<audio class="mx-auto d-block mt-3" controls><source src="'. $value['pathImg'] .'" type="audio/'. $value['extension'] .'"></audio>';
          break;
     }
     $imgPath .= '</div>';

}
