 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('cart_model');
	}
	public function index()
	{
		//Retrieve an array with all products
		$data['products'] = $this->cart_model->retrieve_products();
		//select our view file that will display our products
		$data['content'] = 'cart/products';
		$this->load->view('index',$data);
		//print_r($data['products']);
	}
	
	public function add_cart_item(){
		if($this->cart_model->validate_add_cart_item()==TRUE){
			//Check if the user has Javascript enabled 
			if($this->input->post('ajax')!='1'){
				//if Javascript is not enabled, reload the page
				redirect('cart');
			}
			else{
				//if Javascript is enabled, return true,so the cart gets updated
				echo 'true';
			}
		}
	}
	function show_cart(){
		$this->load->view('cart/cart');
	}
	function update_cart(){
		$this->cart_model->validate_update_cart();
		redirect('cart');
	}
	function empty_cart(){  
        $this->cart->destroy(); // Destroy all cart data  
        redirect('cart'); // Refresh te page  
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */