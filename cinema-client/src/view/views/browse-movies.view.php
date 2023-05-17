<table class="table table-striped table-dark">
    <tbody>
        <?php
        $results = \CinemaClient\Controller\BookingController::get_sessions();
        for ($i = 0; $i < sizeof($results); $i++) {
            $title = $results[$i]['title'];
            if (is_null($results[$i]['poster_path']))
                $poster_path = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
            else
                $poster_path = 'https://' . \CinemaClient\Config\Config::AWS_BUCKET . '.s3.amazonaws.com' . $results[$i]['poster_path'];
            $date = date('d M Y', strtotime($results[$i]['date']));
            $overview = $results[$i]['overview'];
            $genres = implode(', ', $results[$i]['genres']);

            echo <<<HTML
            <tr>
                <td class="align-middle">
                    <img class="rounded float-start" src="$poster_path" alt="movie poster" style="width:200px;padding-right:15px;">
                    <h3>$title</h3>
                    <h6>Session time: 6:30pm on $date</h6><br>
                    <p>$overview</p>
                    <p>$genres</p>
                </td>
                <td class="align-middle">
                    <form action="/" method="POST">
                    <input type="hidden" name="page" value="book-ticket">
                        <input type="hidden" name="date" value="{$results[$i]['date']}">
                        <input type="hidden" name="title" value="{$results[$i]['title']}">
                        <input type="hidden" name="backdrop_path" value="{$results[$i]['backdrop_path']}">
                        <input type="hidden" name="poster_path" value="$poster_path">
                        <input type="hidden" name="id" value="{$results[$i]['id']}">
                        <button type="submit" class="btn btn-primary">Book now</button>
                    </form>
                </td>
            </tr>
            HTML;
        }
        ?>
    </tbody>
</table>