<div class='row'>
    <div class='col'>
        <h1 class="display-1">Book your tickets</h1>
        <h2><?php echo $_POST['title']; ?></h2>
        <img src="<?php echo 'https://' . \CinemaClient\Config\Config::AWS_BUCKET . '.s3.amazonaws.com' . $_POST['backdrop_path']; ?>" alt="backdrop_path" class="img-fluid"><br><br>
        <h4>Your session time: <?php echo date('d M Y', strtotime($_POST['date'])); ?> @ 6:30pm</h4><br>
        <form class="row gy-2 gx-3 align-items-center" action="/" method="POST">
            <div class="col-auto">
                <label class="visually-hidden" for="autoSizingInput">Name</label>
                <input type="text" class="form-control" id="autoSizingInput" placeholder="Your name" name="name" required>
            </div>
            <div class="col-auto">
                <label class="visually-hidden" for="autoSizingInputGroup">Email</label>
                <input type="email" class="form-control" id="autoSizingInputGroup" placeholder="Your email" name="email" required>
            </div>
            <div class="col-auto">
                <label class="visually-hidden" for="autoSizingSelect">Tickets</label>
                <input type="number" min="1" max="50" class="form-control" id="autoSizingSelect" placeholder="Tickets" name="tickets" required>
            </div>
            <div class="col-auto">
                <input type="hidden" name="page" value="confirm-booking">
                <input type="hidden" name="date" value="<?php echo $_POST['date']; ?>">
                <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
                <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
                <input type="hidden" name="poster_path" value="<?php echo $_POST['poster_path']; ?>">
                <button type="submit" class="btn btn-primary">Book now</button>
            </div>
        </form>
    </div>
</div>