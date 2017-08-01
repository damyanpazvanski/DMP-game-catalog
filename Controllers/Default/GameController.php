<?php

require __DIR__ . '/../../DMP/Controller.php';

class GameController extends \DMP\Controller
{
    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function indexAction($request)
    {
        $db = $this->getManager('default');

        $error = isset($_SESSION['data']['deleteGame']['error']) ? $_SESSION['data']['deleteGame']['error'] : null;
        $message = isset($_SESSION['data']['deleteGame']['message']) ? $_SESSION['data']['deleteGame']['message'] : '';

        $page = $request->get('page', 1);;
        $gamesPerView = $request->get('games-per-view', 6);
        $limit = $gamesPerView;
        $offset = ($page - 1) * $gamesPerView;

        $sql = 'SELECT
            games.*, categories.name
            FROM games
            LEFT JOIN categories
            ON games.category = categories.id
            ORDER BY games.id DESC
            LIMIT ' . $offset . ',' . $limit;

        $getGames = $db->query($sql);

        if (!$getGames) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $games = [];
        while ($row = mysqli_fetch_assoc($getGames)) {
            $games[] = $row;
        }

        $sql = 'SELECT id FROM games';
        $getCountGames = $db->query($sql);
        $count_games = $getCountGames->fetch_all();

        $pages = ceil(count($count_games) / $gamesPerView);

        if ($page > $pages) {
            $page = $pages;
        }

        unset($_SESSION['data']['deleteGame']);

        return array('Default/games', [
            'games' => $games,
            'page' => $page,
            'pages' => $pages,
            'error' => $error,
            'message' => $message
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function editGameAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $db = $this->getManager('default');
        $gameId = $request->get('gameId');

        if (!$gameId) {
            $this->redirect('/');
        }

        $sql = 'SELECT games.*, categories.name FROM games LEFT JOIN categories ON games.category = categories.id where games.id = ' . $gameId;
        $getCategories = $db->query($sql);

        if (!$getCategories) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $game = [];
        while ($row = mysqli_fetch_assoc($getCategories)) {
            $game[] = $row;
        }

        $sql = 'SELECT * FROM categories';
        $getCategories = $db->query($sql);

        if (!$getCategories) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $categories = [];
        while ($row = mysqli_fetch_assoc($getCategories)) {
            $categories[] = $row;
        }

        return array('Default/add-game', [
            'game' => $game[0],
            'categories' => $categories
        ]);
    }


    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function deleteGameAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $db = $this->getManager('default');
        $gameId = $request->post('gameId');

        if (!$_SESSION['is_logged']) {
            echo json_encode([
                'error' => true,
                'message' => 'You have no permissions for this operation!'
            ]);

            return;
        }

        if (!$gameId) {
            echo json_encode([
                'error' => true,
                'message' => 'Have a problem with the game!'
            ]);

            return;
        }

        $sql = 'DELETE FROM games WHERE games.id = ' . $gameId;
        $deleteGame = $db->query($sql);

        if (!$deleteGame) {
            echo json_encode([
                'error' => true,
                'message' => 'We have a problem, try again later!'
            ]);

            return;
        }

        $_SESSION['data']['deleteGame'] = [
            'error' => false,
            'message' => 'The game was deleted seccessfully.'
        ];

        echo json_encode([
            'error' => false
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function showGameAction($request)
    {
        $db = $this->getManager('default');
        $gameId = $request->get('gameId');

        if (!$gameId) {
            $this->redirect('/games');
        }

        $sql = 'SELECT games.*, categories.name FROM games LEFT JOIN categories ON games.category = categories.id where games.id = ' . $gameId;
        $getCategories = $db->query($sql);

        if (!$getCategories) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $game = [];
        while ($row = mysqli_fetch_assoc($getCategories)) {
            $game[] = $row;
        }

        if (!isset($game[0])) {
            $this->redirect('/games');
        }

        $js = [
            'assets/js/edit-game.js'
        ];

        return array('Default/game', [
            'game' => $game[0],
            'js' => $js
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function AddFormAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $db = $this->getManager('default');
        $boolean = $request->get('boolean');
        $message = $request->get('message');

        if ($boolean) {
            if ($boolean == 'true') {
                $boolean = true;
            } else {
                $boolean = false;
            }
        }

        $sql = 'SELECT * FROM categories';
        $getCategories = $db->query($sql);

        if (!$getCategories) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $categories = [];
        while ($row = mysqli_fetch_assoc($getCategories)) {
            $categories[] = $row;
        }

        return array('Default/add-game', [
            'categories' => $categories,
            'boolean' => $boolean,
            'message' => $message
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function processAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $gameId = $request->post('gameId');
        $game_name = $request->post('name');
        $category_id = (int) $request->post('category');
        $price = (float) $request->post('price');
        $description = htmlspecialchars($request->post('description'), ENT_QUOTES);
        $image = $request->post('image');

        if ($price < 1 || $category_id < 1) {
            $this->redirect('/add-game?boolean=false&&message=The price or category is not correct!');
        }

        if (strlen($description) > 2000) {
            $this->redirect('/add-game?boolean=false&&message=The description is too long!');
        }

        $maxImageSize = 2 * 1024 * 1024;
        if ($image['size'] > $maxImageSize) {
            $this->redirect('/add-game?boolean=false&&message=The image is too big!');
        }

        $image_name = pathinfo($image['name'], PATHINFO_FILENAME);
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $game_name = htmlspecialchars($game_name);
        $description = htmlspecialchars($description);

        $path = $this->getImagesFolderPath();

        if (substr($path, -1, 0) !== '/') {
            $path .= '/';
        }

        $image_name_and_ext = $image_name . '.' . $imageExtension;
        $imageRoot = $path . $image_name_and_ext;
        if (file_exists($imageRoot)) {
            $num = (int) substr($image_name, -2, -1);
            $num += 1;
            $image_name_new = $image_name . '(' . $num . ')';
            $image_name_and_ext = $image_name_new . '.' . $imageExtension;
            $imageRoot = $path . $image_name_and_ext;

            $i = 0;
            while (file_exists($imageRoot)) {
                $num = (int) substr($image_name_new, -3, -1);
                if ($num == 0) {
                    $num = (int) substr($image_name_new, -2, -1);
                }

                if ($num == 0) {
                    $num = 1;
                } else {
                    $num += 1;
                }

                $image_name_new = $image_name . '(' . (string) $num . ')';
                $image_name_and_ext = $image_name_new . '.' . $imageExtension;
                $imageRoot = $path . $image_name_and_ext;

                if ($i == 31) {
                    die;
                }
                $i++;
            }
        }

        $em = $this->getManager('default');

        $sql = "INSERT INTO games (
                    game_name,
                    price,
                    description,
                    image_name,
                    category) VALUES
                    ('$game_name',
                    '$price',
                    '$description',
                    '$image_name_and_ext',
                    '$category_id')";

        if ($gameId) {
            $sql = "UPDATE games SET 
                        game_name='$game_name',
                        price='$price',
                        description='$description',
                        category='$category_id'
                    WHERE id = $gameId";

            if ($image_name) {
                $sql = "UPDATE games SET 
                        game_name='$game_name',
                        price='$price',
                        description='$description',
                        image_name='$image_name_and_ext',
                        category='$category_id'
                    WHERE id = $gameId";

                $imageName = 'SELECT image_name FROM games WHERE id=' . $gameId;
                $getImageName = mysqli_fetch_assoc($em->query($imageName));

                if (file_exists($this->getImagesFolderPath() . '/' . $getImageName['image_name'])) {
                    unlink($this->getImagesFolderPath() . '/' . $getImageName['image_name']);
                }
            }
        }

        $insertedRow = $em->query($sql);
        if ($insertedRow === false) {
            throw new mysqli_sql_exception('Have a problem with the INSERT statement!');
        }

        file_put_contents($imageRoot, file_get_contents($image['tmp_name']));

        $this->redirect('/add-game?boolean=true&&message=The game was updated successfully!');
    }
}