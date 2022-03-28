<?php include_once('inc/header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <h2>All Information</h2>
            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td><b>Total Income<br><?=$total_amount;?> TK</br></b></td>
                            <td><b>Total Lend<br><?=$total_lend;?> TK</br></b></td>
                            <td><b>Total Borrow<br><?=$total_borrow;?></br></b></td>
                            <td><b>Total Paid<br><?=$total_pay;?> TK</br></b></td>
                            <td><b><?php if($total_unpaid>0){?>Total Unpaid<?php } else { ?>Total Due <?php }?><br><?=$total_unpaid;?> TK</br></b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="table-responsive">
                <?php 
                if(isset($_GET['borrow'])){
                ?>
                <div class="col-md-12 text-center btn btn-info   mb-1">Borrow Status</div>
                <table class="table table-bordered search-table v-middle">
                    <thead class="header-item">
                        <th>Sl No</th>
                        <th>Borrow Date</th>
                        <th>Borrow Amount</th>
                    </thead>
                    <tbody>
                        <tr class="search-items">
                        <?php
                            $result = $common->select("`payments`","`user_id`='$pid' AND `type`='borrow' ORDER BY `id` DESC");
                            if($result){
                                $i=1;
                                while($value = mysqli_fetch_assoc($result)){
                        ?>
                            <td>
                                <span class="usr-email-addr"><?=$i;?></span>
                            </td>
                            <td>
                                <span class="usr-ph-no">
                                     <?=$fm->formatDate($value['created_on']);?>
                                </span>
                                </a>
                            </td>
                           <td>
                             <span class="usr-ph-no">
                               <?=$value['borrow'];?> Taka
                             </span>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }}?>
                    </tbody>
                </table>
                
                <?php } elseif(isset($_GET['lend'])){?>
                <div class="col-md-12 text-center btn btn-info   mb-1">Lend Status</div>
                <table class="table table-bordered search-table v-middle">
                    <thead class="header-item">
                        <th>Sl No</th>
                        <th>Lend Date</th>
                        <th>Lend Amount</th>
                    </thead>
                    <tbody>
                        <tr class="search-items">
                        <?php
                            $result = $common->select("`payments`","`user_id`='$pid' AND `type`='lend' ORDER BY `id` DESC");
                            if($result){
                                $i=1;
                                while($value = mysqli_fetch_assoc($result)){
                        ?>
                            <td>
                                <span class="usr-email-addr"><?=$i;?></span>
                            </td>
                            <td>
                                <span class="usr-ph-no">
                                   <?=$fm->formatDate($value['created_on']);?>
                                </span>
                                </a>
                            </td>
                           <td>
                             <span class="usr-ph-no">
                               <?=$value['lend'];?> Taka
                             </span>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }}?>
                    </tbody>
                </table>
                <?php }elseif(isset($_GET['weekly'])){?>
                <div class="col-md-12 text-center btn btn-info   mb-1">Weekly Status</div>
                <table class="table table-bordered search-table v-middle">
                    <thead class="header-item">
                        <th>Sl No</th>
                        <th>Payout Date</th>
                        <th>Amount(USD)</th>
                        <th>User Amount(Taka)</th>
                    </thead>
                    <tbody>
                        <tr class="search-items">
                        <?php
                            $result = $common->select("`weekly_status`","`user_id`='$pid' ORDER BY `id` DESC");
                            if($result){
                                $i=1;
                                while($value = mysqli_fetch_assoc($result)){
                        ?>
                            <td>
                                <span class="usr-email-addr"><?=$i;?></span>
                            </td>
                            <td>
                                <span class="usr-ph-no">
                                    <?=$value['payout'];?>
                                </span>
                                </a>
                            </td>
                           <td>
                             <span class="usr-ph-no">
                               <?=$value['up_amounts'];?> USD
                             </span>
                            </td>
                            <td>
                             <span class="usr-ph-no">
                               <?=$value['user_amounts'];?> Taka
                             </span>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }}?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <table class="table table-bordered search-table v-middle">
                    <div class="col-md-12 text-center btn btn-success   mb-1">Payments Status</div>
                    <thead class="header-item">
                        <th>Sl No</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </thead>
                    <tbody>
                        <tr class="search-items">
                        <?php
                            $result = $common->select("`payments`","`user_id`='$pid' AND `type`='payments' ORDER BY `id` DESC");
                            if($result){
                                $i=1;
                                while($value = mysqli_fetch_assoc($result)){
                        ?>
                            <td>
                                <span class="usr-email-addr"><?=$i;?></span>
                            </td>
                            <td>
                                <span class="usr-ph-no">
                                    <?=$fm->formatDate($value['created_on']);?>
                                </span>
                                </a>
                            </td>
                           <td>
                             <span class="usr-ph-no">
                               <?=$value['amounts'];?>
                             </span>
                            </td>
                            <td>
                                <span class="usr-ph-no">
                                <?=$value['description'];?>
                                </span>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        }}?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>