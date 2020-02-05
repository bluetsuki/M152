
<?php
require_once 'crud.php';
$btn = filter_input(INPUT_POST, 'sendImg');

if ($btn == 'Envoyer') {
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $nbFiles = count($_FILES['imgPost']['name']);

    for($i = 0; $i < $nbFiles ;$i++){
        $filename = $_FILES['imgPost']['name'][$i];

        if ($_FILES['imgPost']['size'][$i] > 3000000) {
            header('Location: ?action=post');
            exit;
        }else {
            addImage("image", trim($filename . uniqid()), $comment, 'upload/' . $filename);
            move_uploaded_file($_FILES['imgPost']['tmp_name'][$i], 'upload/'. $filename);

        }
        header('Location: ?action=home');
        exit;
    }
}
