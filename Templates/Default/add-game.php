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
                <h3>Add a new game</h3>
                <form name="sentMessage" action="/add-game-process" method="POST" enctype="multipart/form-data" id="contactForm" novalidate>
                    <input type="text" hidden name="gameId" value="<?php echo isset($params['game']['id']) ? $params['game']['id'] : '' ?>">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Game name:</label>
                            <input type="text" value="<?php echo (isset($params['game']['game_name']) ? $params['game']['game_name'] : '')?>" name="name" class="form-control" required data-validation-required-message="Please enter name.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Category:</label>
                            <select class="form-control" name="category" required data-validation-required-message="Please enter your email address.">
                                <?php
                                    foreach ($params['categories'] as $category) {

                                        if (isset($params['game']['category']) && $params['game']['category'] == $category['id']) {
                                            ?>
                                            <option selected value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Price:</label>
                            <input type="text" value="<?php echo isset($params['game']['price']) ? $params['game']['price'] : ''?>" name="price" class="form-control" required data-validation-required-message="Please enter price.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Description:</label>
                            <textarea rows="6" name="description" class="form-control" required data-validation-required-message="Please enter description."><?php echo isset($params['game']['description']) ? htmlspecialchars_decode($params['game']['description']) : ''?></textarea>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Image:</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary ">SAVE</button>
                    </div>
                </form>
            </div>
        </div>

<?php include 'common/footer.php'; ?>