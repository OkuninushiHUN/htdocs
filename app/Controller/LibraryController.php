<?php

namespace App\Controller;
use App\models\Book;
use App\View;


class LibraryController
{

    public  function index(){
        $books = new Book();
        return \App\View::make('index', ['data'=> $books->all()]);
    }

    public function create(){
        return View::make('create');
    }
    public function store(){
        if (count($_POST) != 6){
            return View::make('create');
        }
        $newBook = [
            'stock_number' => $_POST['stock_number'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'language' => $_POST['language'],
            'published_at' => $_POST['published_at'],
            'isbn' => $_POST['isbn'],
        ];
        if((new Book())->insert($newBook)){
            //todo succes message
            header('Location:/');
        }
        else{
            return View::make('create');
        }


    }

}


