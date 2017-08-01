<?php include 'common/header.php'?>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>This game will be deleted!</p>
                </div>
                <div class="modal-footer">
                    <button id="removeGameAccept" type="button" class="btn btn-default" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $params['game']['game_name']?>
                    <small> - <?php echo $params['game']['name']?></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/games">All games</a>
                    </li>
                    <li class="active"><?php echo $params['game']['game_name']?></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <div class="col-md-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive" src="assets/images/<?php echo $params['game']['image_name']?>" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
                    ?>
                    <div class="col-md-12">
                        <div style="padding-top: 20px; font-size: 20px">
                            <a href="/edit-game?gameId=<?php echo $params['game']['id']?>">
                                <i class="glyphicon glyphicon-edit"></i> Edit Game
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="text-right">
                        <a id="removeGame" data-id="<?php echo $params['game']['id'] ?>" data-toggle="modal" data-target="#myModal">
                            <i class="glyphicon glyphicon-remove-circle"></i> Remove the game
                        </a>
                    </div>
                    <h3>Game Description</h3>
                    <p><?php echo htmlspecialchars_decode($params['game']['description'], ENT_QUOTES)?></p>
                    <h3>Project Details</h3>
                    <ul>
                        <li>Game category - <?php echo $params['game']['name']?></li>
                        <li>Price - <?php echo $params['game']['price']?></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr>

<?php include 'common/footer.php'?>