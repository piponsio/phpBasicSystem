<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends eCrisisModel{
	
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $prefix = '';
    protected $columns = [
        "id INT NOT NULL AUTO_INCREMENT",
        "login VARCHAR(30) NOT NULL",
        "pass VARCHAR(60) NOT NULL",
        "about_me TEXT NOT NULL",
        "utc DECIMAL(4,2) NOT NULL DEFAULT 0"
    ];
    protected $foreignKeys = [];
}

?>