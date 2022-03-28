<div class="col-lg-4 order-lg-2">
    <h2>User</h2>
    <div class="card rounded mb-3">
        <div class="row">
            <div class="col-12 mx-2 text-center p-3 mb-0">
                <img style="height:100px; width:100px;" class="" src="../image/sprofile.jpg">
                <p class="mt-3 mb-1" style="color:green"><?= $result['name']; ?></p>
                <p class="mt-0 mb-1" style="color:green">ID: <?= $result['id']; ?></p>
                <a href="profile.php" class="btn btn-info">Profile</a>
            </div>
        </div>
        <div class="p-3 text-center">
            <a href="batch.php" class="btn btn-primary btn-sm mx-1 mb-1">Payments Status</a>
            <a href="batch.php?weekly" class="btn btn-primary btn-sm mx-1 mb-1">Weekly Status</a>
            <a href="batch.php?lend" class="btn btn-primary btn-sm mx-1 mb-1">Lend</a>
            <a href="batch.php?borrow" class="btn btn-primary btn-sm mx-1 mb-1">Borrow</a>
            <a href="?action=logout" class="btn btn-primary btn-sm mx-1 mb-1">Logout</a>
        </div>
    </div>
</div>