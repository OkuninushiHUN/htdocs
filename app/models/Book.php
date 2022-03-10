<?php

namespace App\Models;
use App\DB;

class Book
{

    private DB $db;
    public string $table = 'books';
    public function __construct(){

        $this->db =DB::getInstance();
    }
    public function all(){
       return  $this->db->query("SELECT * FROM ".$this->table)->fetchAll();

    }
    public function insert(array $book){
        $stmt =$this->db->prepare("INSERT INTO " . $this->table .
            " (title, author, isbn, language, published_at, created_at, updated_at, stock_number) VAlUE ".
            " (:title, :author, :isbn, :language, :published_at, :created_at, :updated_at, :stock_number) "
        );
        $stmt->bindValue(':title',$book['title']);
        $stmt->bindValue(':author',$book['author']);
        $stmt->bindValue(':isbn',$book['isbn']);
        $stmt->bindValue(':language',$book['language']);
        $stmt->bindValue(':published_at', $book['published_at']);
        $stmt->bindValue(':created_at',date("Y-m-d h:i:s"));
        $stmt->bindValue(':updated_at',date("Y-m-d h:i:s"));
        $stmt->bindValue(':stock_number',$book['stock_number']);

        return $stmt->execute();
    }




}