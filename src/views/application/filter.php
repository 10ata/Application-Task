<?php include(VIEWS_DIR . 'header.php'); ?>

<div class="row justify-content-md-center mt-5">
    <div class="col-10">
        <?php if (!isset($_SESSION['user'])) { ?>
            <h3 class="text-center">Please <a class="btn btn-info btn-sm" href="/index/login"><i class="fa-solid fa-right-to-bracket"></i> Login</a> in order to see this information</h3>
        <?php } else { ?>
            <h3><i class="fa-solid fa-filter"></i>Filter Applications
                <a class="mb-3 float-end btn btn-success" href="/application/add"><i class="fa-solid fa-file-circle-plus"></i> Add new Application<a>
            </h3>
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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($applications ?? [] as $application) {?>
                        <tr>
                            <th><?=$application['title']?></th>
                            <th><?=$application['first_name']?></th>
                            <td><?=$application['last_name']?></td>
                            <td><?=$application['gender']?></td>
                            <th><?=$application['dob']?></th>
                            <td><?=$application['status']?></td>
                            <td><?=$application['date_added']?></td>
                            <td>
                                <?php if ($application['status'] == 'Open') { ?>
                                    <a class="btn btn-warning btn-sm" href="/application/edit/<?=$application['id']?>"><i class="fa-regular fa-pen-to-square"></i> Edit<a>
                                <?php } ?>
                                <a class="btn btn-info btn-sm" href="/application/view/<?=$application['id']?>"><i class="fa-regular fa-eye"></i> View<a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>




<?php include(VIEWS_DIR . 'footer.php'); ?>