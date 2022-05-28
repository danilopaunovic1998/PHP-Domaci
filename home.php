<?php

require "dbBroker.php";
require "model/product.php";
$i = 0;
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: index.php');
    exit();
}

$proizvodi = Product::getAll($conn);
if (!$proizvodi) {
    echo "Nastala je greska pri preuzimanju popataka";
    die();
}
if ($proizvodi->num_rows == 0) {
    echo "Nema proizvoda";
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
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="create.php" class="nav-link">Create product</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Danilo Paunovic</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <!--ovo ti je za responzivnost dugmence, stavi navbar posle za ID  -->
        </div>
    </nav>

    <section class="bg-dark text-light p-5 text-start">
        <div class="container">
            <h1>Products</h1>

            <table class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <!--petlja-->
                    <?php while ($red = $proizvodi->fetch_array()) : ?>
                        <tr>

                            <td><?php echo ++$i ?></td>
                            <td><?php echo $red["title"] ?></td>
                            <td><?php echo $red["description"] ?></td>
                            <td><?php echo $red["price"] ?></td>
                            <td>
                                <button onclick="popuniModal(<?php echo $red['productid'] ?>)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#IzmeniModal">Izmeni</button>
                                <button onclick="deleteFunc(<?php echo $red['productid'] ?>)" class="btn btn-danger dugmeObrisi">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
    <!--izmeniModal-->
    <!-- Modal -->
    <div class="modal fade " id="IzmeniModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="mojModal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="updateProduct">

                        <div class="form-group">
                            <label> Product Title </label>
                            <input id="title" type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Product Description </label>
                            <input id="description" type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Product Price </label>
                            <input id="price" type="text" name="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Product Type </label>
                            <select id="type" name="id" class="form-select form-select" aria-label=".form-select-sm example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <input id="productid" type="hidden" name="id" class="form-control">
                        </div>
                        <button type="submit" id="btnIzmeni" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--SearchBar-->
    <!--Ponuda-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>