<div class='col'>
    <h1 class="display-1">Session Admin</h1>
    <h3>Add a new session</h3>
    <?php $results = CinemaAdmin\Controller\SessionController::get_all_movies(); ?>
    <form class="row gx-3 gy-2 align-items-center " action="/" method="post">
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">Date</label>
            <input type="date" class="form-control" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="col-sm-3">
            <select class="form-select" name="id" id="id" required>
                <?php
                for ($i = 0; $i < sizeof($results); $i++) {
                    echo <<<HTML
                    <option value='{$results[$i]["id"]}'>{$results[$i]["title"]}</option>
                    HTML;
                }
                ?>
            </select>
        </div>
        <input type="hidden" name="page" value="add-session">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <p>Select a session time</p>
</div>
<br><br>
<div class='col'>
    <h3>Current sessions</h3>
    <table class="table table-striped table-dark">
        <tbody>
            <?php
            $sessions = \CinemaAdmin\Controller\SessionController::get_all_sessions();
            array_multisort(array_column($sessions, 'date'), SORT_ASC, $sessions);
            for ($i = 0; $i < sizeof($sessions); $i++) {
                $date = date('d-M-Y', strtotime($sessions[$i]['date']));
                echo <<<HTML
                <tr>
                    <td class="align-middle">
                        <img src="https://image.tmdb.org/t/p/w154/{$sessions[$i]['poster_path']}" alt="movie-poster" class="img-fluid" style="width: 100px;">
                    </td>
                    <td class="align-middle">
                        $date    
                    </td>
                    <td class="align-middle">
                        {$sessions[$i]['title']}
                    </td>
                    <td class="align-middle">
                        <form action="/" method="post">
                            <input type="hidden" name="page" value="edit-session">
                            <input type="hidden" name="date" value="{$sessions[$i]['date']}">
                            <input type="hidden" name="id" value="{$sessions[$i]['id']}">
                            <input type="hidden" name="title" value="{$sessions[$i]['title']}">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </td>
                </tr>
                HTML;
            }
            ?>
        </tbody>
    </table>
</div>