<?php
    require_once '../init.php';
    require_once("../vendor/autoload.php");
    Session::checkAdminSession();
    $exam = new Exam();
    $common = new Common();
    $all = new All();

    if(isset($_GET['view'])){
        $id = $_GET['view'];
       $query = $common->select("`add_exam`","`id`='$id'");
       $exam = mysqli_fetch_assoc($query);
    }
?>

<?php

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
          padding: 0;
          margin: 0;
        }
        @page {
          margin: 0px;
          margin: 10px;
          box-sizing: border-box;
        }
        .w-25 {
            width: 24.5%;
        }
        .w-50 {
            width: 50%;
        }
        .w-100 {
            width: 100%;
        }
        .float-left {
            float: left;
        }

        .qustiion_title {
            background: white;
            border: 1px solid green;
            padding: 8px;
            margin: 8px 0;
        }
        .question_row {
            background: white;
            border: 1px solid green;
            padding: 8px;
            margin: 8px 0;
        }
        .question_serial {
            width: 4%;
            font-weight: bold;
            float: left;
        }
        .question_name {
            width: 96%;
            float: left;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <div>
        <div class="qustiion_title">
            <h2 style="text-align: center; font-weight: bold; margin-bottom: 8px;">'.$exam['examname'].'</h2>
            <h3 style="text-align: center; margin-bottom: 8px;">Subject: '.$exam['subjectname'].'</h3>
            <div class="d-flex">
                <div class="equal-width">
                    <h3 style="color: gray;">Time: '.$exam['duration'].' minutes</h3>
                </div>
                <div class="equal-width">
                    <h3 style="color: gray; text-align: center;">Quetion: '.$exam['tquetion'].'</h3>
                </div>
                <div class="equal-width">
                    <h3 style="color: gray; text-align: right;">Date: '.$exam['exmdate'].'</h3>
                </div>
            </div>
        </div>';

        $select = $common->select("`questions`","`exam_id` = '$id' ORDER BY `serial`+0");
        if($select){
            while($viewquetion = mysqli_fetch_assoc($select)){
                if($viewquetion['answer'] == 'option_one') {
                    $answer_checked1 = ' right_answer';
                    $answer_checked2 = '';
                    $answer_checked3 = '';
                    $answer_checked4 = '';
                } elseif ($viewquetion['answer'] == 'option_two') {
                    $answer_checked1 = '';
                    $answer_checked2 = ' right_answer';
                    $answer_checked3 = '';
                    $answer_checked4 = '';
                } elseif ($viewquetion['answer'] == 'option_three') {
                    $answer_checked1 = '';
                    $answer_checked2 = '';
                    $answer_checked3 = ' right_answer';
                    $answer_checked4 = '';
                } elseif ($viewquetion['answer'] == 'option_four') {
                    $answer_checked1 = '';
                    $answer_checked2 = '';
                    $answer_checked3 = '';
                    $answer_checked4 = ' right_answer';
                }
        $html .= '
        <div class="question_row">
            <div class="w-100">
                <span>te</span>
                    <span>test in thsme ty siom fjioetne fdofjderntoerj dkjeonfd  jrteoit</span>
                <span style="float: left;">'.$viewquetion['serial'].'.</span>
                <span style="float: left;">'.$viewquetion["question"].'</span>
            </div>
            <div class="w-100">
                <div class="w-25 float-left">
                    <span class="option'.$answer_checked1.'">a</span> &nbsp;
                    '.$viewquetion["option_one"].'
                </div>
                <div class="w-25 float-left">
                    <span>te</span>
                    <span>test in thsme ty siom fjioetne fdofjderntoerj dkjeonfd  jrteoit</span>
                </div>
                <div class="w-25 float-left">
                    <span class="option'.$answer_checked3.'">c</span> &nbsp;
                    '.$viewquetion["option_three"].'
                </div>
                <div class="w-25 float-left">
                    <span class="option'.$answer_checked4.'">d</span> &nbsp;
                    '.$viewquetion["option_four"].'
                </div>
            </div>
        </div>';
            }
        }
    $html .= '</div>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'mode' => 'utf-8'
        ]);
$mpdf->WriteHTML($html);
$mpdf->Output();

?>