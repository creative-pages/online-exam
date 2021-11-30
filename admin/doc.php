<?php

if(isset($_POST['export'])){
    header("Content-Type:application/msword");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=test.docx");
   $doc= $_POST['doc'];
}
echo $doc;
?>


