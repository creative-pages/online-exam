<?php

// header("Content-type: application/nvd.ms-word");
// header("Content-Disposition: attachment; Filename=export.doc");

?>
<?php
    require_once '../init.php';
    Session::checkAdminSession();
    $exam = new Exam();
    $common = new Common();
    $all = new All();

    if(isset($_GET['view'])){
        $id = $_GET['view'];
       $query = $common->select("`add_exam`","`id`='$id'");
       $exam = mysqli_fetch_assoc($query);
    }
    echo session_id();
?>

<!DOCTYPE html>
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

        .qustiion-title {
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
    </style>
</head>
<body>
    <div>
        <div class="qustiion-title">
            <h2 style="text-align: center; font-weight: bold;"><?=$exam['examname'];?></h2>
            <h3 style="text-align: center;">Subject: <?= $exam['subjectname']; ?></h3>
            <div class="d-flex">
                <div class="equal-width">
                    <h3 class="text-muted">Time: <?=$exam['duration'];?> minutes</h3>
                </div>
                <div class="equal-width">
                    <h3 class="text-muted">Quetion: <?=$exam['tquetion'];?></h3>
                </div>
                <div class="equal-width">
                    <h3 class="text-muted">Date: <?=$exam['exmdate'];?></h3>
                </div>
            </div>
        </div>
        <?php
        $select = $common->select("`questions`","`exam_id` = '$id' ORDER BY `serial`+0");
        if($select){
            while($viewquetion = mysqli_fetch_assoc($select)){
        ?>
        <div class="question_row">
            <div>
                <?=$viewquetion['serial'];?>. <div style="display: inline; background: red;"><?=$viewquetion['question'];?></div>
            </div>
            <div class="d-flex">
                <div class="d-flex equal-width">
                    <span><?= $viewquetion['answer'] == 'option_one' ? '✔' : ''; ?> a) </span> 
                    <?=$viewquetion['option_one'];?>
                </div>
                <div class="d-flex equal-width">
                    <span><?= $viewquetion['answer'] == 'option_two' ? '✔' : ''; ?> b) </span>
                    <?=$viewquetion['option_two'];?>
                </div>
                <div class="d-flex equal-width">
                    <span><?= $viewquetion['answer'] == 'option_three' ? '✔' : ''; ?> c) </span>
                    <?=$viewquetion['option_three'];?>
                </div>
                <div class="d-flex equal-width">
                    <span><?= $viewquetion['answer'] == 'option_four' ? '✔' : ''; ?> d) </span>
                    <?=$viewquetion['option_four'];?>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</body>
</html>