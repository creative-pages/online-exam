<?php include_once('inc/header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['omr_upload_submit'])) {
    $exam_id = $fm->validation($_POST['exam_id']);

    $permited  = array('jpg', 'jpeg', 'png');
    if (isset($_FILES['omr_upload'])) {
        $file_name = $_FILES['omr_upload']['name'];
        $file_temp = $_FILES['omr_upload']['tmp_name'];
    } else {
        $file_name = '';
    }

    $file_exp = explode('.', $file_name);
    $file_ext = strtolower(end($file_exp));
    $unique_image = time().'.'.$file_ext;

    if (empty($file_name) || in_array($file_ext, $permited) === false) {
        $error = '<div class="alert alert-danger ms-3">Something is wrong!</div>';
    } else {
        $upload_success = $common->insert("`omr_upload`(`student_id`, `exam_id`, `file`)", "('$pid', '$exam_id', '$unique_image')");
        if ($upload_success) {
            move_uploaded_file($file_temp, '../upload_file/omr_sheet/' . $unique_image);
            $error = '<div class="alert alert-success ms-3">File upload successfull!</div>';
        } else {
            $error = '<div class="alert alert-danger ms-3">Something is wrong2!</div>';
        }
    }
}
?>

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
                <?= isset($error) ? $error : ''; ?>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>