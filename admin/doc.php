<?php
    require_once '../init.php';
    Session::checkAdminSession();
    $exam = new Exam();
    $common = new Common();
    $all = new All();
    $fm = new Format();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
    <meta name=Generator content="microsoft Word 14 (filtered)">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template">
    <meta name="description" content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title>BatBio</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Favicon icon -->
    <link href="assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/libs/apexcharts/dist/apexcharts.css">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
     <!-- Data table plugin CSS -->
     <link href="assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
      <!-- Card Page CSS -->
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/prism/prism.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="highlights/highlight.min.css">
    <!-- search option in select option start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- search option in select option end -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        .select2-container {
            z-index: 99999;
        }
    </style>

<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="microsoft Word 14 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.msoNormal, li.msoNormal, div.msoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.msoAcetate, li.msoAcetate, div.msoAcetate
	{mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";}
.msoChpDefault
	{font-family:"Calibri","sans-serif";}
.msoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:13.0in 8.5in;
	margin:48.25pt .5in .5in .75in;}
div.WordSection1
	{page:WordSection1;}
-->
</style>
</head>
<?php
    if(isset($_GET['view'])){
        $id = $_GET['view'];
       $query = $common->select("`add_exam`","`id`='$id'");
       $exam = mysqli_fetch_assoc($query);
    }
?>

<body>
    <div class="page-wrapper">
           <div class="container-fluid">
                <div class="WordSection1">
                <div id="exportContent">
                    <div class="quetion" style="max-width: 900px; margin:0px auto;">
                        <div class="main bg-white mb-2 py-2">
                            <div class="examheader msoNormal align=center text-center mt-2">
                                <h3 class="text-uppercase"><?=$exam['examname'];?></h1>
                                <h3 class="text-capitalize mb-3">Subject: <?= $exam['subjectname']; ?></h3>
                            </div>
                            <div class="row mx-1">
                                <div class="col-4">
                                    <h3 class="text-muted">Time: <?=$exam['duration'];?> minutes</h3>
                                </div>
                                <div class="col-4">
                                    <h3 class="text-muted">Quetion: <?=$exam['tquetion'];?></h3>
                                </div>
                                <div class="col-4">
                                    <h3 class="text-muted">Date: <?=$exam['exmdate'];?></h3>
                                </div>
                            </div>  
                            
                        </div>
                        
                    <?php
                    $select = $common->select("`questions`","`exam_id` = '$id' ORDER BY `serial`");
                    if($select){
                        
                        while($viewquetion = mysqli_fetch_assoc($select)){
                        
                    ?>
                        <div class="quetion mb-2 bg-white pt-3">
                            <div class="row mx-2">
                                <div class="col-12 d-flex">
                                    <span><b><?=$viewquetion['serial'];?>. &nbsp;</b></span>
                                    <div><?=$viewquetion['question'];?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">
                                    <?php
                                    if($viewquetion['answer'] == 'option_one') {
                                    ?>
                                    <img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">
                                    <?php
                                    }
                                    ?>
                                    <div class="px-1">a)</div>
                                    <div><?=$viewquetion['option_one'];?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">
                                    <?php
                                    if($viewquetion['answer'] == 'option_two') {
                                    ?>
                                    <img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">
                                    <?php
                                    }
                                    ?>
                                    <div class="px-1">b)</div>
                                    <div><?=$viewquetion['option_two'];?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">
                                    <?php
                                    if($viewquetion['answer'] == 'option_three') {
                                    ?>
                                    <img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">
                                    <?php
                                    }
                                    ?>
                                    <div class="px-1">c)</div>
                                    <div><?=$viewquetion['option_three'];?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">
                                    <?php
                                    if($viewquetion['answer'] == 'option_four') {
                                    ?>
                                    <img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">
                                    <?php
                                    }
                                    ?>
                                    <div class="px-1">d)</div>
                                    <div><?=$viewquetion['option_four'];?></div>
                                </div>
                                <?php
                                if($viewquetion['description'] != '') {
                                ?>
                                <div class="col-12 border border-info mb-3 p-1">
                                <?= $viewquetion['description']; ?>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php }}?>

                    </div>
                </div>
                
           
                <div class="text-center">
                    <a href="doc.php" class="btn btn-info sm">Export Doc</a>
                </div>
                </div    
            </div>
             <?php include('inc/footer.php'); ?>
           
    <div class="chat-windows"></div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Jquery -->
    <!-- -------------------------------------------------------------- -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/app.init.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
   <script src="dist/js/feather.min.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="dist/js/pages/contact/contact.js"></script>
    <script>
        function Export2Doc(element, filename = ''){
        var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
        var postHtml = "</body></html>";
        var html = preHtml+document.getElementById(element).innerHTML+postHtml;

        var blob = new Blob(['\ufeff', html],{
            type: 'application/msword'
        });

        var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html)

        filename = filename?filename+'.doc': 'document.doc';

        var downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            navigator.msSaveOrOpenBlob(blob, filename);
        }else{
            downloadLink.href = url;

            downloadLink.download = filename;

            downloadLink.click();
        }

        document.body.removeChild(downloadLink);


     }

    </script>
</body>

</html>