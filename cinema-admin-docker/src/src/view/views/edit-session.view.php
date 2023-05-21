<div class='col'>
    <h1 class="display-1">Edit session</h1>
    <h3>Edit a session</h3>
    <?php $results = CinemaAdmin\Controller\SessionController::get_all_movies(); ?>
    <form class="row gx-3 gy-2 align-items-center " action="/" method="post">
        <div class="col-sm-3">
            Session date: 
            <?php echo date("d-m-Y", strtotime($_POST["date"])); ?>
        </div>
        <div class="col-sm-3">
            <label for="movie" class="visually-hidden">Movie</label>
            <select class="form-select" name="id" id="id">
                <option selected>Select a movie</option>
                <?php
                for ($i = 0; $i < sizeof($results); $i++) {
                    echo <<<HTML
                    <option value='{$results[$i]["id"]}'>{$results[$i]["title"]}</option>
                    HTML;
                }
                ?>
            </select>
        </div>
        <input type="hidden" name="page" value="save-session">
        <input type="hidden" name="date" value="<?php echo $_POST["date"]; ?>">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>