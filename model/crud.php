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
function getMedia($id){
     $display = getConnexion();
     $req = $display->prepare("SELECT typeMedia, pathImg FROM media WHERE idPost = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     return $res;
}

function getPost(){
     $display = getConnexion();
     $req = $display->prepare("SELECT idPost, commentaire, dateCreation FROM post ORDER BY dateCreation DESC");
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     return $res;
}
