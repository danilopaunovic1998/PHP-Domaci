<?php

require "dbBroker.php";
require "model/product.php";
require "model/type.php";
$i = 0;
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: index.php');
    exit();
}

$_SESSION["proizvodi"] = Product::getAll($conn);
$types = Type::getAll($conn);
?>
<?php
if (!$_SESSION["proizvodi"] || !$types) {
    echo "Nastala je greska pri preuzimanju popataka";
    die();
}
if ($_SESSION["proizvodi"]->num_rows == 0) {
    echo "Nema proizvoda";
    die();
}
if ($types->num_rows == 0) {
    echo "Nema kategorija";
    die();
} else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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



    <section class="bg-dark text-light p-5 text-start baner1">
        <div class="container">


            <div class="container">
                <div class="row" id="filteri">
                    <div class="col-lg-6 col-12 filter">
                        <div class="input-group rounded">
                            <input id="pretraga" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 filter">
                        <select id="sort" class="form-select" aria-label="Default select example">
                            <option selected>Sort by price</option>
                            <option value="1">Ascending</option>
                            <option value="2">Descending</option>

                        </select>
                    </div>
                </div>
            </div>

            <h1>Products</h1>
            <div id="myTable">
                <table id="table-data" class="table tabelica">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody id="kontent-tabelice">
                        <!--petlja-->
                        <?php
                        while ($red = $_SESSION["proizvodi"]->fetch_array()) : ?>
                            <tr>

                                <td><?php echo ++$i ?></td>
                                <td><?php echo $red["title"] ?></td>
                                <td><?php $pom = Type::getById($conn, $red["typeid"]);
                                    echo $pom[0]["name"] ?></td>
                                <td><?php echo $red["description"] ?></td>
                                <td><?php echo $red["price"] ?></td>
                                <td>
                                    <button onclick="popuniModal(<?php echo $red['productid'] ?>)" type="button" class="btn btn-primary dugme-izmeni" data-bs-toggle="modal" data-bs-target="#IzmeniModal">Izmeni</button>
                                    <button onclick="deleteFunc(<?php echo $red['productid'] ?>)" class="btn btn-danger dugmeObrisi">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile;
                        ?>
                    </tbody>

                </table>
            </div>
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
                            <select id="type" name="typeid" class="form-select form-select" aria-label=".form-select-sm example">
                                <option selected>Open this select menu</option>
                                <?php while ($red = $types->fetch_array()) : ?>
                                    <option value="<?php echo $red["typeid"] ?>"> <?php echo $red["name"] ?> </option>
                                <?php endwhile; ?>
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
<footer class="bg-dark site-footer text-light p-5 text-start"></footer>

</html>