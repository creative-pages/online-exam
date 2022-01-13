<?php include_once('inc/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <h2>All Result</h2>
            <div class="card">
                <div class="card-body">
                    <label for="select_batch" class="form-label">Select Batch<sup class="text-danger">*</sup></label>
                    <select id="select_batch" class="form-control">
                        <option value="">Choose batch</option>
                        <?php
                        $main_batch = $common->select("`batch_students`", "`student_id` = '$pid'");
                        if ($main_batch) {
                            while ($main_batches = mysqli_fetch_assoc($main_batch)) {
                                // batch_info
                                $batch_id = $main_batches['batch_id'];
                                $batch_info = $common->select("`add_branch`", "`id` = '$batch_id'");
                                $batch_infos = mysqli_fetch_assoc($batch_info);
                            ?>
                                <option value="<?= $batch_id; ?>"><?= $batch_infos['branch_name']; ?></option>
                            <?php
                            }
                        } else {
                            echo '<h2 class="text-center">No batch found!</h2>';
                        }
                        ?>
                    </select>

                    <label for="select_exam" class="form-label mt-3">Select Exam<sup class="text-danger">*</sup></label>
                    <select id="select_exam" class="form-control">
                        <option value="">Choose exam</option>
                    </select>
                </div>
            </div>
            <div class="card">
                <div id="all_exam" class="card-body">
                    <h4 class="text-danger mb-0">Please select batch then select exam to see your result.</h4>
                </div>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>