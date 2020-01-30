<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="css/style.css">
     <title>Home</title>
</head>
<body>
     <?php require_once 'nav.php'; ?>
     <div class="container">
          <div class="row">
               <div class="col-sm-5 mt-3">
                    <div class="card">
                         <img src="img/sunset.png" class="card-img-top crdimg rounded mx-auto d-block mt-3" alt="...">
                         <div class="card-body">
                              <h5 class="card-title">smoll</h5>
                              <p>100 Followers, 10 Post</p>
                              <img src="img/user-regular.svg" height="25px">
                         </div>
                    </div>
               </div>
               <div class="col-sm-7 mt-3">
                    <div class="card">
                         <div class="card-body">
                              <h3 class="card-title">Welcome</h3>
                         </div>
                    </div>
                    <div class="card mt-3">
                         <img src="img/flower.jpg" class="crdimg rounded mx-auto mt-3" alt="flower">
                         <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                         </div>
                    </div>
                    <?=displayImg();?>
               </div>
          </div>
     </div>
</body>
</html>
