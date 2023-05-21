<section id="debug" style="background-color: #00000011;">
    <b>Debug</b>
    <?php
    echo '<pre>';

    // Debug view route
    echo '<br>View route<br>';
    var_dump($route);

    // Debug $_POST array
    echo '<br>$_POST<br>';
    var_dump($_POST);

    // Debug $_GET array
    echo '<br>$_GET<br>';
    var_dump($_GET);

    // Debug $_SESSION array
    echo '<br>$_SESSION<br>';
    var_dump($_SESSION);

    // Debug $_FILES array
    echo '<br>$_FILES<br>';
    var_dump($_FILES);

    // Debug $_ENV array
    echo '<br>$_ENV<br>';
    var_dump($_ENV);

    // Debug $_SERVER array
    echo '<br>$_SERVER<br>';
    var_dump($_SERVER);

    echo '</pre>';
    ?>
</section>