<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Справочник книг</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<style>
    form,
    .container-fluid,
    .row {
        float: left;
        width: 100%;
    }
    form .container-fluid .row {
        margin-bottom: 15px;
    }
</style>
<?require_once 'base.php';
$base = new Base();?>
    <div class="container">
        <?if($base->form) {?>
            <div class="row">
                <h1>Введите данные по новой книге:</h1>
            </div>
            <div class="row">
                <?if($_GET['edit']){
                    $postfix = 'edit=Y';
                } else {
                    $postfix = 'add=Y';
                }?>
                <form action="<?= $base->url ?>?<?= $postfix ?>" class="form" method="get">
                    <?if($_GET['edit']){?>
                        <input type="hidden" name="update" value="Y">
                        <input type="hidden" name="edit" value="<?= $_GET['edit'] ?>">
                    <?} else {?>
                        <input type="hidden" name="new" value="Y">
                    <?}?>
                    <div class="container-fluid">
                        <div class="row">
                            <label for="GENRE" class="col-md-3">Жанр: </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="GENRE" value="<?= $base->item['GENRE'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="AUTHOR" class="col-md-3">Автор: </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="AUTHOR" value="<?= $base->item['AUTHORS'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="TITLE" class="col-md-3">Название: </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="TITLE" value="<?= $base->item['TITLE'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="PUBLISHED" class="col-md-3">Год публикации: </label>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="PUBLISHED" min="1800" max="2017" value="<?= $base->item['PUBLISHED'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="DESCRIPTION" class="col-md-3">Аннотация: </label>
                            <div class="col-md-4">
                                <textarea rows="6" type="text" class="form-control" name="DESCRIPTION"><?= $base->item['DESCRIPTION'] ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="group-btn">
                                <button class="btn btn-primary" type="submit"><?= $base->btn ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?} else {?>
            <div class="row">
                <h1>Список изданий</h1>
            </div>
            <div class="row">
                <p>
                    <a href="<?= $base->url ?>?add=Y">Добавить издание</a>
                    <?if($_GET['sort']){?>
                        <br>
                        <a href="<?= $base->url ?>">Сбросить сортировку</a>
                    <?}?>
                </p>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th><a href="<?= $base->url ?>?sort=GENRE<?= $base->orderBy('GENRE') ?>">Жанр</a></th>
                        <th><a href="<?= $base->url ?>?sort=AUTHORS<?= $base->orderBy('AUTHORS') ?>">Автор</a></th>
                        <th><a href="<?= $base->url ?>?sort=TITLE<?= $base->orderBy('TITLE') ?>">Название</a></th>
                        <th><a href="<?= $base->url ?>?sort=PUBLISHED<?= $base->orderBy('PUBLISHED') ?>">Год публикации</a></th>
                        <th>Краткое описание</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?foreach($base->list as $i => $arItem) {?>
                            <tr>
                                <td><?= $arItem['GENRE'] ?></td>
                                <td><?= $arItem['AUTHORS'] ?></td>
                                <td><?= $arItem['TITLE'] ?></td>
                                <td><?= $arItem['PUBLISHED'] ?></td>
                                <td><?= $arItem['DESCRIPTION'] ?></td>
                                <td>
                                    <a href="<?= $base->url ?>?remove=<?= $arItem['ID'] ?>">Удалить из библиотеки</a><br>
                                    <a href="<?= $base->url ?>?edit=<?= $arItem['ID'] ?>">Изменить</a>
                                </td>
                            </tr>
                        <?}?>
                    </tbody>
                </table>
            </div>
        <?}?>
    </div>
</body>
</html>