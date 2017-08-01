<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Damyan Pazvanski">

    <title>DMP Framework</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/modern-business.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">DMP Framework</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/games">Games</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        require __DIR__ . '/../../../Block/Default/LoadCategories.php';
                        $loadCategories = new LoadCategories();
                        $categories = $loadCategories->load();

                        for ($i = 0; $i < count($categories); $i++) {
                            ?>
                            <li>
                                <a href="/category?categoryId=<?php echo $categories[$i]['id'] ?>"><?php echo $categories[$i]['name'] ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                    if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
                ?>

                        <li>
                            <a href="/categories">Categories</a>
                        </li>
                        <li>
                            <a href="/add-game">Add game</a>
                        </li>
                        <li>
                            <a href="/add-category">Add category</a>
                        </li>
                        <li>
                            <a href="/logout">LOGOUT</a>
                        </li>
                <?php
                    } else {
                        ?>
                        <li>
                            <a href="/login">LOGIN</a>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<?php if (isset($params['error'])) { ?>
<?php
    if ($params['error'] == true) {
        ?>
        <div class="alert alert-danger text-center">
            <?php echo $params['message'] ?>
        </div>
        <?php
    } else if ($params['error'] == false) {?>
    <div class="alert alert-success text-center">
        <?php echo $params['message'] ?>
    </div>
<?php
    }
}
?>