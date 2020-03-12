<?php
require_once 'model/crud.php';

$idEdit = FILTER_INPUT(INPUT_GET, 'idEdit', FILTER_SANITIZE_NUMBER_INT);
$rmMedia = FILTER_INPUT(INPUT_GET, 'rm', FILTER_SANITIZE_NUMBER_INT);

$comment = FILTER_INPUT(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
$postComment = getPostById($idEdit)[0]['comment'];
$imgPath = '';
$btn = FILTER_INPUT(INPUT_POST, 'modify');
$postMedia = getMedia($idEdit);

var_dump($postMedia);

if(!empty($rmMedia)){
     rmMedia($rmMedia);
     foreach ($postMedia as $value) {
          if($value['idMedia'] == $rmMedia)
          unlink($value['pathImg']);
     }
}

$postMedia = getMedia($idEdit);

if ($btn == 'Envoyer') {
     try {
          startTransaction();
          $nbFiles = count($_FILES['imgPost']['name']);

          if (!empty($_FILES['imgPost']['name'][0])) {
               for ($i = 0; $i < $nbFiles; $i++) {
                    $ext = explode('/', mime_content_type($_FILES['imgPost']['tmp_name'][$i]))[1];
                    $type = explode('/', mime_content_type($_FILES['imgPost']['tmp_name'][$i]))[0];
                    $localPath = 'media/';
                    $localPath .= $type . '/';
                    $tmpName = $_FILES['imgPost']['tmp_name'][$i];
                    $filename = $_FILES['imgPost']['name'][$i];

                    //get the type of the file and if it isn't an image the user is return to the post page
                    if ($type != 'image' && $type != 'video' && $type != 'audio') {
                         rollback();
                         header('Location: #');
                         exit;
                    }

                    $path = str_replace(' ', '', $localPath) .  uniqid() . $filename;
                    if (addMedia($type, $filename, $ext, $path, $idEdit))
                    move_uploaded_file($tmpName, $path);
                    else
                    rollback();
               }
          }
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
     $idMedia = $value['idMedia'];

     $imgPath .= <<<IDPOST
     <div class="editPost float-left">
     <div>
     <div class="imgModif float-right">
     <a href="?action=edit&idEdit=$idEdit&rm=$idMedia">
     <button><img class="defImg" src="media/img/trash-alt-regular.svg"></button>
     </a>
     </div>
     </div>
     IDPOST;

     switch ($value['typeMedia']) {
          case 'image':
          $imgPath .= '<img src="'. $value['pathImg'] .'" class="postImg">';
          break;

          case 'video':
          $imgPath .= '<video width="200" height="112" controls><source src="'. $value['pathImg'] .'" type="video/'. $value['extension'] .'"></video>';
          break;

          case 'audio':
          $imgPath .= '<audio controls><source src="'. $value['pathImg'] .'" type="audio/'. $value['extension'] .'"></audio>';
          break;
     }
     $imgPath .= '</div>';
}
