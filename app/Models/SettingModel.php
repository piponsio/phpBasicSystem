<?php namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends eCrisisModel{

    protected $system_db_version = 1;

    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $prefix = '';
    protected $columns = [
        "id INT NOT NULL AUTO_INCREMENT",
        "db_version INT(3) NOT NULL DEFAULT 0",
        "title VARCHAR(30) NOT NULL",
        "language VARCHAR(2) NOT NULL DEFAULT 'EN'",
        "register BOOLEAN NOT NULL DEFAULT 0",
        "utc DECIMAL(4,2) NOT NULL DEFAULT 0"
    ];
    protected $foreignKeys = [];
}

?>