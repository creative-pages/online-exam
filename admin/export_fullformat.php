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
        body {
            background: #eef5f9;
        }
        .d-block {
            display: block;
        }
        .d-inline-block {
            display: inline-block;
        }
        .d-flex {
            display: flex;
        }
        .flex-column {
            flex-direction: column;
        }
        .justify-content-center {
            justify-self: center;
        }
        .align-items-center {
            align-items: center;
        }
        .equal-width {
            flex-grow: 1;
            flex-basis: 0;
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
        .pb-3 {
            padding-bottom: 16px;
        }
        .option {
            width: 16px;
            height: 16px;
            line-height: 16px;
            border: 2px solid black;
            border-radius: 50%;
            text-align: center;
        }
        .right_answer {
            background: green;
            color: white;
            border-color: green;
        }
        table {
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
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
        $html .= '<div class="question_row">
            <div class="d-flex pb-3">
                <span style="font-weight: bold;">'.$viewquetion['serial'].'. &nbsp;</span>'.$viewquetion["question"].'
            </div>
            <div class="d-flex">
                <div class="d-flex equal-width">
                    <span class="option'.$answer_checked1.'">a</span> &nbsp;
                    '.$viewquetion["option_one"].'
                </div>
                <div class="d-flex equal-width">
                    <span class="option'.$answer_checked2.'">b</span> &nbsp;
                    '.$viewquetion["option_two"].'
                </div>
                <div class="d-flex equal-width">
                    <span class="option'.$answer_checked3.'">c</span> &nbsp;
                    '.$viewquetion["option_three"].'
                </div>
                <div class="d-flex equal-width">
                    <span class="option'.$answer_checked4.'">d</span> &nbsp;
                    '.$viewquetion["option_four"].'
                </div>
            </div>
        </div>';
        $html .= '<table border>
                    <tbody>
                        <tr>
                            <td colspan="4">Quetion name</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="option'.$answer_checked1.'">a</span> &nbsp;
                                '.$viewquetion["option_one"].'
                            </td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                        </tr>
                    </tbody>
                </table>';
            }
        }
    $html .= '</div>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>