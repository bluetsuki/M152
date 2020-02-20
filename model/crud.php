<?php
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'm152');
DEFINE('DB_USER', 'root');
DEFINE('DB_PASS', 'Super');

function getConnexion()
{
     static $db = null;

     if ($db === null) {
          try {
               $connexionString = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '';
               $db = new PDO($connexionString, DB_USER, DB_PASS);
               $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch (PDOException $e) {
               die('Erreur : ' . $e->getMessage());
          }
     }
     return $db;
}

//INSERT
function addPost($comment)
{
     $date = date("Y-m-d H:i:s");
     $connexion = getConnexion();
     $req = $connexion->prepare("INSERT INTO post (commentaire, dateCreation) VALUES (:comment, :dateCrea)");
     $req->bindParam(":comment", $comment, PDO::PARAM_STR);
     $req->bindParam(":dateCrea", $date, PDO::PARAM_STR);
     $req->execute();
     return $connexion->lastInsertId();
}

function addImage($type, $name, $path, $id)
{
     $connexion = getConnexion();
     $date = date("Y-m-d H:i:s");
     $req = $connexion->prepare("INSERT INTO media (typeMedia, nameMedia, dateCreation, pathImg, idPost) VALUES (:type, :name, :dateCrea, :pathImg, :idPost)");
     $req->bindParam(":type", $type, PDO::PARAM_STR);
     $req->bindParam(":name", $name, PDO::PARAM_STR);
     $req->bindParam(":dateCrea", $date, PDO::PARAM_STR);
     $req->bindParam(":pathImg", $path, PDO::PARAM_STR);
     $req->bindParam(":idPost", $id, PDO::PARAM_INT);
     $req->execute();
}

//READ
function displayImg(){
     $display = getConnexion();
     $req = $display->prepare("SELECT pathImg FROM media ORDER BY dateCreation DESC");
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     foreach ($res as $key => $value) {
          echo '<div class="card mt-3"><form><div class="imgModif float-right"><button><img class="defImg" src="media/img/keyboard-regular.svg"></button><button><img class="defImg" src="media/img/trash-alt-regular.svg"></button></div></form><img src="'. $value['pathImg'] .'" class="card-img-top crdimg rounded mx-auto d-block mt-3" alt="..."><div class="card-body"><h5></h5></div></div>';
     }
}

//DELETE
function deleteGroup($nameGroup){
     $del = getConnexion();
     $req = $del->prepare("DELETE FROM groups WHERE nameGroup = :nameGroup");
     $req->bindParam(":nameGroup", $nameGroup, PDO::PARAM_STR);
     $req->execute();
}

//UPDATE
function editGroup($nameGroup, $debutDate, $agence, $id){
     $edit = getConnexion();
     $req = $edit->prepare("UPDATE groups SET nameGroup = :nameGroup, debutDate = :debutDate, idAgence = :agence WHERE idGroup = :id");
     $req->bindParam(":nameGroup", $nameGroup, PDO::PARAM_STR);
     $req->bindParam(":debutDate", $debutDate, PDO::PARAM_STR);
     $req->bindParam(":agence", $agence, PDO::PARAM_INT);
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
}
