<?php include('inc/header.php'); ?>
<?php
    if(isset($_GET['view'])){
        $id = $_GET['view'];
       $query = $common->select("`add_exam`","`id`='$id'");
       $exam = mysqli_fetch_assoc($query);
    }
?>

<body>
    <!-- -------------------------------------------------------------- -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- -------------------------------------------------------------- -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#1e88e5" stroke-width="2"></path>
          <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#1e88e5" stroke-width="2"></path>
          <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
          <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
          <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- -------------------------------------------------------------- -->
    <div id="main-wrapper">
        <!-- -------------------------------------------------------------- -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- -------------------------------------------------------------- -->
        <?php include('inc/topbar.php'); ?>
        <!-- -------------------------------------------------------------- -->
        <!-- End Topbar header -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- -------------------------------------------------------------- -->
        <?php include('inc/left-sidebar.php'); ?>
        <!-- -------------------------------------------------------------- -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- -------------------------------------------------------------- -->
            <!-- Container fluid  -->
            <!-- -------------------------------------------------------------- -->
            <div class="container-fluid">
                <div id="exportContent">
                    <div class="quetion" style="max-width: 900px; margin:0px auto;">
                        <div class="main bg-white mb-2 py-2">
                            <div class="examheader text-center mt-2">
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
                   
                       
                        <button onclick="Export2Doc('exportContent', 'test');" class="btn btn-info sm">Export Doc</button>

                   
                </div>
            </div>
            <!-- Share Modal -->
            <div class="modal fade" id="Sharemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-auto-fix me-2"></i>
                                    Share With</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info"><i
                                            class="ti-user text-white"></i></button>
                                    <input type="text" class="form-control" placeholder="Enter Name Here"
                                        aria-label="Username">
                                </div>
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <a href="#Whatsapp" class="text-success">
                                            <i class="display-6 mdi mdi-whatsapp"></i><br><span
                                                class="text-muted">Whatsapp</span>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#Facebook" class="text-info">
                                            <i class="display-6 mdi mdi-facebook"></i><br><span
                                                class="text-muted">Facebook</span>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#Instagram" class="text-danger">
                                            <i class="display-6 mdi mdi-instagram"></i><br><span
                                                class="text-muted">Instagram</span>
                                        </a>
                                    </div>
                                    <div class="col-3 text-center">
                                        <a href="#Skype" class="text-cyan">
                                            <i class="display-6 mdi mdi-skype"></i><br><span
                                                class="text-muted">Skype</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i>
                                    Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End Container fluid  -->
            <!-- -------------------------------------------------------------- -->
            <!-- -------------------------------------------------------------- -->
            <!-- footer -->
            <!-- -------------------------------------------------------------- -->
            <?php include('inc/footer.php'); ?>
            <!-- -------------------------------------------------------------- -->
            <!-- End footer -->
            <!-- -------------------------------------------------------------- -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End Wrapper -->
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