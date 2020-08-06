<?php namespace App\Models;

use CodeIgniter\Model;

class PembeliModel extends Model
{
	protected $table = 't_pembeli';
	protected $primaryKey = 'id';
	protected $allowedFields = ['username', 'password', 'register_date', 'name'];

	public function executeLogin($username,$password){
	    $this->select('*');
	    $this->where('username = $username AND password = $password');

	    return $this->get()->getResult();
    }
	
}

?>