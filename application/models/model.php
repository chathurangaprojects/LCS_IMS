<?php
class Model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_autocomplete()
	{
		$this->db->select('Item_Name');
		$this->db->where('Type_Code',1);
		$this->db->like('Item_Name',$this->input->post('queryString'));
		
		return $this->db->get('ta_ims_item_master', 10);  
	}
}//class

?>
