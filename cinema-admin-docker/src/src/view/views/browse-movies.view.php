<div class='col-sm-6'>
    <h1 class="display-1">Browse Movies</h1>
    <h3>Movies available</h3>
    <table class="table table-striped table-dark">
        <tbody>
            <?php
            $results = \CinemaAdmin\Controller\SessionController::get_all_movies();
            for ($i = 0; $i < sizeof($results); $i++) {
                $title = $results[$i]['title'];
                if (is_null($results[$i]['poster_path']))
                    $poster_path = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
                else
                    $poster_path = "https://image.tmdb.org/t/p/w154/" . $results[$i]['poster_path'];
                $release_date = date(DATE_COOKIE, strtotime($results[$i]['release_date']));
                $overview = $results[$i]['overview'];
                $genres = implode(', ', $results[$i]['genres']);

                echo <<<HTML
                <tr>
                    <td class="align-middle">
                        <img class="rounded float-start" src="$poster_path" alt="movie poster" style="width:200px;padding-right:15px;">
                        <h3>$title</h3>
                        <h6>Release time: $release_date</h6><br>
                        <p>$overview</p>
                        <p>$genres</p>
                    </td>
                </tr>
                HTML;
            }
            ?>
        </tbody>
    </table>
</div>