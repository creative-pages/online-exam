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
                <!-- User profile -->
                <div class="user-profile position-relative" style="background: url(assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="assets/images/users/profile.png" alt="user" class="w-100" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text pt-1 dropdown"> 
                        <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><?= $username ?></a>
                        <div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink"> 
                            <a class="dropdown-item" href="#"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My
                                    Profile</a>
                                <a class="dropdown-item" href="#"><i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="#"><i data-feather="mail" class="feather-sm text-success me-1 ms-1"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
                                    Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?action=logout"><i data-feather="log-out"
                                        class="feather-sm text-danger me-1 ms-1"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="ps-4 p-2"><a href="#"
                                        class="btn d-block w-100 btn-info rounded-pill">View Profile</a></div>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
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
                                    href="add-exam.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                                        class="hide-menu">Add Exam</span></a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="publish-exam.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                                    class="hide-menu">Publish Exam</span></a></li> 
                                    
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                 href="add-exam.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                                    class="hide-menu">Result</span></a></li>     


                            </ul>   

                        </li> 

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                    aria-expanded="false">
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

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="app-chats.html" aria-expanded="false"><i class="mdi mdi-comment-processing-outline"></i><span
                                    class="hide-menu">Chat Apps</span></a></li>
                                   
                        
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="add-quetion.php" aria-expanded="false"><i class="mdi mdi-account-box"></i><span
                                    class="hide-menu">Add Question</span></a></li>                          
                        
                        </li>
                                                 
                        
                        </li>
                                                  
                        
                        </li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Extra</span></li>
                       
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->