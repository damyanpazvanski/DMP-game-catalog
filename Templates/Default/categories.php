<?php include 'common/header.php'?>
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">All categories</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/categories">All categories</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="text-right" style="padding-bottom: 20px">
        <a href="/add-category" class="btn btn-primary">Add a new one</a>
    </div>

    <div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td>NAME</td>
                    <td>ACTIONS</td>
                </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($params['categories']); $i++) {
                ?>
                <tr>
                    <td><?php echo $params['categories'][$i]['name'] ?></td>
                    <td><a href="/edit-category?categoryId=<?php echo $params['categories'][$i]['id'] ?>">EDIT</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

<?php include 'common/footer.php'?>