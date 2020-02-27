<?php
function displayPost(){
     $posts = getPost();
     $display = '';
     foreach ($posts as $key => $value) {
          $media = getMedia($value['idPost']);
          $display .= '<div class="card mt-3"><form><div class="imgModif float-right"><button><img class="defImg" src="media/img/keyboard-regular.svg"></button><button><img class="defImg" src="media/img/trash-alt-regular.svg"></button></div></form>';
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
          $display .= '<div class="card-body"><h5>'. $value['commentaire'] .'</h5></div></div>';
     }
     return $display;
}
