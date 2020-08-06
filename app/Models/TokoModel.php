<?php namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model 
{
	protected $table = 't_toko';
	protected $primaryKey = 'id';
	
	protected $id;
	protected $nama;
	
	public function searchAll(){
		$this->db->select('*');
		$this->db->from($this->table);
		return $this->db->get()->result();
	}
}

?>