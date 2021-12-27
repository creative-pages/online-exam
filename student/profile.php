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
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Student Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fname" value="<?=$result['sname']?>" name="sname" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Student Father Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname" value="<?=$result['sfname']?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Student Mother Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname" value="<?=$result['smname']?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="<?=$result['email']?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Contact No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"   value="<?=$result['contack']?>"readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h4 class="card-title">Requirements</h4>
                        
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">SSC RESULT</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname" value="<?=$result['ssc']?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">HSC RESULT</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lname" value="<?=$result['hsc']?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">Medical Student?</label>
                            <div class="col-sm-9">
                                <?= ucfirst($result['ms']); ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">Second Timer?</label>
                            <div class="col-sm-9">
                                <?= ucfirst($result['st']); ?>
                            </div>
                        </div>

                    </div>
                    <div class="p-3 border-top">
                        <div class="text-end">
                            <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="save">Edit</button>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>