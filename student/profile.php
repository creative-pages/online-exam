<?php include_once('inc/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <div class="card">
                <form class="form-horizontal" action="" >
                    <div class="card-body">
                        <h4 class="card-title">Personal Info</h4>
                       
                        <div class="mb-3 row">
                            <label for="fname" class="col-sm-3  control-label col-form-label">Name :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['name']); ?></h4>
                            </div>
                        </div>
                         <div class="mb-3 row">
                            <label for="fname" class="col-sm-3  control-label col-form-label">ID :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['id']); ?></h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email1" class="col-sm-3  control-label col-form-label">Email :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['email']); ?> </h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cono1" class="col-sm-3  control-label col-form-label">Contact No :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['contack']); ?></h4>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>