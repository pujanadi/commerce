<?php namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
	protected $table = 't_cart';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'id_pembeli', 'id_barang', 'jumlah', 'checkout_status'];

	public function getCartData(){
	    $this->select('*');
	    $this->join('t_barang', 't_cart.id_barang = t_barang.id');


	    return $this->get()->getResult();
    }

    public function addItem($id,$qty){
	    $data = [
	        'jumlah' => $qty+1
        ];
	    $this->update($id,$data);
    }
	
}

?>