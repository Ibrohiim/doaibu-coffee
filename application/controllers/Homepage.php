<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Homepage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'admin');
		$this->load->model('Products_model', 'products');
		$this->load->model('configuration_model', 'config_m');
		$this->load->model('Transaction_model', 'transaction');
		$this->load->model('Table_model', 'table');
	}
	public function index()
	{
		$title 		 = 'Doa Ibu Coffee';
		$user		 = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$date = date('Y-m-d');
		$year   = date('Y');
		$monthfavorite = date('m') - 1;

		$site		 = $this->config_m->getConfig();
		$slider 	 = $this->config_m->getSlider();
		$category	 = $this->products->navProduct();
		$product 	 = $this->products->favoriteProduct($monthfavorite, $year);
		$newproduct	 = $this->products->newProductHome();
		$offers 	 = $this->admin->homepage_Offers($date);
		$gallery	 = $this->config_m->homepageGallery();
		$service 	 = $this->config_m->homepageService();
		$keywords 	 = $this->config_m->getConfig('keywords');
		$description = $this->config_m->getConfig('description');

		$data = array(
			'title'  	=> $title,
			'user'   	=> $user,
			'site' 		=> $site,
			'slider'	=> $slider,
			'category' 	=> $category,
			'product' 	=> $product,
			'newproduct' => $newproduct,
			'offers'    => $offers,
			'gallery' 	=> $gallery,
			'service' 	=> $service,
			'keywords' 	=> $keywords,
			'description' => $description,
		);

		$this->template->load('templates/homepage/templates', 'homepage', $data);
	}
	public function products()
	{
		$title = 'Product';
		$categoryhome = $this->products->categoryHome();
		$total        = $this->products->totalproduct();
		$product      = $this->products->productList();

		$data = array(
			'title'        => $title,
			'product'      => $product,
			'totalproduct' => $total,
			'categoryhome' => $categoryhome,
		);

		$this->template->load('templates/homepage/templates', 'homepage/products', $data);
	}
	public function detail($id_product)
	{
		$product    = $this->products->read($id_product);
		$id_product = $product->id;
		$id_category = $product->id_category;
		$title      = $product->product_name;
		$site       = $this->config_m->getConfig();
		$image      = $this->products->imageProduct($id_product);
		$categoryhome = $this->products->categoryHome();
		$product_related = $this->products->productRelated($id_category);

		$data = array(
			'title'     => $title,
			'product'   => $product,
			'site'      => $site,
			'image'     => $image,
			'categoryhome' => $categoryhome,
			'product_related' => $product_related,
		);

		$this->template->load('templates/homepage/templates', 'homepage/detail-product', $data);
	}
	public function categories($category_slug)
	{
		$category = $this->products->readCategory($category_slug);
		$id_category = $category->id;

		$title      = $category->category_name;
		$categoryhome = $this->products->categoryHome();
		$total        = $this->products->totalCategory($id_category);

		$product = $this->products->categoryList($id_category);

		$data = array(
			'title'     => $title,
			'product'   => $product,
			'categoryhome' => $categoryhome,
			'totalcategory' => $total,
		);

		$this->template->load('templates/homepage/templates', 'homepage/products', $data);
	}
	public function shopping()
	{
		$title  = 'Shopping Cart';
		$cart   = $this->cart->contents();
		$table = $this->transaction->shoppingTable();

		$data = array(
			'title'      => $title,
			'cart'       => $cart,
			'table'      => $table,
		);

		$this->template->load('templates/homepage/templates', 'homepage/shopping-cart', $data);
	}
	public function loadcart()
	{
		$data = array(
			'items' => $this->cart->contents(),
		);
		$this->load->view('homepage/cart', $data);
	}
	public function addtocart()
	{
		$id             = $this->input->post('id');
		$qty            = $this->input->post('qty');
		$price          = $this->input->post('price');
		$name           = $this->input->post('name');
		$bursttime      = $this->input->post('bursttime');

		$data = array(
			'id'            => $id,
			'qty'           => $qty,
			'price'         => $price,
			'name'          => $name,
			'bursttime'     => $bursttime,
		);

		$this->cart->insert($data);
		echo $this->loadcart();
	}
	public function removecart()
	{
		$id = $this->input->post('id');

		$this->cart->remove($id);

		echo $this->loadcart();
	}
	public function clearcart()
	{
		$this->cart->destroy();

		echo $this->loadcart();
	}
	public function decrementqty()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');

		$data = array(
			'rowid' => $id,
			'qty' => $qty - 1,
		);
		$this->cart->update($data);

		echo $this->loadcart();
	}
	public function incrementqty()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');

		$data = array(
			'rowid' => $id,
			'qty' => $qty + 1,
		);
		$this->cart->update($data);

		echo $this->loadcart();
	}
	public function dinein()
	{
		$this->session->unset_userdata('ordertype');
		$this->session->set_userdata('ordertype', 'Dine In');
		echo $this->loadcart();
	}
	public function takeaway()
	{
		$this->session->unset_userdata('ordertype');
		$this->session->set_userdata('ordertype', 'Take Away');
		echo $this->loadcart();
	}
	public function checkout()
	{
		$cart   = $this->cart->contents();
		$table  = $this->transaction->shoppingTable();

		$this->form_validation->set_rules('table_number', 'Table Number', 'required');
		$this->form_validation->set_rules('customer_name', 'Name', 'required');

		$data = array(
			'cart'       => $cart,
			'table'      => $table,
		);

		if ($this->form_validation->run() == false) {
			redirect('mainpage/shopping');
			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert"><h4><strong>Your order failed, Please check the order confirmation! </strong></h4></div>');
		} else {
			$code = $this->input->post('transaction_code');

			$this->load->library('ciqrcode');
			$config['cacheable']    = true;
			$config['cachedir']     = './assets/';
			$config['errorlog']     = './assets/';
			$config['imagedir']     = './assets/img/qrcode/';
			$config['quality']      = true;
			$config['size']         = '1024';
			$config['black']        = array(224, 255, 255);
			$config['white']        = array(70, 130, 180);
			$this->ciqrcode->initialize($config);

			$image_name = $code . '.png';

			$params['data'] = $code;
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name;
			$this->ciqrcode->generate($params);

			$data = array(
				'table_number'      => $this->input->post('table_number'),
				'order_type'        => $this->input->post('ordertype'),
				'customer_name'     => htmlspecialchars($this->input->post('customer_name', 'true')),
				'transaction_code'  => $code,
				'qrcode'            => $image_name,
				'transaction_date'  => date('Y-m-d H:i:s'),
				'total_bursttime'   => $this->input->post('total_bt'),
				'total_transaction' => $this->input->post('total_transaction'),
				'payment_status'    => 'Pending',
				'order_status'      => 'Waiting',
			);
			$this->db->insert('invoice', $data);

			foreach ($this->cart->contents() as $item) {
				$sub_total = $item['qty'] * $item['price'];
				$bursttime = $item['qty'] * $item['bursttime'];
				$data = array(
					'transaction_code'  => $code,
					'id_product'        => $item['id'],
					'price'             => $item['price'],
					'quantity'          => $item['qty'],
					'bursttime_product' => $bursttime,
					'total_price'       => $sub_total,
					'transaction_date'  => date('Y-m-d H:i:s'),
					'status_queue'      => 'Waiting',
				);
				$this->db->insert('transaction', $data);
			}

			$tablecode = $this->input->post('table_number');
			$table = array(
				'status' => 'active',
			);
			$id = array('table_code' => $tablecode);
			$this->admin->update($id, $table, 'customer_table');

			$this->cart->destroy();

			redirect('homepage/confirmorder/' . $code);
		}
	}
	public function confirmOrder($code)
	{
		$title  = 'Confirmation Order';
		$cart   = $this->transaction->shoppingTransaction($code);
		$confirmorder = $this->transaction->shoppingInvoice($code);
		$code   = $confirmorder->transaction_code;
		$tablecode = $confirmorder->table_number;
		$tablecode = $confirmorder->table_number;
		$table  = $this->table->getTableCode($tablecode);

		$data = array(
			'title' => $title,
			'confirmorder' => $confirmorder,
			'cart'  => $cart,
			'table' => $table,
		);

		$this->template->load('templates/homepage/templates', 'homepage/confirm-order', $data);
	}
	public function offers()
	{
		$date = date('Y-m-d');
		$data = array(
			'title'      => 'Special Offers',
			'offers'     => $this->admin->homepage_Offers($date),
			'productoffers' => $this->products->getOffers(),
		);

		$this->template->load('templates/homepage/templates', 'homepage/offers', $data);
	}
	public function about()
	{
		$data = array(
			'title' => 'About Doaibu Coffee',
			'about' => $this->config_m->getAbout(),
		);

		$this->template->load('templates/homepage/templates', 'homepage/about', $data);
	}
	public function contact()
	{
		$title = 'Contact';

		$data = array(
			'title'      => $title,
		);

		$this->template->load('templates/homepage/templates', 'homepage/contact', $data);
	}
}
