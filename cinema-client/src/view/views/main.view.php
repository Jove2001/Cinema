<!doctype html>
<html lang="en" data-bs-theme="dark">

<!--

CinemaClient application

main.view.php 04/04/2023

Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au

This software is the original academic work of Ian McElwaine.
It has been prepared for submission to RMIT University
as assessment work for COSC2639 Cloud Computing

-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title><?php echo $route->Title; ?></title>

    <!-- Set icon-->
    <link rel="icon" href="/media/cinema-client.png" type="image/x-icon" />

</head>

<style>
    body {
        padding-left: 25px;
        padding-right: 25px;
        padding-top: 10px;
    }

    nav {
        margin-bottom: 15px;
    }

    nav .nav-item {
        text-align: center;
        padding-left: 20px;
        padding-right: 20px;
    }

    nav a.nav-link {
        color: white;
    }

    nav a.nav-link:hover {
        transition: 0.5;
        background-color: black;
        color: darkgrey;
    }

    section {
        padding-top: 25px;
        min-height: 30vmax
    }
</style>

<body>
    <div class='container-fluid row-gap-3'>
        <div class='row'>
            <img src='/media/cinema-header.png'>
        </div>
    </div>
    <nav class="navbar navbar-expand-md bg-body-tertiary nav-pills">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="/media/cinema-client.png" alt="logo" style="width:40px;" class="rounded-pill"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Book tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php?page=about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <div class='container-fluid row-gap-3'>
            <?php if (isset($route->View)) require $route->View; ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

<footer style="padding-top:25px;padding-bottom:25px;">
    © Ian McElwaine 2023
</footer>

</html>

<!--
Dark mode styling with Bootstrap v5.3, https://getbootstrap.com/docs/5.3/getting-started/introduction/ 
-->