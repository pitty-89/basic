<?php require_once 'base.php';

$base = new Base();
$base->setSymbol(',');

$stringResult = '';
if(!empty($_POST['TEXT'])) {
    $stringResult = $base->checkProgressionInString($_POST['TEXT']);
}

if($stringResult) {?>
    <hr>
    <p><?= $stringResult ?></p>
<?}?>