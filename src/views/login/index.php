<?php include(VIEWS_DIR . 'header.php'); ?>

<div class="row justify-content-md-center mt-5">
    <div class="col-xs-12 col-md-4">
        <h3 class="text-center">Login</h3>
        <form action="/index/login" method="post">
            <div class="mb-2">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-2 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me? (not working atm)</label>
            </div>
            <?php if (isset($_SESSION['errorMessage'])) { ?>
                <div class="mb-2"><span class="text-danger"><?=$_SESSION['errorMessage']?></span></div>
            <?php unset($_SESSION["errorMessage"]); } ?>
            <button type="submit" class="pull-right btn btn-primary">Login</button>
        </form>
    </div>
</div>




<?php include(VIEWS_DIR . 'footer.php'); ?>