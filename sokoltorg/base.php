<?php

class Base {
    private $dblocation = '127.0.0.1';
    private $dbname = 'sokoltorg';
    private $dbuser = 'root';
    private $dbpass = '1234';
    private $dbtable = 'books';
    public $arResult = array();

    function __construct()
    {
        $this->connectToBase();
        $this->url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $_SERVER['PHP_SELF'];
        if($_GET['remove']) {
            $this->removeBook($_GET['remove']);
        } elseif($_GET['new'] == 'Y') {
            $this->addBook($_GET['GENRE'], $_GET['AUTHOR'], $_GET['TITLE'], $_GET['PUBLISHED'], $_GET['DESCRIPTION']);
        } elseif($_GET['edit']) {
            $this->form = true;
            $this->item = $this->editBook($_GET['edit']);
            $this->btn = 'Обновить';
        } elseif($_GET['add'] == 'Y') {
            $this->form = true;
            $this->btn = 'Добавить';
        } else {
            $this->list = $this->getListBooks();
            $this->form = false;
        }
    }

    /** Подключение к базе
     * @return string
     */
    private function connectToBase()
    {
        $mconnect = mysql_connect($this->dblocation, $this->dbuser, $this->dbpass);
        if(!$mconnect) {
            ?><p class="text-danger">'Ошибка! Недоступен сервер</p><?
            exit();
        }
        if(!mysql_select_db($this->dbname, $mconnect)) {
            ?><p class="text-danger">Ошибка! Недоступна база данных</p><?
            exit();
        }
    }

    /** Удаление книги
     * @param $id - id книги для удаления
     */
    private function removeBook($id)
    {
        $sql = "DELETE FROM " . $this->dbtable . " WHERE id='$id';";
        mysql_query($sql);
        $this->redirectToSef();
    }

    /** Добавление книги
     * @param $genre - жанр
     * @param $author - автор
     * @param $title - заголовок
     * @param $published - дата публикации
     * @param $description - краткое описание
     */
    private function addBook($genre, $author, $title, $published, $description)
    {
        $genre = htmlentities($genre);
        $author = htmlentities($author);
        $title = htmlentities($title);
        $published = htmlentities($published);
        $description = htmlentities($description);

        $sql = "INSERT INTO " . $this->dbtable . " (GENRE, AUTHORS, TITLE, PUBLISHED, DESCRIPTION) VALUES ('$genre', '$author', '$title', '$published', '$description');";
        if(mysql_query($sql)) {
            $this->redirectToSef();
        } else {
            ?><p class="text-danger">Ошибка! Не удалось добавить книгу в базу <?= mysql_error() ?></p><?
            exit();
        }
    }

    /**
     * Производит редирект на начальную страницу
     */
    private function redirectToSef()
    {
        header('Location: ' . $this->url);
    }

    /** Возвращает список книг из базы
     * @return resource
     */
    private function getListBooks() {
         $sort = '';
        if($_GET['sort']) {
            $sort = " ORDER BY " . $_GET['sort'] . ' ' . $_GET['order'];
        }
        $sql = "SELECT * FROM " . $this->dbtable . $sort .";";
        $objQuery = mysql_query($sql);
        $arReturn = array();
        while($row = mysql_fetch_assoc($objQuery)) {
            $arReturn[] = $row;
        }
        return $arReturn;
    }

    /** Определяет направление сортировки
     * @param $sort
     * @return string
     */
    public function orderBy($sort) {
        if($_GET['sort'] == $sort) {
            if($_GET['order'] == 'asc') {
                return '&order=desc';
            } else {
                return '&order=asc';
            }
        } else {
            return '&order=asc';
        }
    }
    private function editBook($id) {
        if($_GET['update'] == 'Y') {
            $genre = htmlentities($_GET['GENRE']);
            $author = htmlentities($_GET['AUTHOR']);
            $title = htmlentities($_GET['TITLE']);
            $published = htmlentities($_GET['PUBLISHED']);
            $description = htmlentities($_GET['DESCRIPTION']);

            $sql = "UPDATE " . $this->dbtable . " SET GENRE='$genre',  AUTHORS='$author', TITLE='$title', PUBLISHED='$published', DESCRIPTION='$description' WHERE id='$id';";
            if(mysql_query($sql)) {
                $this->redirectToSef();
            } else {
                ?><p class="text-danger">Ошибка! Не удалось добавить книгу в базу <?= mysql_error() ?></p><?
                exit();
            }
        } else {
            $sql = "SELECT * FROM " . $this->dbtable ." WHERE id='$id';";
            $objQuery = mysql_query($sql);
            return mysql_fetch_assoc($objQuery);
        }
    }
}