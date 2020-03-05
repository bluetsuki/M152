<?php
require_once 'model/crud.php';
$idRm = FILTER_INPUT(INPUT_GET, 'rm', FILTER_SANITIZE_NUMBER_INT);
$idEdit = FILTER_INPUT(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);

try {
     startTransaction();
     $media = getMedia($idRm);
     rmMedia($idRm);
     rmPost($idRm);
     foreach ($media as $key => $value) {
          unlink($value['pathImg']);
     }
     commit();
} catch (\Exception $e) {
     rollback();
}


function displayPost(){
     $posts = getPost();
     $display = '';
     foreach ($posts as $key => $value) {
          $media = getMedia($value['idPost']);
          $display .= '<div class="card mt-3"><div><div class="imgModif float-right"><a href="?action=edit&edit=';
          $display .= $value['idPost'];
          $display .= '"><button><img class="defImg" src="media/img/keyboard-regular.svg"></button></a><a href="?action=home&rm=';
          $display .= $value['idPost'];
          $display .= '"><button><img class="defImg" src="media/img/trash-alt-regular.svg"></button></a></div></div>';
          foreach ($media as $key => $m) {
               switch ($m['typeMedia']) {
                    case 'image':
                    $display .= '<img src="'. $m['pathImg'] .'" class="card-img-top crdimg rounded mx-auto d-block mt-3" alt="...">';
                    break;

                    case 'video':
                    $display .= '<video class="mx-auto d-block mt-3" width="448" height="336" controls autoplay loop><source src="'. $m['pathImg'] .'" type="video/'. $m['extension'] .'"></video>';
                    break;

                    case 'audio':
                    $display .= '<audio class="mx-auto d-block mt-3" controls><source src="'. $m['pathImg'] .'" type="audio/'. $m['extension'] .'"></audio>';
                    break;
               }
          }
          $display .= '<div class="card-body"><h5>'. $value['comment'] .'</h5></div></div>';
     }
     return $display;
}
