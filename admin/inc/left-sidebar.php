<!-- ============================================================== -->
<?php
    $username = Session::get('username');
    if (isset($_GET['action']) && $_GET['action'] =='logout') {
        Session::destroy();
       echo "<script> window.location.assign('index.php'); </script>";
        exit();
    }  

?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                        aria-expanded="false">
                        <span class="hide-menu">Dashboard </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">Exam</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="add-exam.php" aria-expanded="false"><i class="mdi mdi-account-box"></i>
                            <span class="hide-menu">Add Exam</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="publish-exam.php" aria-expanded="false"><i class="mdi mdi-account-box"></i>
                                <span class="hide-menu">Publish Exam</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="add-exam.php" aria-expanded="false"><i class="mdi mdi-account-box"></i>
                                 <span class="hide-menu">Result</span>
                             </a>
                         </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">Class</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="add-branch.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                            class="hide-menu">Add Branch</span></a></li> 
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="add-student.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                            class="hide-menu">Add Student</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="add-subject.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                            class="hide-menu">Add Subject</span></a></li> 
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="add-class.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                            class="hide-menu">Add Class</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pay-request.php" aria-expanded="false"><i class="mdi mdi-comment-processing-outline"></i>
                        <span class="hide-menu">Payment</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="add-quetion.php" aria-expanded="false"><i class="mdi mdi-account-box"></i>
                        <span class="hide-menu">Add Question</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->