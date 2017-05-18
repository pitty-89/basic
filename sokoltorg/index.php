<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task</title>
    <link rel="stylesheet" href="bootstrap.min.css">

    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<style>
    form {
        width: 100%;
        float: left;
    }
    .btn { margin-right: 10px; }
</style>
    <div class="container">
        <div class="row">
            <h1>test task</h1>
        </div>
        <div class="row">
            <form action="http://<?= $_SERVER['SERVER_NAME'] ?>/<?= $_SERVER['PHP_SELF'] ?>">
                <div class="col-xs-12">
                    <div class="row">
                        <label for="btn-action" class="col-md-3 control-label">
                            Select action for button:
                        </label>
                        <div class="col-md-4">
                            <select name="btn-action" id="btn-action" class="form-control">
                                <option value="add">add</option>
                                <option value="remove" disabled>remove</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12"><br></div>
                <div class="col-md-4">
                    <div class="row">
                        <input type="text" class="form-control" name="btn-text" placeholder="enter text for button">
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-2">
                    <div class="row">
                        <select name="btn-class" id="btn-color" class="form-control">
                            <option value="btn-success">green</option>
                            <option value="btn-primary">blue</option>
                            <option value="btn-default">white</option>
                            <option value="btn-danger">red</option>
                            <option value="btn-warning">orange</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12"><br></div>
                <div class="col-xs-12">
                    <div class="row">
                        <button class="btn btn-default" type="submit" id="click">
                            Click
                        </button>
                    </div>
                </div>
                <div class="col-xs-12"><br></div>
            </form>
        </div>
    </div>
</body>
</html>