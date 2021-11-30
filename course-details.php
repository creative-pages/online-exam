<?php
require_once 'init.php';
$all = new All();
$exam = new Exam();
$common = new Common();


?>
<?php
    
if(isset($_GET['dtls'])){
    $bid = $_GET['dtls'];
    $sub = $common->select("`subject_add`","`batch_id`='id'");
}

?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <style>
        .iconStyle{height:30px}.toHide{-webkit-filter:grayscale(100%);filter:grayscale(100%)}
    </style>
<title>বিজয় ব্যাচ</title>
<link rel="shortcut icon" href="https://res.cloudinary.com/notnns/image/upload/v1620906762/batbio/icons/android-chrome-192x192_tdhkst.png" type="image/x-icon">
<meta charset="windows-1252">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<link rel="shortcut icon" href="https://res.cloudinary.com/notnns/image/upload/v1620906762/batbio/icons/android-chrome-192x192_tdhkst.png" type="image/x-icon">
</head>
<body class="container">
<img src="https://res.cloudinary.com/notnns/image/upload/c_scale,w_2050/v1620907571/batbio/Bijoy_Banner_npyo85.png" width="75%" class="rounded mx-auto d-block">
<br><br>


<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
    
    
<li class="nav-item" role="presentation">

<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"></button>
</li>

<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">জুলোজি</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">রসায়ন ১ম পত্র</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-chemistry2" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">রসায়ন ২য় পত্র</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-physics1" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">পদার্থবিজ্ঞান ১ম পত্র</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-physics2" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">পদার্থবিজ্ঞান ২য় পত্র</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-english1" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">ইংরেজি ১ম পত্র</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-english2" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">ইংরেজি ২য় পত্র</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-gkeng" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">সাধারণ জ্ঞান </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-monthly" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">মেগা/মান্থলি এক্সাম</button>
</li>
</ul>
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<table id="botany" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<table id="zoology" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="chemistry1" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-chemistry2" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="chemistry2" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-physics1" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="physics1" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-physics2" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="physics2" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-gkeng" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="gkeng" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-english1" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="english1" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-english2" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="english2" class="table table-hover" align="center">
<tr class="table-info">
<th class="">অধ্যায়</th>
<th class="">টপিক</th>
<th class="">ক্লাস</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
<div class="tab-pane fade" id="pills-monthly" role="tabpanel" aria-labelledby="pills-contact-tab">
<table id="monthly" class="table table-hover" align="center">
<tr class="table-info">
<th class="">পরীক্ষা নং</th>
<th class="">টপিক</th>
<th class="">সলভ</th>
<th class="">পরীক্ষা</th>
<th class="">নোট</th>
</tr>
</table>
</div>
</div>
<!-- <script src="./botany.js"></script>
<script src="./zoology.js"></script>
<script src="./chemistry1.js"></script>
<script src="./chemistry2.js"></script>
<script src="./physics1.js"></script>
<script src="./physics2.js"></script>
<script src="./gkeng.js"></script>
<script src="./english1.js"></script>
<script src="./english2.js"></script>
<script src="./monthly.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>