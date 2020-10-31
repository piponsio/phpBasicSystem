<?php namespace App\Models;

use CodeIgniter\Model;

// existentialCrisis
abstract class eCrisisModel extends Model{

    protected $prefix = '';
    protected $exists = false;
    protected $builder;
	public function __construct(...$params){
		parent::__construct(...$params);
        //"I am therefore I think"
        if(!$this->db->tableExists($this->prefix.$this->table)){
			$this->creatingMe();
            $this->exists = true;
		}
        $this->builder = $this->db->table($this->table);
	}

	public function creatingMe(){
        if($this->db->DBDriver == "MySQLi"){
            $a = "CREATE TABLE IF NOT EXISTS ".$this->prefix.$this->table."(";
            if(is_array($this->columns)){
                for($i = 0; $i < count($this->columns); $i++){
                    $a .= ($i>0)?(", ".$this->columns[$i]):($this->columns[$i]);
                    if($i == count($this->columns)-1 && !empty($this->primaryKey)) $a .= ", PRIMARY KEY (".$this->primaryKey.")";
                }
            }
            if(is_array($this->foreignKeys)){
                for($i = 0; $i < count($this->foreignKeys); $i++) $a .= ($i>0)?(", ".$this->foreignKeys[$i]):($this->foreignKeys[$i]);
            }            
            $a .= ");";
            $this->db->query($a);
        }
	}
}

?>