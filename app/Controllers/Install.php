<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\SqlManager;

class Install extends Controller{

	public function index(){
		echo view('system/install/home');
	}
	public function form($param = ""){
		$inputs = $this->request->getPost(["site_title", "language", "login", "pass", "pass-confirmation", "register", "utc"]);
		$data = ["error" => -1, "inputs" => $inputs];
		if($param == "process"){
			if(empty($inputs["site_title"])) $data["error"] = 1;
			elseif(empty($inputs["language"])) $data["error"] = 2;
			elseif(empty($inputs["login"])) $data["error"] = 3;
			elseif(empty($inputs["pass"]) || ($inputs["pass"] != $inputs["pass-confirmation"])) $data["error"] = 4;
			else $data["error"] = 0;
		}
		
		if($data["error"] != 0) echo view('system/install/form',$data);
		else{
			$this->UserModel = model('App\Models\UserModel');
			$query_data = [
					"id" => 1,
			        "login" => $inputs["login"],
			        "pass"  => password_hash($inputs["pass"],PASSWORD_DEFAULT),
			        "utc" => $inputs["utc"]
			];
			$this->UserModel->builder->insert($query_data);
			
			$this->SettingModel = model('App\Models\SettingModel');
			$inputs["register"] = ($inputs["register"] == "on");
			$query_data = [
					"id" => 1,
			        "db_version" => $this->SettingModel->getSystemDBVersion(),
			        "title"  => $inputs["site_title"],
			        "language"  => $inputs["language"],
			        "register"  => $inputs["register"],
			        "utc" => $inputs["utc"]
			];
			$this->SettingModel->builder->insert($query_data);
			
			echo view('system/install/done',$data);
		}
	}
}
?>
