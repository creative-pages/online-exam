<footer class="footer-area pt-80  footer-bg p-relative ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="footer-widget mb-50 ">
                        <div class="footer-widget-title">
                            <h3>About Us</h3>
                        </div>
                        <div class="footer-widget-content">
                            <div class="footer-about-area">
                            <?php
                            $web= new Web();
                            $fm = new Format();
                            $showabout =$web->showabout(); 
                            if($showabout){
                                while($val= $showabout->fetch_assoc()){
                               
                            ?>
                                <p><?php echo $fm->textShorten($val['body'],600);?></p>
                               
                                <?php }} ?>
                                <div class="social">
                                    <ul>
                                         <?php
                                        $social = $web->SocialLink();
                                        if ($social) {
                                      
                                       while ($value= $social->fetch_assoc()){
                                      
                                    ?>
                                        <li><a href="<?php echo $value['fb_link'];?>"target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="<?php echo $value['twitter_link'];?>"target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="<?php echo $value['instagram_link'];?>"target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="<?php echo $value['skype_link'];?>"target="_blank"><i class="fab fa-skype"></i></a></li>
                                    <?php }} ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget mb-50 ">
                        <div class="footer-widget-title">
                            <h3>Quick link</h3>
                        </div>
                        <div class="footer-widget-content">
                            <div class="footer-explorework-area">
                                <ul>
                                    <?php
                                        $explorelist = $web->AllExplore();
                                        if ($explorelist) {
                                      
                                       while ($value= $explorelist->fetch_assoc()){
                                      
                                    ?>
                                    <li><a href="<?php echo $value['link'];?>"><?php echo $value['name'];?></a></li>
                                  <?php }}?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget mb-50 ">
                        <div class="footer-widget-title">
                            <h3>Address</h3>
                        </div>
                        <div class="footer-widget-content">
                            <div class="footer-touch-area">
                                <ul>
                                <?php
                                $keep = $web->ViewKeep();
                                if ($keep){
                                    while ($val=$keep->fetch_assoc()){
                                   
                                ?>
                                    <li><a href="#"><i class="far fa-clock"></i> <?php echo $val['name'];?></a></li>
                                    <li><a href="#"><i class="fas fa-map-marker-alt"></i><?php echo $val['location'];?></a></li>
                                    <li><a href="#"><i class="fas fa-phone"></i> <?php echo $val['contack_one'];?></a></li>
                                    <li><a href="#"><i class="far fa-envelope"></i><?php echo $val['email'];?></a></li>
                                    <li><a href="#"><i class="fas fa-phone"></i> <?php echo $val['contack_two'];?> </a></li>
                                    <?php }} ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-8 pr-30">
                    <div class="footer-widget mb-50 ">
                        <div class="footer-widget-title">
                            <h3>GALLERY</h3>
                        </div>
                        <div class="footer-widget-content">
                            <div class="footer-instafeed-area">
                                <?php
                                                         $gallarylist = $web->AllGallary();
                                                         if ($gallarylist) {
                                                             $id=0;
                                                             while ($value= $gallarylist->fetch_assoc()){
                                                                 $id++;                                                                  
                                                        
                                                    ?>
                                <div class="instafeed">
                                    <a href="<?php echo $value['link'];?>"><img src="admin/<?php echo $value['img'];?>" alt=""style="height: 50px;"></a>
                                </div>

                                <?php }} ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-copyright-text text-center" style="border: 1px solid #2d2e2e;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         <?php
                        $allheader =$web->AllHead();
                        if ($allheader){
                            while ($val= $allheader->fetch_assoc()){
                        
                        ?>
                        <p><?php echo $val['copyright']; ?></p>
                    <?php }} ?>
                    </div>
                </div>
            </div>
        </div>

    </footer>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60c648c97f4b000ac037633c/1f838oltb';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>