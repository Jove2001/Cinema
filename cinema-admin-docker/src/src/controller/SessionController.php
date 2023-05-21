<?php

namespace CinemaAdmin\Controller;

use CinemaAdmin\Controller\MySQLConnection;
use PDOException;
use PDO;
use stdClass;

class SessionController
{
    public static function add_session()
    {
        global $route;
        $id = intval($_POST['id']);
        $date = date("Ymd", strtotime($_POST['date']));

        try {
            // Get the connection
            $pdo = (new MySQLConnection())->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = <<<SQL
                INSERT INTO Sessions (date, id)
                VALUES ($date, $id )
            SQL;

            $pdo->exec($sql);

            $route = new stdClass();
            $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/session-admin.view.php';
            $route->Title = 'Cinema Admin';
        } catch (PDOException $e) {
            $route = new stdClass();
            $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/error.view.php';
            $route->Title = 'Database error';
        }
        return $route;
    }

    /**
     * Save an edited session
     */
    public static function save_session()
    {
        global $route;
        $id = intval($_POST['id']);
        $date = date("Ymd", strtotime($_POST['date']));
        $sql = <<<SQL
            UPDATE Sessions
            SET id = $id
            WHERE date = $date
        SQL;
        try {
            $pdo = (new MySQLConnection())->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec($sql);
            $route = new stdClass();
            $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/session-admin.view.php';
            $route->Title = 'Cinema Admin';
            require $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/main.view.php';
        } catch (PDOException $e) {
            $route = new stdClass();
            $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/session-admin.view.php';
            $route->Title = 'Cinema Admin';
            return $route;
        }
    }

    /**
     * Edit an existing session
     */
    public static function edit_session()
    {
        global $route;
        $route = new stdClass();
        $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/edit-session.view.php';
        $route->Title = 'Edit Session';
        return $route;
    }

    /**
     * Get all future sessions
     */
    public static function get_all_sessions()
    {
        // Get the connection
        $pdo = (new MySQLConnection())->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = <<<SQL
            SELECT Sessions.date, Sessions.id, Movies.title, Movies.poster_path
            FROM Sessions
            JOIN Movies
            ON Sessions.id = Movies.id
            WHERE Sessions.date >= CURDATE()
        SQL;

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $session_data = $stmt->fetchAll();
        return $session_data;
    }

    /**
     * Get all currently playing movies
     */
    public static function get_all_movies()
    {
        // Get the connection
        $pdo = (new MySQLConnection())->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query
        $sql = <<<SQL
            SELECT * 
            FROM Movies
            WHERE Movies.release_date <= CURDATE() + INTERVAL 90 DAY
        SQL;

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $movie_data = $stmt->fetchAll();

        $stmt = $pdo->prepare("SELECT * FROM Genres");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $genre_data = $stmt->fetchAll();

        $all_genres = [];
        for ($i = 0; $i < sizeof($movie_data); $i++) {
            $genres = [];
            if (isset($movie_data[$i]['genre_ids'])) {
                $genre_ids = json_decode($movie_data[$i]['genre_ids']);
                for ($j = 0; $j < sizeof($genre_ids); $j++) {
                    for ($k = 0; $k < sizeof($genre_data); $k++) {
                        if ($genre_data[$k]['id'] == $genre_ids[$j]) {
                            $genres[] = $genre_data[$k]['name'];
                            $all_genres[] = $genre_data[$k]['name'];
                            break;
                        }
                    }
                }
            }
            $results[] = [
                'id' => $movie_data[$i]['id'],
                'title' => $movie_data[$i]['title'],
                'overview' => $movie_data[$i]['overview'],
                'poster_path' => $movie_data[$i]['poster_path'],
                'release_date' => $movie_data[$i]['release_date'],
                'popularity' => $movie_data[$i]['popularity'],
                'genres' => $genres
            ];
        }

        $all_genres = array_values(array_unique($all_genres));

        return $results;
    }
}
