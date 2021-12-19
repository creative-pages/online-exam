
<?php
require_once(str_replace(array('/', '\\'), '/', realpath(__DIR__)).'/ExportToWord.inc.php');

$html = '<html>
<body>
<div class = "test">
 <h3>Text</h3>
 <h4>final Exam</h4>
</div>

</body>
</html>';
$css = '<style type = "text/css">
.test {
    text:center;
    font-weight: 600;   
    }
</style>';
$fileName = str_replace(array('/', '\\'), '/', realpath(__DIR__)).'/test.doc';
ExportToWord::htmlToDoc($html, $css, $fileName);
?>
