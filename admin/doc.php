<?php

date_default_timezone_set('Asia/Dhaka');  

$currentdate = date("y-m-d");
$currentTime = date("g:i:s a");
$docname = "records_" . $currentdate . ".doc";
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$docname");
?>
<html>
<head>
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
<?php include('inc/header.php'); ?>

<?php error_reporting(0)?>
</head>

<body lang=EN-US>
    <div class="container">
        <div class=WordSection1>
            <p class=msoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;margin-top:0.1in;margin-bottom:.0002pt;
            text-align:center;line-height:normal'><strong><span style='font-size:23.0pt;
            font-family:"Times New Roman","serif"'>Text Exam</span></strong></p>

            <p class=msoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;margin-top:0.0in;margin-bottom:.0002pt;
            text-align:center;line-height:normal'><strong><span style='font-size:16.0pt;
            font-family:"Times New Roman","serif"'>Sub:Bangla</span></strong></p>

            <hr>
            
        </div>
        <?php
            $select = $common->select("`questions`","`exam_id` = '9' ORDER BY `serial`");
            if($select){
                
                while($viewquetion = mysqli_fetch_assoc($select)){
                
            ?>
        <table class=msoTableGrid cellspacing=0 cellpadding=0
        style='margin-buttom:0.1pt;border-collapse:collapse;border:none;;
        mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
        <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:23.25pt'>
        <td style='mso-background-themecolor:background1;
            mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:23.25pt'>
            <p class=msoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
            normal'><strong ><span style='font-size:25.06pt;font-family:"Times New Roman","serif"'><?=$viewquetion['serial']?>. <o:p></o:p></span><span style='font-size:25.06pt;font-family:"Times New Roman","serif"'><?=$viewquetion['question']?> <o:p></o:p></span></strong></p>
            </td>
        </tr>
        <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:23.25pt'>
            <td width=288 style='width:240.9pt;'mso-background-themecolor:background1;
            mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:23.25pt'>
                <p class=msoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
                normal'><b style='mso-bidi-font-weight:normal'>
                
                <?php
                if($viewquetion['answer'] == 'option_one') {
                ?>
                
                <span style='margin-buttom:0.1pt;
                font-family:"Times New Roman","serif"'><img width=25 height=25 id="Picture 1"
                src="C:\xampp\htdocs\online-exam\admin\assets\images/img/ok_check_done-512.webp"></span>
                <?php }?>
                <span style='font-size:18.00pt;font-family:"Times New Roman","serif"'>a) <?=$viewquetion['option_one'];?><o:p></o:p></span></b></p>
            </td>
            <td width=288 style='width:240.9pt;'mso-background-themecolor:background1;
            mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:23.25pt'>
                <p class=msoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
                normal'><b style='mso-bidi-font-weight:normal'>
                
                <?php
                if($viewquetion['answer'] == 'option_two') {
                ?>
                
                <span style='margin-buttom:0.1pt;
                font-family:"Times New Roman","serif"'><img width=25 height=25 id="Picture 1"
                src="C:\xampp\htdocs\online-exam\admin\assets\images/img/ok_check_done-512.webp"></span>
                <?php }?>
                <span style='font-size:18.00pt;font-family:"Times New Roman","serif"'>b) <?=$viewquetion['option_two'];?><o:p></o:p></span></b></p>
            </td>
            <td width=288 style='width:240.9pt;'mso-background-themecolor:background1;
            mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:23.25pt'>
                <p class=msoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
                normal'><b style='mso-bidi-font-weight:normal'>
                
                <?php
                if($viewquetion['answer'] == 'option_three') {
                ?>
                
                <span style='margin-buttom:0.1pt;
                font-family:"Times New Roman","serif"'><img width=25 height=25 id="Picture 1"
                src="C:\xampp\htdocs\online-exam\admin\assets\images/img/ok_check_done-512.webp"></span>
                <?php }?>
                <span style='font-size:18.00pt;font-family:"Times New Roman","serif"'>c) <?=$viewquetion['option_three'];?><o:p></o:p></span></b></p>
            </td>
            <td width=288 style='width:240.9pt;'mso-background-themecolor:background1;
            mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt;height:23.25pt'>
                <p class=msoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
                normal'><b style='mso-bidi-font-weight:normal'>
                
                <?php
                if($viewquetion['answer'] == 'option_four') {
                ?>
                
                <span style='margin-buttom:0.1pt;
                font-family:"Times New Roman","serif"'><img width=25 height=25 id="Picture 1"
                src="C:\xampp\htdocs\online-exam\admin\assets\images/img/ok_check_done-512.webp"></span>
                <?php }?>
                <span style='font-size:18.00pt;font-family:"Times New Roman","serif"'>d) <?=$viewquetion['option_four'];?><o:p></o:p></span></b></p>
            </td>
        </tr>
        </table>
        <?php }}?>
        
    </div>

 </body>
</html>