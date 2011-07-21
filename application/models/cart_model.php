 <?php 
	class Cart_model extends CI_Model{
		function retrieve_products(){
			//Select and retrieve products from products table
			$query=$this->db->get('products');
			return $query->result_array();
		}
		
		function validate_add_cart_item(){
			//Validate the posted data and then add to the item!
			$id = $this->input->post('product_id');
			$qty = $this->input->post('quantity');
			
			$this->db->where('id',$id);
			//Select the product where match is found and limit the quantity to one!
			$query = $this->db->get('products',1);
			
			if($query->num_rows>0){
				//we have match
				foreach($query->result() as $row)
				{
					//Create array with product information
					$data=array(
						'id' => $id,
						'qty' => $qty,
						'price' => $row->price,
						'name'=> $row->name
					);
				}
				//Add the data to the cart using the insert function that
				//is available because we loaded the cart library
				
				//Do I need to check the return value of insert function for
				// any possible errors?
				//FUTURE hack!!
				$this->cart->insert($data);
				
				//Say we have successfully inserted data!!
				return TRUE;
			}
			else{
				//Nothing found - return false
				return FALSE;
			}
			
		}
	}
 
 ?>