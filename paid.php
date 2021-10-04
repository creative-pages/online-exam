<?php require_once('inc/header.php');?>
<style>
    .bbutton{width:50%}
</style>
<body>
<div class="container">
<br>
<img src="https://res.cloudinary.com/notnns/image/upload/v1620243428/batbio/banner_ngoypz.png" class="rounded mx-auto d-block" width="30%" alt="">
<br><br>
<div class="text-center">
    <?php
       $paidbatch = $common->select("`add_branch`", "`type` = 'paid' ORDER BY `id` DESC");
       if($paidbatch){
           while($value = mysqli_fetch_assoc($paidbatch)){
         
    
    ?>
        <a href="course-details.php?dtls=<?=$value['id'];?>">
        <button type="button" class="btn btn-success bbutton"><?= $value['branch_name'];?></button>
        </a>
        <br><br>
    <?php }}?>
    <a href="./sadhinota/">
    <button type="button" class="btn btn-danger bbutton">স্বাধীনতা ব্যাচ</button>
    </a>
    <br><br>
    <a href="./chemistry1/">
    <button type="button" class="btn btn-primary bbutton">রসায়ন ১ম পত্র ব্যাচ</button>
    </a>
    <br><br>
    <a href="./chemistry2/">
    <button type="button" class="btn btn-warning bbutton">রসায়ন ২য় পত্র ব্যাচ</button>
    </a>
    <br><br>
    <a href="./chemistry2000mcq/">
    <button type="button" class="btn btn-info bbutton">রসায়ন ২০০০ MCQ</button>
    </a>
    <br><br>
    <a href="./english/">
    <button type="button" class="btn btn-success bbutton">HSC Full English</button>
    </a>
    <br><br>
    <a href="./proceshta/">
    <button type="button" class="btn btn-danger bbutton">প্রচেষ্টা ব্যাচ (সেকেন্ড টাইমার)</button>
    </a>
    <br><br>
    <br><br>
</div>
</div>
<br><br>
<script src="https://kit.fontawesome.com/e476222130.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>