<div class='row'>
    <div class='col'>
        <h1 class="display-1">Your booking has been confirmed</h1>
    </div>
    <table>
        <tr>
            <td class="align-middle">
                <img class="rounded float-start" src="<?php echo $_POST['poster_path'] ?>" alt="movie poster" style="width:200px;padding-right:15px;">
                <h3><?php echo $_POST['title'] ?></h3>
                <b>Session time: 6:30pm on <?php echo date('d M Y', strtotime($_POST['date'])); ?></b><br><br>
                <h3>Booking for:</h3>
                <p>
                    <?php echo $_POST['name'] ?><br>
                    <?php echo $_POST['email'] ?>
                </p><br>
                Number of tickets: <?php echo $_POST['tickets'] ?><br>
            </td>
        </tr>
    </table>
</div>