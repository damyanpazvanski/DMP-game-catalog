<?php include 'common/header.php'; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-4">
            <h3>Login</h3>
            <form name="sentMessage" action="/login" method="POST" id="contactForm" novalidate>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="email" name="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" id="name" required data-validation-required-message="Please enter password.">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div id="success"></div>
                <!-- For success/fail messages -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary ">SEND</button>
                </div>
            </form>
        </div>
    </div>
<?php include 'common/footer.php'; ?>