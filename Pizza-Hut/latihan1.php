<?php

$data = file_get_contents('data/pizza.json');
$menu = json_decode($data, true);

$menu = $menu['menu'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Hut</title>

    <link rel="stylesheet" href="assets/bootstrap4/css/bootstrap.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="img/logo.png" width="120">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a href="" class="nav-item nav-link active">home</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h1>All Menu</h1>
            </div>
        </div>


        <div class="row">
            <?php foreach ($menu as $m) : ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="img/menu/<?php echo $m['gambar'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $m['nama'] ?></h5>
                            <p class="card-text"><?php echo $m['deskripsi'] ?></p>
                            <h5 class="card-title">Rp. <?php echo $m['harga'] ?></h5>
                            <a href="" class="btn btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>

</body>

</html>

<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap4/js/bootstrap.js"></script>