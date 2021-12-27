<?php include_once('inc/header.php'); ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply_batch'])){
        $main_batch_id = $fm->validation($_POST['main_batch_id']);
        $main_batch_info = $common->select("`add_branch`", "`id` = '$main_batch_id'");
        $main_batch_infos = mysqli_fetch_assoc($main_batch_info);
        if ($main_batch_infos['type'] == 'paid') {
            $status = '0';
        } else {
            $status = '1';
        }
        $main_batch_fee = $main_batch_infos['total_fee'];

        $batch_check = $common->select("`batch_students`", "`student_id` = '$pid' && `batch_id` = '$main_batch_id'");
        if ($batch_check) {
            $new_batch_result = '<div class="alert alert-danger mt-3">This batch already exist!</div>';
        } else {
            $add_to_batch = $common->insert("`batch_students`(`student_id`, `batch_id`, `fee`, `status`)", "('$pid', '$main_batch_id', '$main_batch_fee', '$status')");
            if ($add_to_batch) {
                $new_batch_result = '<div class="alert alert-success mt-3">Batch join successful.</div>';
            } else {
                $new_batch_result = '<div class="alert alert-danger mt-3">Something is wrong!</div>';
            }
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_submit'])){
        $payreq = $all->PaymentRequest($_POST);
    }
    $all_batch = $common->select('`batch_students`', "`student_id` = '$pid'")
?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <h2>All Batches</h2>
            <?php
            if (isset($payreq)) {
                echo '<div class="alert alert-danger">'.$payreq.'</div>';
            }

            if ($all_batch) {
                while ($all_batches = mysqli_fetch_assoc($all_batch)) {
                    $batch_id = $all_batches['batch_id'];
                    $batch_info = $common->select("`add_branch`", "`id` = '$batch_id'");
                    $batch_infos = mysqli_fetch_assoc($batch_info);

                    if ($batch_infos['type'] == 'paid') {
                        // payment request pending
                        $check_payment_request = $common->select("`pay_requests`", "`user_id` = '$pid' && `batch_id` = '$batch_id' && `status` = '0'");

                        // batch inactive
                        if ($all_batches['payment_time'] != NULL) {
                            $date1 = date_create(date("Y-m-d"));
                            $date2 = date_create($all_batches['payment_time']);
                            $diff = date_diff($date1, $date2);
                            $diff_result = $diff->format("%R%a");
                            if (is_numeric(strpos($diff_result, "-"))) {
                                $common->update("`batch_students`", "`status` = '0'", "`batch_id` = '$batch_id'");
                                $batch_status = 'Inactive';
                            } else {
                                $batch_status = $all_batches['status'] == 1 ? 'Active' : 'Inactive';
                            }
                        } else {
                            $batch_status = $all_batches['status'] == 1 ? 'Active' : 'Inactive';
                        }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td class="fw-bold">Batch Name</td>
                                    <td>
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-outline-info btn-block" href="../class.php?cls=<?= $batch_id; ?>">
                                                <?= $batch_infos['branch_name']; ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="fw-bold">Status</td>
                                    <td><?= $batch_status; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Fee</td>
                                    <td><?= $all_batches['fee']; ?>Tk</td>
                                    <td class="fw-bold">Payment Status</td>
                                    <td><?= $all_batches['fee'] <= $all_batches['paid'] ? 'Paid' : 'Unpaid'; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Paid</td>
                                    <td><?= $all_batches['paid'] == NULL ? 0 : $all_batches['paid']; ?>TK</td>
                                    <td class="fw-bold">Unpaid</td>
                                    <td><?= $all_batches['fee'] - $all_batches['paid']; ?>Tk</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Total Stallment</td>
                                    <td>3</td>
                                    <td class="fw-bold">Stallment Status</td>
                                    <td>
                                        <?php
                                        if ($all_batches['stallment'] == NULL) {
                                            echo 'First';
                                        } elseif($all_batches['stallment'] == '1') {
                                            echo 'Second';
                                        } elseif($all_batches['stallment'] == '2') {
                                            echo 'Third';
                                        } elseif($all_batches['stallment'] == '3') {
                                            echo 'End';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php 
                                if ($all_batches['fee'] > $all_batches['paid']) {
                                ?>
                                <tr>
                                    <?php
                                    if ($all_batches['payment_time'] != NULL) {
                                    ?>
                                    <td class="fw-bold">Payment Deadline</td>
                                    <td><span class="bg-danger text-white px-2"><?= date('d M Y', strtotime($all_batches['payment_time'])); ?></span></td>
                                    <?php
                                    } else {
                                    ?>
                                    <td colspan="2"></td>
                                    <?php
                                    }
                                    ?>
                                    <td>Action <?= $check_payment_request ? '(Request Pending)' : ''; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm ms-2" type="button" data-bs-toggle="modal" data-bs-target="#make_payment<?= $batch_id; ?>"<?= $check_payment_request ? ' disabled=""' : ''; ?>>Pay Now</button>
                                        <!-- Modal start -->
                                        <div class="modal fade" id="make_payment<?= $batch_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <table class="table table-bordered mb-0">
                                                    <tr>
                                                        <td class="fw-bold">Batch Name</td>
                                                        <td><?= $batch_infos['branch_name']; ?></td>
                                                        <td class="fw-bold">Stallment</td>
                                                        <td>
                                                            <?php
                                                            if ($all_batches['stallment'] == NULL) {
                                                                echo 'First';
                                                            } elseif($all_batches['stallment'] == '1') {
                                                                echo 'Second';
                                                            } elseif($all_batches['stallment'] == '2') {
                                                                echo 'Third';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Paid</td>
                                                        <td><?= $all_batches['paid'] == NULL ? 0 : $all_batches['paid']; ?> Tk</td>
                                                        <td class="fw-bold">Unpaid</td>
                                                        <td><?= $all_batches['fee'] - $all_batches['paid']; ?> Tk</td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <form action="" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $pid; ?>">
                                                    <input type="hidden" name="batch_id" value="<?= $batch_id; ?>">
                                                    <div class="input-group mb-3 mt-3">
                                                        <input type="text" class="form-control" placeholder="Enter Payment Number" name="pnumber" pattern="[0-9]{11}" aria-label="id" aria-describedby="basic-addon1" required="">
                                                    </div>
                                                    <div class="input-group mb-3 mt-3">
                                                        <input type="text" class="form-control" placeholder="Enter Transaction ID" name="tid" aria-label="id" aria-describedby="basic-addon1" required="">
                                                    </div>
                                                    <div class="input-group mb-3 mt-3">
                                                        <input type="number" class="form-control" placeholder="Enter amount" name="amount" aria-label="id" aria-describedby="basic-addon1" required="">
                                                    </div>
                                                    <div class="input-group mb-3 mt-3">
                                                        <select class="form-control form-select" name="method" required="">
                                                            <option value="bkash">Bkash</option>
                                                            <option value="nogod">Nogod</option>
                                                            <option value="roket">Roket</option>
                                                            <option value="upay">Upay</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                     <button type="submit" class="btn btn-info float-end" name="payment_submit">Submit</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal end -->
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td class="fw-bold">Batch Name</td>
                                    <td>
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-outline-info btn-block" href="../class.php?cls=<?= $batch_id; ?>">
                                                <?= $batch_infos['branch_name']; ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="fw-bold">Batch Type</td>
                                    <td>Free (Active)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                    }
                }
            } else {

            }
            ?>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>