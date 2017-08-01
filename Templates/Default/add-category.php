<?php include 'common/header.php'; ?>
    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <?php
            if (!empty($params['message'])) {
                ?>
                <div class="alert <?php echo $params['boolean'] ? 'alert-success' : 'alert-danger'?>">
                    <?php echo $params['message']?>
                </div>
                <?php
            }
            ?>
            <h3>Add a new category</h3>
            <form name="sentMessage" action="/process-add-category" method="POST" enctype="multipart/form-data" id="contactForm" novalidate>
                <input type="text" hidden name="categoryId" value="<?php echo isset($params['category']['id']) ? $params['category']['id'] : '' ?>">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Category name:</label>
                        <input type="text" value="<?php echo (isset($params['category']['name']) ? $params['category']['name'] : '')?>" name="name" class="form-control" required data-validation-required-message="Please enter name.">
                    </div>
                </div>
                <div id="success"></div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary ">SAVE</button>
                </div>
            </form>
        </div>
    </div>

<?php include 'common/footer.php'; ?>