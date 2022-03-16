<?php

namespace App\Models;

use App\DB;
class Book
{

    private DB $db;
    private string $table = "books";

    public function __construct()
    {
        $this->db = DB::getInstance();

    }
    public function find(int $id): false|array {
        // SELECT * FROM books WHERE id = ""
        $stmt = $this->db ->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt -> bindValue(':id', $id);

        $stmt->execute();

        //var_dump($stmt->rowCount());

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(); //A lekérdezés elemét vissza adja asszociatív tömb formájában
        }
        return false;
    }


    public function all() {
        $res = $this->db->query("SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL");
        return $res->fetchAll();
    }

    public function insert(array $book) {
        $stmt = $this->db->prepare("INSERT INTO ".$this->table."(title, author, isbn, language, published_at, created_at, updated_at, stock_number) VALUE "."(:title, :author, :isbn, :language, :published_at, :created_at, :updated_at, :stock_number) ");
        $stmt->bindValue(':title', $book['title']);
        $stmt->bindValue(':author', $book['author']);
        $stmt->bindValue(':isbn', $book['isbn']);
        $stmt->bindValue(':language', $book['language']);
        $stmt->bindValue(':published_at', $book['published_at']);
        $stmt->bindValue(':created_at', date('Y-m-d h:i:s'));
        $stmt->bindValue(':updated_at', date('Y-m-d h:i:s'));
        $stmt->bindValue(':stock_number', $book['stock_number']);

        return $stmt->execute();

    }
    public function delete(int $id){
        $datetime=date("Y-m-d h:i:s");
        $stmt = $this->db->prepare("UPDATE ". ' SET deleted_at = "$datetime" WHERE id = :id');
    }





    public function forceDelete(int $id) {
        //DELETE FROM books WHERE id = X
        $stmt = $this->db->prepare("DELETE FROM ".$this->table." WHERE id = :id");
        $stmt->bindValue('id', $id);

        return $stmt->execute();

    }



}