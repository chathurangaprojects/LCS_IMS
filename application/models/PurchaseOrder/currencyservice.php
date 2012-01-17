<?php
class CurrencyService extends CI_Model {


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->load->model('CurrencyModel');
		
 }//constructor
 
 
 
 function retriveAllCurrencyDetails(){
	
	 
	 	$query = $this->db->get('ta_ims_currency');
		
		$currencyArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$currencyModel=new CurrencyModel();
			
			$currencyModel->setCurrency_Code($row->Currency_Code);
			$currencyModel->setCurrency($row->Currency);
			$currencyModel->setConversion_Rate($row->Conversion_Rate);
			$currencyModel->setDescription($row->Description);
			
    		$currencyArray[$index]=$currencyModel;
			$index++;
		}
		
		
		return $currencyArray;
	 
 }//retriveAllCurrencyDetails
  


 
 function retriveSelectedCurrencyDetails($currencyModelGiven){

$query = $this->db->get_where('ta_ims_currency',array('Currency_Code'=>$currencyModelGiven->getCurrency_Code()));
		
		$currencyModel=new CurrencyModel();
		
		foreach ($query->result() as $row)
		{			
			$currencyModel->setCurrency_Code($row->Currency_Code);
			$currencyModel->setCurrency($row->Currency);
			$currencyModel->setConversion_Rate($row->Conversion_Rate);
			$currencyModel->setDescription($row->Description);			

		}
		
		
		return $currencyModel;
	 
 }//retriveCurrencyDetail
 
 
 


}//class

?>
