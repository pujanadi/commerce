<?php namespace App\Controllers;
use CodeIgniter\Controller;

ini_set('display_errors', 1);

class Ecommerce extends Controller
{
    public $session;
    public $cart;
    public $items;

	public function __construct()
	{
	    $this->session = \Config\Services::session();
        $this->cart = new \App\Models\CartModel();
        $this->items =  new \App\Models\Barang();

	}

	public function login(){
        $userModel = new \App\Models\PembeliModel();
        $username = 'john_doe';
        $password = 'pass';
        $user = $userModel->asObject()->where('username', $username)
                        ->where('password', $password)
                        ->first();

        if($user){

            $dataLogin =
                [
                    'username' => $user->username,
                    'name' => $user->name,
                    'alamat' => $user->alamat
                ];

            $this->session->set('dataLogin', $dataLogin);
        }
    }
	
	public function index()
	{
	    //Login
        $this->login();

        //Get item list
		$data['barang'] = $this->items->findAll();
		
		return view('shopping_page_view', $data);
	}
	
	public function addToCart($id_barang)
	{
		//Cek cart
        $dataCheckCart =
            [
                'id_barang' => $id_barang,
                'id_pembeli' => 'd.vader@theempire.com'
            ];

        $checkCart = $this->cart->where($dataCheckCart)->first();

        //Insert data
        if(!is_null($checkCart)){
            $checkCart = (object) $checkCart;
            $this->cart->addItem($checkCart->id, $checkCart->jumlah);
        }else{
            $data = [
                'id' => uniqid(),
                'id_pembeli'    => 'd.vader@theempire.com',
                'id_barang' => $id_barang,
                'jumlah' => 1,
                'checkout_status' => 0
            ];

            $this->cart->insert($data);
        }

		//Display Item
		$barang = new \App\Models\Barang();
		$data['barang'] = $barang->findAll();
		
		
		$data['addToCartStatus'] = true;
		return view('shopping_page_view', $data);
	}

	public function removeFromCart($id){

	    $data = [
	        'id_barang' => $id,
            'id_pembeli' => 'd.vader@theempire.com'
        ];
        $this->cart->where($data)->delete();

        return $this->index();
    }
	
	public function showCart()
	{
        helper('form');
        $data['items'] = $this->cart->getCartData();
		return view('cart_view',$data);
	}
	
	public function checkout()
	{
        $dataItemsId = $this->request->getVar('items_id', FILTER_SANITIZE_STRING);
        $dataItemsQty = $this->request->getVar('items_qty', FILTER_SANITIZE_STRING);

        $dataItem = $this->items->find($dataItemsId);

        $data['items'] = $this->cart->getCartData();
        $data['totalTransactionAmount'] = $this->getTotalTransactionAmount($dataItem);

		return view('checkout_view', $data);
	}

	public function getTotalTransactionAmount($dataItem){
	    $totalAmount = 0;

	    foreach ($dataItem as $item){
            $item = (object) $item;

	        $totalAmount += $item->harga;
        }

	    return $totalAmount;
    }

    public function bayar()
    {
        helper('xml');

        $book = xmlrpc_encode('test');
        //$book = xml_add_child($dom, 'book');

        echo $book;
    }

}
