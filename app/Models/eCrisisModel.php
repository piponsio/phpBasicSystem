<?php namespace App\Models;

use CodeIgniter\Model;

// existentialCrisis
abstract class eCrisisModel extends Model{
	
    protected $table = '';
    protected $primaryKey = '';
    protected $prefix = '';
    protected $columns = [];
    protected $foreignKeys = [];

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $exists = false;
   
	public function __construct(...$params){
		parent::__construct(...$params);
        //"I am therefore I think"
		$query = $this->db->query("SHOW TABLES LIKE '".$this->prefix.$this->table."'");
        if($this->db->affectedRows() > 0) $this->exists = true;
		if(!$this->exists && !empty($this->table)) $this->creatingMe();
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