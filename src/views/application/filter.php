<?php include(VIEWS_DIR . 'header.php'); ?>

<div class="row justify-content-md-center mt-5">
    <div class="col-10">
        <?php if (!isset($_SESSION['user'])) { ?>
            <h3 class="text-center">Please <a class="btn btn-info btn-sm" href="/index/login">Login</a> in order to see this information</h3>
        <?php } else { ?>
            <h3 class="text-center">Filter Applications</h3>
            <table class="table table-hover table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Country</th>
                    <th scope="col">Application Title</th>
                    <th scope="col">Date Ordered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($services ?? [] as $service) {?>
                        <tr>
                            <th scope="row"><?=$service['count']?></th>
                            <td><?=$service['name']?></td>
                            <td><?=$service['country']?></td>
                            <td><?=$service['application_title']?></td>
                            <td><?=$service['date_ordered']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>




<?php include(VIEWS_DIR . 'footer.php'); ?>