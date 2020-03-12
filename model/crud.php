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

/**
* Insert the comment into post
* @param string comment of the user
* @return int the id of the post
*/
function addPost($comment)
{
     $date = date("Y-m-d H:i:s");
     $connexion = getConnexion();
     $req = $connexion->prepare("INSERT INTO post (comment, dateCreation) VALUES (:comment, :dateCrea)");
     $req->bindParam(":comment", $comment, PDO::PARAM_STR);
     $req->bindParam(":dateCrea", $date, PDO::PARAM_STR);
     $req->execute();
     return $connexion->lastInsertId();
}

/**
* Insert the media into the database
* @param string type of the file
* @param string name of the file
* @param string ext of the file
* @param string pathImg in local
* @param int idPost
* @return bool true if sucessful
*/
function addMedia($type, $name, $ext, $path, $id)
{
     $connexion = getConnexion();
     $date = date("Y-m-d H:i:s");
     $req = $connexion->prepare("INSERT INTO media (typeMedia, extension, nameMedia, dateCreation, pathImg, idPost) VALUES (:type, :ext, :name, :dateCrea, :pathImg, :idPost)");
     $req->bindParam(":type", $type, PDO::PARAM_STR);
     $req->bindParam(":ext", $ext, PDO::PARAM_STR);
     $req->bindParam(":name", $name, PDO::PARAM_STR);
     $req->bindParam(":dateCrea", $date, PDO::PARAM_STR);
     $req->bindParam(":pathImg", $path, PDO::PARAM_STR);
     $req->bindParam(":idPost", $id, PDO::PARAM_INT);
     return $req->execute();
}

/**
* Get the media by the idPost
* @param int idPost
* @return array a table assoc with the typeMedia, extension and pathImg
*/
function getMedia($id){
     $display = getConnexion();
     $req = $display->prepare("SELECT idMedia, typeMedia, extension, pathImg FROM media WHERE idPost = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     return $res;
}

/**
* Get the all post
* @return array a table assoc with the idPost, comment and dateCreation in order DESC
*/
function getPost(){
     $display = getConnexion();
     $req = $display->prepare("SELECT idPost, comment, dateCreation FROM post ORDER BY idPost DESC");
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     return $res;
}

function getPostById($id){
     $display = getConnexion();
     $req = $display->prepare("SELECT idPost, comment, dateCreation FROM post WHERE idPost = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
     return $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Delete a media by it id
* @param int idPost
*/
function rmMedia($id){
     $rm = getConnexion();
     $req = $rm->prepare("DELETE FROM media WHERE idMedia = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
}

/**
* Delete a media by the idPost
* @param int idPost
*/
function rmMediaByPost($id){
     $rm = getConnexion();
     $req = $rm->prepare("DELETE FROM media WHERE idPost = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
}

/**
* Delete a post by it id
* @param int idPost
*/
function rmPost($id){
     $rm = getConnexion();
     $req = $rm->prepare("DELETE FROM post WHERE idPost = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->execute();
}

/**
* Modify a comment
* @param int idPost
* @param string comment modify by the user
*/
function updComment($id, $comment){
     $upd = getConnexion();
     $date = date("Y-m-d H:i:s");
     $req = $upd->prepare("UPDATE post SET comment = :comment, dateModification = :dateModif WHERE idPost = :id");
     $req->bindParam(":id", $id, PDO::PARAM_INT);
     $req->bindParam(":comment", $comment, PDO::PARAM_STR);
     $req->bindParam(":dateModif", $date, PDO::PARAM_STR);
     $req->execute();
}

/**
* Modify a media
* @param int idPost
* @param string comment modify by the user
*/
function updMedia($type, $name, $ext, $path){
     $upd = getConnexion();
     $req = $upd->prepare("UPDATE `media` SET typeMedia = :type, extension = :ext, nameMedia = :name, pathImg = :pathImg");
     $req->bindParam(":type", $type, PDO::PARAM_STR);
     $req->bindParam(":name", $name, PDO::PARAM_STR);
     $req->bindParam(":ext", $ext, PDO::PARAM_STR);
     $req->bindParam(":pathImg", $path, PDO::PARAM_INT);
     $req->execute();
}

//TRANSACTION
function startTransaction(){
    getConnexion()->beginTransaction();
}

function rollback(){
    getConnexion()->rollback();
}

function commit(){
    getConnexion()->commit();
}
