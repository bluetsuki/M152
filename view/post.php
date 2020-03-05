<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/post/postStyle.css">
    <title>Home</title>
</head>
<body>
     <?php require_once 'nav.php'; ?>
    <div class="container">
        <form action="?action=post" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <textarea rows="10" name="comment" class="form-control mt-3" placeholder="Poster votre message"></textarea>
            </div>
            <label for="fileUpload" class="cmrRetro"><img id="updIcon" src="media/img/camera-retro-solid.svg" height="20em" /></label>
            <input type="file" name="imgPost[]" multiple accept="image/*, video/*, audio/*" style="display: none;" id="fileUpload" class="form-control-file" onchange="loadFile(event)">
            <input type="submit" name="sendImg" class="btn btn-outline-light float-right colorB text-white" value="Envoyer">
        </form>
        <div id="previewImg" class="ml-3"></div>
    </div>
    <script src="js/previewImg.js" type="text/javascript"></script>
</body>
</html>
