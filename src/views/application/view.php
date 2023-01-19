<?php include(VIEWS_DIR . 'header.php'); ?>

<div class="row justify-content-md-center mt-5">
    <div class="col-10">
        <?php if (!isset($_SESSION['user'])) { ?>
            <h3 class="text-center">Please <a class="btn btn-info btn-sm" href="/index/login"><i class="fa-solid fa-right-to-bracket"></i> Login</a> in order to see this information</h3>
        <?php } else { ?>
            <h3 class="text-center">View Application <?=$application['title'] ?? 'N/A' ?></h3>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Summary</h5><hr>
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <th><?=$application['title']?></th>
                                    <th><?=$application['first_name']?></th>
                                    <td><?=$application['last_name']?></td>
                                    <td><?=$application['gender']?></td>
                                    <th><?=$application['dob']?></th>
                                    <td><?=$application['status']?></td>
                                    <td><?=$application['date_added']?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Status</h5><hr>
                    <div class="progress">
                        <div class="progress-bar <?php if ($application['status_id']==2) { echo 'bg-success'; } elseif ($application['status_id'] == 3) { echo 'bg-danger'; } ?>" style="width:<?php echo $application['status_id'] == 1 ? '33' : '100'; ?>%;" role="progressbar" aria-valuenow="<?=$application['status_id']?>" aria-valuemin="0" aria-valuemax="100"><?=$application['status']?></div>
                    </div>
                </div>
            </div>

            <?php if ($application['status_id'] != 1) { ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Manage Application</h5><hr>
                        <?php if ($application['status_id'] != 1) { ?>
                            <a href="/application/unlock/<?=$application['id']?>" class="btn btn-warning">Unlock Application</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Services</h5><hr>
                        <table class="table table-hover table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Date Ordered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($services ?? [] as $service) {?>
                                    <tr>
                                        <th scope="row"><?=$service['id']?></th>
                                        <td><?=$service['name']?></td>
                                        <td><?=$service['country']?></td>
                                        <td><?=$service['date_ordered']?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            
        <?php } ?>
    </div>
</div>




<?php include(VIEWS_DIR . 'footer.php'); ?>