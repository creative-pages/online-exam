<div class="col-lg-4 order-lg-2">
    <h2>User</h2>
    <div class="card rounded mb-3">
        <div class="row">
            <div class="col-12 mx-2 text-center p-3">
                <img style="height:100px; width:100px;" class="" src="../image/sprofile.jpg">
                <p class="mt-3" style="color:green"><?= $result['sname']; ?></p>
                <a href="profile.php" class="btn btn-info">Profile</a>
            </div>
        </div>
        <div class="p-3">
            <a href="../index.php" class="btn btn-primary btn-sm mx-1">Home</a>
            <a href="batch.php" class="btn btn-primary btn-sm mx-1">Batch</a>
            <a href="?action=logout" class="btn btn-primary btn-sm mx-1">Logout</a>
        </div>
    </div>
    <?php
    if ($page_url == 'batch.php') {
    ?>
    <div class="card rounded mb-3 p-3">
        <h2 class="text-center mb-3">Join another batch</h2>
        <form action="batch.php" method="POST">
        <?php
        $main_batch = $common->select("`add_branch` ORDER BY `id` DESC");
        if ($main_batch) {
            ?>
            <select name="main_batch_id" class="form-control" required="">
                <option value="">Choose your batch</option>
            <?php
            while ($main_batches = mysqli_fetch_assoc($main_batch)) {
            ?>
                <option value="<?= $main_batches['id']; ?>"><?= $main_batches['branch_name'] . ' (' . ucfirst($main_batches['type']) . ')'; ?></option>
            <?php
            }
            ?>
            </select>
            <button class="btn btn-primary btn-sm mt-3 float-end" type="submit" name="apply_batch">Apply this batch</button>
            <?php
        } else {
            echo '<h2 class="text-center">No batch found!</h2>';
        }
        ?>
        </form>
        <?= isset($new_batch_result) ? $new_batch_result : ''; ?>
    </div>
    <?php
    }
    ?>
</div>