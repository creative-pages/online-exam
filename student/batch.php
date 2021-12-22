<?php include_once('inc/header.php'); ?>

<?php
    $all_batch = $common->select('`batch_students`', "`student_id` = '$pid'")
?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <h2>All Batches</h2>
            <?php
            if ($all_batch) {
                while ($all_batches = mysqli_fetch_assoc($all_batch)) {
                    $batch_id = $all_batches['batch_id'];
                    $batch_info = $common->select("`add_branch`", "`id` = '$batch_id'");
                    $batch_infos = mysqli_fetch_assoc($batch_info);
                ?>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <td class="fw-bold">Batch Name</td>
                                <td><?= $batch_infos['branch_name']; ?></td>
                                <td class="fw-bold">Status</td>
                                <td><?= $all_batches['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Fee</td>
                                <td><?= $all_batches['fee']; ?>TK</td>
                                <td class="fw-bold">Payment Status</td>
                                <td><?= $all_batches['fee'] <= $all_batches['paid'] ? 'Paid' : 'Unpaid'; ?></td>
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
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php 
                            if ($all_batches['fee'] > $all_batches['paid']) {
                            ?>
                            <tr>
                                <td colspan="2"></td>
                                <td>Action</td>
                                <td>
                                    <button class="btn btn-primary btn-sm ms-2" type="button" data-bs-toggle="modal" data-bs-target="#make_payment">Pay Now</button>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <?php
                }
            } else {

            }
            ?>
        </div>
    </div> 
</div>

<!-- Modal -->
<div class="modal fade" id="make_payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('inc/footer.php'); ?>