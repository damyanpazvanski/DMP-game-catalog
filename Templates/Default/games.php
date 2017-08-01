<?php include 'common/header.php'?>
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">All games
                <small>Most popular</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li class="active"><?php echo isset($params['category']) ? $params['category'] : 'All games' ?></li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <?php
    $row = '';
    for($i = 0; $i < count($params['games']); $i++) {
        $row = '';

        if ($i == 0 || $i % 3 == 0) {
            $row .= '<div class="row">';
        }

        $game = $params['games'][$i];
        $row .= '
            <div class="col-md-4 img-portfolio">
                <a href="/game?gameId=' . $game['id'] . '">
                    <img class="img-responsive img-hover" src="/assets/images/' . $game['image_name'] . '" alt="Logo">
                </a>
                <h3>
                    <a href="/game/' . $game['id'] . '">' . $game['game_name'] . '</a>
                </h3>
                <p>' . substr(htmlspecialchars_decode($game['description'], ENT_QUOTES), 0, 100) . '</p>
            </div>';

        if (($i + 1) % 3 == 0) {
            $row .= '</div>';
        }

        echo $row;
    }
    ?>
    <div class="row text-center">
        <div class="col-lg-12">
            <ul class="pagination">
                <li>
                    <a href="/games?page=<?php echo $params['page'] - 1 ?>">&laquo;</a>
                </li>

                <?php
                for ($i = 0; $i < $params['pages']; $i++) {
                    if ($params['page'] == ($i + 1)) {
                        ?>
                        <li class="active">
                            <a href="games?page=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li>
                            <a href="games?page=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
                <li>
                    <a href="/games?page=<?php echo $params['page'] + 1 ?>">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>
    <hr>
<?php include 'common/footer.php'?>
