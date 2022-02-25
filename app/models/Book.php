<?php

namespace App\Models;

use App\Model;

class Book extends Model
{

    public function all(){
        $stmt = $this->db->query("SELECT * FROM book");
        return $stmt->fetchAll();
    }

}