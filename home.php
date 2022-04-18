
<?php

    require "dbBroker.php";
    require "model/product.php";
    $i = 0;
    session_start();
    if(!isset($_SESSION["user"])){
        header('Location: index.php');
        exit();
    }

    $proizvodi = Product::getAll($conn);
    if(!$proizvodi)
    {
        echo "Nastala je greska pri preuzimanju popataka";
        die();
    }
    if($proizvodi->num_rows == 0){
        echo "Nema proizvoda";
        die();
    }
    else {}
   
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

            <table class = "table table-dark table-striped table-bordered">
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
                   <?php while ($red = $proizvodi->fetch_array()): ?>
                    <tr>
                        
                        <td><?php echo ++$i?></td>
                        <td><?php echo $red["title"] ?></td>
                        <td><?php echo $red["description"]?></td>
                        <td><?php echo $red["price"]?></td>
                        <td>
                            <button value="<?php echo $red['productid'] ?>" class="btn btn-warning btn-izmeni" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>
                            <button  type="button" value=<?php echo $red['productid'] ?> method="post" class="btn btn-secondary dugmeIzmeni">Edit</button>
                            <button  onclick = "deleteFunc(<?php echo $red['productid']?>)" class="btn btn-danger dugmeObrisi">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </section>
    <!--SearchBar-->
    <!--Ponuda-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>
