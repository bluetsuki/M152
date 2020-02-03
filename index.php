<?php
session_start();
require_once 'model/crud.php';
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

if(isset($_SESSION['role']))
     $role = $_SESSION['role'];
else
     $role="Anonymous";

$permission = [
     "Anonymous"=>[
          "default"=>"home",
          "post"=>"post",

     ],
     "User"=>[
          "default"=>"home",
          "post"=>"post",
     ]
];

if (!array_key_exists($action, $permission[$role])) {
     $action = "default";
}

try {
     require './controller/'.$permission[$role][$action].'.php';
} catch (Exception $e) {

}
?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
