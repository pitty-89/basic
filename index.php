<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <title>Test progression</title>
</head>
<body>
<?require_once 'base.php';

$base = new Base();
$base->setSymbol(',');

$stringResult = '';
if(!empty($_POST['TEXT'])) {
    $stringResult = $base->checkProgressionInString($_POST['TEXT']);
}
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12"><br></div>
        </div>
        <div class="row">
            <form action="/progression/"
                  class="form col-xs-12"
                  data-ajax="/progression/check.php"
                  method="POST">
                <div class="row">
                    <label for="TEXT" class="col-xs-2">Enter numbers:</label>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <input type="text"
                                   name="TEXT"
                                   class="form-control js-control"
                                   id="TEXT"
                                   value="<?= $base->getValue() ?>"
                                   placeholder="1,2,3...">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="SUBMIT">Submit</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-xs-12" id="container-result">
                <?if(!empty($stringResult)) {?>
                    <hr>
                    <p><?= $stringResult ?></p>
                <?}?>
            </div>
        </div>
    </div>
</body>
</html>