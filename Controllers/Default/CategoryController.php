<?php

require_once __DIR__ . '/../../DMP/Controller.php';

class CategoryController extends \DMP\Controller
{
    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function IndexAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $sql = 'SELECT * FROM categories';

        $db = $this->getManager('default');
        $getCategories = $db->query($sql);

        if (!$getCategories) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $categories = [];
        while ($row = mysqli_fetch_assoc($getCategories)) {
            $categories[] = $row;
        }

        return ['Default/categories', [
                'categories' => $categories
            ]
        ];
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function oneCategoryAction($request)
    {
        $categoryId = $request->get('categoryId');

        if (!$categoryId) {
            $this->redirect('/');
        }

        $page = $request->get('page', 1);;
        $gamesPerView = $request->get('games-per-view', 6);
        $limit = $gamesPerView;
        $offset = ($page - 1) * $gamesPerView;

        $sql = 'SELECT
            games.*, categories.name
            FROM games
            LEFT JOIN categories
            ON games.category = categories.id
            WHERE games.category = ' . $categoryId . '
            ORDER BY games.id DESC
            LIMIT ' . $offset . ',' . $limit;

        $db = $this->getManager('default');
        $getGames = $db->query($sql);

        if (!$getGames) {
            throw new mysqli_sql_exception('Can\'t execute the query!');
        }

        $games = [];
        while ($row = mysqli_fetch_assoc($getGames)) {
            $games[] = $row;
        }

        $sql = 'SELECT id FROM games WHERE category = ' . $categoryId;
        $getCountGames = $db->query($sql);
        $count_games = $getCountGames->fetch_all();

        $pages = ceil(count($count_games) / $gamesPerView);

        if ($page > $pages) {
            $page = $pages;
        }

        $sql = 'SELECT name FROM categories WHERE id = ' . $categoryId;
        $getCategoryName = $db->query($sql);
        $categoryName = $getCategoryName->fetch_all();

        return array('Default/games', [
            'games' => $games,
            'page' => $page,
            'pages' => $pages,
            'category' => $categoryName[0][0]
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function addCategoryAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $boolean = $request->get('boolean');
        $message = $request->get('message');

        if ($boolean) {
            if ($boolean == 'true') {
                $boolean = true;
            } else {
                $boolean = false;
            }
        }

        return array('Default/add-category', [
            'boolean' => $boolean,
            'message' => $message
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function editCategoryAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $categoryId = (int) $request->get('categoryId');

        $boolean = $request->get('boolean');
        $message = $request->get('message');

        if ($boolean) {
            if ($boolean == 'true') {
                $boolean = true;
            } else {
                $boolean = false;
            }
        }

        $sql = "SELECT * FROM categories WHERE id = $categoryId";

        $em = $this->getManager('default');
        $getCategory = $em->query($sql);

        if ($getCategory === false) {
            throw new mysqli_sql_exception('Have a problem with the SQL!');
        }

        return array('Default/add-category', [
            'category' => $getCategory->fetch_array(1),
            'boolean' => $boolean,
            'message' => $message
        ]);
    }

    /**
     * @param \DMP\Request $request
     *
     * @return array
     */
    public function processAddCategoryAction($request)
    {
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] !== true) {
            $this->redirect('/');
        }

        $categoryId = (int) $request->post('categoryId');
        $categoryName = htmlspecialchars($request->post('name'), ENT_QUOTES);

        if (strlen($categoryName) > 50) {
            $this->redirect('/add-category?boolean=false&&message=The name is too long!');
        }

        $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";

        if ($categoryId) {
            $sql = "UPDATE categories SET name = '$categoryName' WHERE id = $categoryId";
        }

        $em = $this->getManager('default');
        $updateRow = $em->query($sql);

        if ($updateRow === false) {
            throw new mysqli_sql_exception('Have a problem with the SQL!');
        }

        $this->redirect('/edit-category?categoryId=' . $categoryId . '&&boolean=true&&message=The category was updated successfully!');
    }
}