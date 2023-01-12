<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>myLibrary-Welcomw</title>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles.css">
    <!--Font Linking-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300&display=swap"
        rel="stylesheet">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/a4b361ce10.js" crossorigin="anonymous"></script>
</head>

<body>

    <section id="form-nav">
        <div class="container-fluid">

            <!-- Nav Bar -->

            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="">welcome</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#footer">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-4">
                <h3>
                    <?php echo "Hey ". $_SESSION['username']?>!<br> You can now use this website
                </h3>
                <hr>
            </div>

            <div class="container-fluid">
                <div class="container">
                    <div class="search">
                        <h1>All Books</h1>
                        <input type="text" name="" id="find" placeholder="search here...." onkeyup="search()">
                    </div>
                    <div class="product-list">
                        <div class="product">
                            <img class="book-img" src="./images/a.webp" alt="a-logo">
                            <h6>Amazon Unbound</h6>
                        </div>
                        <div class="product">
                            <img class="book-img" src="./images/i.jpg" alt="i-logo">
                            <h6>Ikigai</h6>
                        </div>
                        <div class="product">
                            <img class="book-img" src="./images/rdpd.jpg" alt="rdpd-logo">
                            <h6>Rich Dad Poor Dad</h6>
                        </div>
                        <div class="product">
                            <img class="book-img" src="./images/eol.webp" alt="eol-logo">
                            <h6>Extra Ordinary Life</h6>
                        </div>
                        <div class="product">
                            <img class="book-img" src="./images/pom.jpg" alt="pom-logo">
                            <h6>Psychology of money</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <section id="books">
    <div class="grid-item"><img class="book-img" src="./images/a.webp" alt="a-logo"></div>
    <div class="grid-item"><img class="book-img" src="./images/i.jpg" alt="i-logo"></div>
    <div class="grid-item"><img class="book-img" src="./images/rdpd.jpg" alt="rdpd-logo"></div>
    <div class="grid-item"><img class="book-img" src="./images/eol.webp" alt="eol-logo"></div>
    <div class="grid-item"><img class="book-img" src="./images/pom.jpg" alt="pom-logo"></div>
   </section> -->

            <!--Footer-->
            <footer id="form-footer">
                <table>
                    <tbody>
                        <tr>
                            <td><a href=""><i class="fab fa-twitter fa-2x"></i></a></td>
                            <td><a href=""><i class="fab fa-facebook-f fa-2x"></i></a></td>
                            <td><a href=""><i class="fab fa-instagram fa-2x"></i></a></td>
                            <td><a href=""><i class="fas fa-envelope fa-2x"></i></a></td>
                        </tr>
                    </tbody>
                </table>
                <p>© Copyright myLibrary</p>

            </footer>
</body>
<script src="./welcome.js"></script>

</html>