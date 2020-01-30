<?php
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'M152');
DEFINE('DB_USER', 'root');
DEFINE('DB_PASS', '');

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
function addImage($type, $name, $desc, $path)
{
     $connexion = getConnexion();
     $date = date("Y-m-d H:i:s");
     $req = $connexion->prepare("INSERT INTO media (typeMedia, nameMedia, description, dateCreation, pathImg) VALUES (:type, :name, :description, :dateCrea, :pathImg)");
     $req->bindParam(":type", $type, PDO::PARAM_STR);
     $req->bindParam(":name", $name, PDO::PARAM_STR);
     $req->bindParam(":description", $desc, PDO::PARAM_STR);
     $req->bindParam(":dateCrea", $date, PDO::PARAM_STR);
     $req->bindParam(":pathImg", $path, PDO::PARAM_STR);
     $req->execute();
}

function addPost($comment)
{
     $connexion = getConnexion();
     $date = date("Y-m-d H:i:s");
     $req = $connexion->prepare("INSERT INTO media (commentaire, dateCreation, idMedia) VALUES (:type, :name, :dateCrea, :pathImg)");
     $req->bindParam(":type", $type, PDO::PARAM_STR);
     $req->bindParam(":name", $name, PDO::PARAM_STR);
     $req->bindParam(":dateCrea", $date, PDO::PARAM_STR);
     $req->bindParam(":pathImg", $path, PDO::PARAM_STR);
     $req->execute();
}

//READ
function displayImg(){
     $display = getConnexion();
     $req = $display->prepare("SELECT description, pathImg FROM media");
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     foreach ($res as $key => $value) {
          echo '<div class="card mt-3"><img src="'. $value['pathImg'] .'" class="card-img-top crdimg rounded mx-auto d-block mt-3" alt="..."><div class="card-body"><h5>'. $value['description'] .'</h5></div></div>';
     }
}

function checkNameIMg(){
     $display = getConnexion();
     $req = $display->prepare("SELECT nameMedia, pathImg FROM media");
     $req->execute();

     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     if ($value['nameMedia']) {
     foreach ($res as $key => $value) {
               // code...
          }
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

function getIdolGroup($nameGroup){
     $display = getConnexion();
     $req = $display->prepare("SELECT idGroup, nameGroup, debutDate, logo, gender, nameAgence FROM groups as b, agences as a WHERE b.idAgence = a.idAgence AND nameGroup = :nameGroup");
     $req->bindParam(":nameGroup", $nameGroup, PDO::PARAM_STR);
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     foreach ($res as $key => $value) {
          echo '<input type="hidden" name="id" value="'.$value['idGroup'].'">';
          echo '<div class="form-group"><label>Nom du groupe</label><input name="updName" class="form-control" type="text" value="' . $value['nameGroup'] . '"></div>';
          echo '<div class="form-group"><label>Début</label><input name="updDebut" class="form-control" type="text" value="' . $value['debutDate'] . '"></div>';
          echo '<div class="form-group"><label>Nom de l\'agence</label><select class="form-control" name="updAgence">'.getAgence($nameGroup).'</select></div>';
     }
}

function getIdAgence($group){
     $idAgence = getConnexion();
     $req = $idAgence->prepare("SELECT idAgence FROM groups WHERE nameGroup = :group");
     $req->bindParam(":group", $group, PDO::PARAM_STR);
     $req->execute();
     $res = $req->fetchAll(PDO::FETCH_ASSOC);
     return $res[0]['idAgence'];
}
