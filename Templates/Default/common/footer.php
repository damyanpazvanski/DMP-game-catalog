
<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; Damyan Pazvanski</p>
        </div>
    </div>
</footer>

</div>
<!-- /.container -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jqBootstrapValidation.js"></script>
<script src="assets/js/contact_me.js"></script>

<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>

<?php
if (isset($params['js'])) {
    for ($i = 0; $i < count($params['js']); $i++) {
        ?>
        <script src="<?php echo $params['js'][$i] ?>"></script>
        <?php
    }
}
?>

</body>

</html>
