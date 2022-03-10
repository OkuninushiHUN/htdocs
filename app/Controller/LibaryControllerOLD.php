<?php

namespace App\Controller;

use App\View;

class LibraryController
{
    private array $books=array();


    public  function index(){
        $this->loadData();
        return  View::make('index',['data' =>$this->books]);

    }
    public function create(){
        return View::make('create',[]);
    }

    public function store(){
        if (count($_POST)!=5){
            //error message
            include  VIEW_PATH . 'create.view.php';
        }
        $newBook = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'published_at' => $_POST['year'],
            'language' => $_POST['language'],
            'isbn' => $_POST['isbn'],
        ];
        $this->loadData();
        $this->books[]=$newBook;

        file_put_contents(STORAGE_PATH.'books1.json',json_encode($this->books));
        header('location: /');
    }

    private function loadData(){
        $path=STORAGE_PATH.'books1.json';
        $this->loadDataFromJSON($path);
    }
    private function loadDataFromJSON(string $path){
        $fileContent = file_get_contents($path);
        $this->books = json_decode($fileContent,true);
    }
}