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
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['sname']); ?></h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Father Name :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"> <?= ucfirst($result['sfname']); ?></h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Mother Name :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['smname']); ?> </h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">Email :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['email']); ?> </h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Contact No :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['contack']); ?></h4>
                            </div>
                        </div>
                    </div>
                    <?php
                     $ms = $result['ms'];
                     if($ms == "yes"){
                    ?>
                    <hr>
                    <div class="card-body">
                        <h4 class="card-title">Requirements</h4>
                        
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">SSC RESULT :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['ssc']); ?></h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">HSC RESULT :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['hsc']); ?></h4>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">Medical Student? :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                                <h4 class="fw-light"><?= ucfirst($result['ms']); ?></h4>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">Second Timer? :</label>
                            <div class="col-sm-9" style = "margin-top: 7px;">
                            <h4 class="fw-light"><?= ucfirst($result['st']); ?></h4>
                            </div>
                        </div>

                    </div>
                    <?php } ?>
                    <div class="p-3 border-top">
                        <div class="text-end">
                            <a href="edit-profile.php" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="save">Edit</a>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>