<?php

namespace App\Controller;

use App\Models\Book;
use App\View;

class LibraryController
{
    public function index() {
        $books = new Book();
        $message = $_SESSION['message'] ?? "";
        unset($_SESSION['message']);

        return View::make('index',[
            'data' => $books->all(),
            'message' =>$message

        ]);
    }

    public function create() {
        return View::make('create');
    }

    public function store() {
        if (count($_POST)!=6) {
            //todo error message

            return View::make('create');
        }

        $newBook = [
            'stock_number' => $_POST['stock_number'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'published_at' => $_POST['published_at'],
            'language' => $_POST['language'],
            'isbn' => $_POST['isbn'],
        ];

        if((new Book())->insert($newBook)) {
            $_SESSION['message'] = "Sikeres Létrehozás!";
            header('Location: /');
            exit();
        }
        else {
            //sikertelen látrehozás
            return View::make('create');
        }


    }
    public function show() {
        if (!isset($_GET["id"])) { //ha nincs id, akkor átirányít a főoldalra
            header('Location: /');
            exit(); //die();
        }

        $id = $_GET['id'];

        $result = (new Book())->find($id);

        if (!$result) { //$result == false //ha nincs adott id-val könyv, akkor átirányít a főoldalra
            header('Location: /');
            exit();
        }

        return View::make('show', [
            'book' =>$result
        ]);
    }

    public function delete() {
        if (!isset($_GET["id"])) { //ha nincs id, akkor átirányít a főoldalra
            header('Location: /');
            exit(); //die();
        }
        $id = $_GET['id'];

        if((new Book())->$this->delete($id)){
            //todo message
            header('Location: /');
            exit();
        }
        //todo message
        header('Location: /details?id='.$id);
        exit();
    }
}


