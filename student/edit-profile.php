<?php include_once('inc/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <div class="card">
                <form class="form-horizontal" action="" method="POST">
                    <div class="card-body">
                        <?php
                        if(isset($studentdata)){
                            echo $studentdata;
                        }
                        ?>
                        <h4 class="card-title">Personal Info</h4>
                       
                        <div class="mb-3 row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fname" value="<?=$result['sname']?>" name="sname">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Father Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="sfname" class="form-control" id="lname" value="<?=$result['sfname']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">Mother Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="smname" class="form-control" id="lname" value="<?=$result['smname']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" value="<?=$result['email']?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Contact No</label>
                            <div class="col-sm-9">
                                <input type="text" name="contack" class="form-control" value="<?=$result['contack']?>">
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-top">
                        <input type="hidden" name ="sid" value="<?=$result['id']?>">
                        <div class="text-end">
                            <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="editprofile">Save</button>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>