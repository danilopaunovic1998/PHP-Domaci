<?php
require "dbBroker.php";
require "model/type.php";
$i = 0;
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: index.php');
    exit();
}

$types = Type::getAll($conn);
if (!$types) {
    echo "Nastala je greska pri preuzimanju popataka";
    die();
}
if ($types->num_rows == 0) {
    echo "Nema tipova proizvoda";
    die();
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <title>Kanye Unlimited Home Page</title>
</head>

<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 border-bottom border-secondary">
        <div class="container">
            <a href="" class="navbar-brand">
                Kanye Unlimited
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Create product</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Danilo Paunovic</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <!--ovo ti je za responzivnost dugmence, stavi navbar posle za ID  -->
        </div>
    </nav>

    <!--forma za dodavanje proizvoda-->
    <section class="bg-dark text-light p-5 text-start baner1">
        <div class="container">
            <h1>Create New Product</h1>
            <br>
            <form action="" method="post" id="addProduct">

                <div class="form-group">
                    <label> Product Title </label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label> Product Description </label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="form-group">
                    <label> Product Price </label>
                    <input type="text" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <label> Product Type </label>
                    <select class="form-select form-select" name="category" aria-label=".form-select-sm example">
                        <option selected>Open this select menu</option>
                        <?php while ($red = $types->fetch_array()) : ?>
                            <option value="<?php echo $red["typeid"] ?>"> <?php echo $red["name"] ?> </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>

        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
<footer class="bg-dark site-footer text-light p-5 text-start"></footer>

</html>