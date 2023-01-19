<?php include(VIEWS_DIR . 'header.php'); ?>

<div class="row justify-content-md-center mt-5">
    <div class="col-10">
        <h3 class="text-center"><i class="fa-solid fa-square-poll-vertical"></i> Top 3 Service Orders Trend for the past 7 days</h3>
        <table class="table table-hover table-striped">
            <thead class="bg-dark text-white">
                <tr>
                <th scope="col">Count</th>
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
    </div>
</div>




<?php include(VIEWS_DIR . 'footer.php'); ?>