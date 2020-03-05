<?php
$idEdit = FILTER_INPUT(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);
$comment = getPost($idEdit)[0]['commentaire'];
var_dump($comment);
