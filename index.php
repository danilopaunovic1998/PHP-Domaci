
<?php

require "dbBroker.php";
require "model/user.php";

session_start();
if(isset($_POST['email']) && isset($_POST['password']))
{
    $uemail = $_POST['email'];
    $upass = $_POST['password'];

    
    $odg = User::logInUser($uemail, $upass, $conn);

    if($odg->num_rows==1)
    {
        echo `
        <script>
            console.log("Uspesno ste se prijavili");
        </script>
        `;
        $row = mysqli_fetch_row($odg);
        $usr = new User($row[0], $row[1],$row[2]);
        $_SESSION['user'] = $usr;
        header('Location: home.php');
        exit();
    }
    else
    {
        echo `
            <script>
                console.log("Neuspesna prijava");
            </script>
        `;
    }
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

    <title>Kanye Unlimited LogIn</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 border-bottom border-secondary">
        <div class="container">
            <a href="" class="navbar-brand">
                Kanye Unlimited
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <!--ovo ti je za responzivnost dugmence, stavi navbar posle za ID  -->
        </div>
    </nav>
    <!-- Navbar i login forma -->
    <section class="bg-dark text-light p-5 text-start">
        <div class="container">
            <div class="d-sm-flex">
                <div class="col-7 me-5">
                    <img class="img-fluid" src="slike/kwbg.jpg" alt="Kanye West">
                </div>
                <div>
                    <form method="POST" action="#">
                        <h1>Welcome to </h1>
                        <h1 class="mb-5"><span class="text-warning">Kanye West</span> shop</h1>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label class="floatingText" for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-5">
                            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label class="floatingText" for="floatingPassword">Password</label>
                        </div>
                        <div class="">
                            <button name="submit" type="submit" class="btn btn-primary btn-lg">LogIn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- kutijice -->
    <section class="p-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md">
                    <div class="card bg-dark text-light h-100">
                        <div class="h1 m-3">
                            <i class="bi bi-vinyl"></i>
                        </div>
                        <h3 class="card-title">
                            Records
                        </h3>
                        <p class="card-text m-3">
                            Find vinyls and records you love.
                            Explore all of Kanye West interesting personalitys, that he goes through every album.
                        </p>
                    </div>
                </div>
                <div class="col-md ">
                    <div class="card bg-secondary text-light h-100">
                        <div class="h1 m-3">
                            <i class="bi bi-cart"></i>
                        </div>
                        <h3 class="card-title">
                            Shop
                        </h3>
                        <p class="card-text m-3">
                            Have a look at our fenomenal selection of hoodies, t-shirts, sneakers and many more Yeezy
                            related things.
                        </p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-dark text-light h-100">
                        <div class="h1 m-3">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3 class="card-title">
                            Shipping
                        </h3>
                        <p class="card-text m-3">
                            We do the shipping all around the world!
                            All you have to do is to pick your Yeezy box and it will be at your dore within a month.
                            Don't forget to have fun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>