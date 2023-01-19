<?php include(VIEWS_DIR . 'header.php'); ?>

<div class="row justify-content-md-center mt-5">
    <div class="col-10">
        <?php if (!isset($_SESSION['user'])) { ?>
            <h3 class="text-center">Please <a class="btn btn-info btn-sm" href="/index/login">Login</a> in order to see this information</h3>
        <?php } else { ?>
            <h3 class="text-center"><?php echo $is_add ? 'Add' : 'Edit'; ?> Application</h3>
            <form action="<?=$is_add ? '/application/add' : '/application/edit/' . $application['id']?>" method="post">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Summary</h5>
                        <div class="mb-1">
                            <label for="title" class="form-label">Application Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="<?=$application['title'] ?? ''?>">
                        </div>
                        <div class="mb-1">
                            <label for="first_name" class="form-label">Firstname</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" value="<?=$application['first_name'] ?? ''?>">
                        </div>
                        <div class="mb-1">
                            <label for="last_name" class="form-label">Lastname</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" value="<?=$application['last_name'] ?? ''?>">
                        </div>
                        <div class="mb-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="M" <?php echo $application['gender'] == 'Male' ? 'checked' : '';?>>
                                <label class="form-check-label" for="gender_male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="F" <?php echo $application['gender'] == 'Female' ? 'checked' : '';?>>
                                <label class="form-check-label" for="gender_female">
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="dob" class="form-label">Date Of Birth</label>
                            <input id="dob" name="dob" class="form-control" type="date" value="<?=$application['dob'] ?? ''?>"/>
                        </div>
                    </div>
                </div>

                <?php if (!$is_add) { ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Status</h5>
                            <div class="progress">
                                <div class="progress-bar <?php if ($application['status_id']==2) { echo 'bg-success'; } elseif ($application['status_id'] == 3) { echo 'bg-danger'; } ?>" style="width:<?php echo $application['status_id'] == 1 ? '33' : '100'; ?>%;" role="progressbar" aria-valuenow="<?=$application['status_id']?>" aria-valuemin="0" aria-valuemax="100"><?=$application['status']?></div>
                            </div>
                        </div>
                    </div>

                    <?php if ($application['status_id'] == 1) { ?>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Manage Application</h5>
                                <a href="/application/close/<?=$application['id']?>" class="btn btn-info">Close Application</a>
                                <a href="/application/cancel/<?=$application['id']?>" class="btn btn-danger">Cancel Application</a>
                                
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Services</h5>

                        <select name="services[]" class="form-select" size="5" multiple aria-label="multiple select example">
                            <?php foreach($services ?? [] as $service) {?>
                                <option id="<?=$service['id']?>" name="<?=$service['id']?>"<?=isset($application['services'][$service['id']]) ? 'selected' : ''?>><?=$service['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="mt-3 btn btn-success"><?=$is_add ? 'Add' : 'Save'?> Application</button>
            </form>
        <?php } ?>
    </div>
</div>




<?php include(VIEWS_DIR . 'footer.php'); ?>