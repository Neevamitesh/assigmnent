<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Proc","PC");
        date_default_timezone_set('Asia/Kolkata');
        $this->dt = date('m-d-Y');
    }

	public function index()
	{
		$firm = $this->PC->getfirm();
		$vendor = $this->PC->getvendor();
		$product = $this->PC->getproduct();
		// echo "<pre> firm :"; print_r($res->result());
		// echo "<pre> db"; print_r($this->db->last_query()); exit;
		$data = array(
			'firm' => $firm,
			'vendor' => $vendor,
			'product' => $product,
		);
		$this->load->view('welcome_message',$data);
        // $this->load->view('downloadbill',$data);
	}
	public function GetVendorInfo(){
        $Vendors = $this->input->post("Vendors",true);
        $res = $this->PC->getVendorData($Vendors);
        // echo "<pre>db"; print_r($this->db->last_query());
        // echo "<pre>res"; print_r($res->result()); exit;
        ob_start();
        $row = $res->row();
        $ShopName = $row->ShopName;
        $Phone = $row->Phone;
        $Address = $row->Address;
        // echo "<pre> ShopName : "; print_r($ShopName);
        // echo "<pre> Phone : "; print_r($Phone);
        // echo "<pre> Address : "; print_r($Address); exit;
        $row->VendorID = ob_get_clean();
         echo json_encode([
                "Address" => $Address,
                "ShopName" => $ShopName,
                "Phone" => $Phone,
            ]);
    }

    public function AddInvoice(){
    	// echo "<pre> data : "; print_r($_POST); exit;
    	$firm = $this->input->post('firm',true);
    	$vendor = $this->input->post('vendor',true);
    	$grand_total = $this->input->post('grand_total',true);
    	$shop = $this->input->post('shop',true);
    	$phone = $this->input->post('phone',true);
    	$address = $this->input->post('address',true);
    	$bankname = $this->input->post('bankname',true);
    	$branchname = $this->input->post('branchname',true);
    	$account = $this->input->post('account',true);
    	$idfc = $this->input->post('idfc',true);
    	$instruction = $this->input->post('instruction',true);

    	$data = array(
        'FirmID' => $firm,
        'VendorID' => $vendor,
        'AllTotal' => $grand_total,
        'Shop' => $shop,
        'Phone' => $phone,
        'Address' => $address,
        'BankName' => $bankname,
        'BranchName' => $branchname,
        'Account' => $account,
        'Idfc' => $idfc,
        'Instruction' => $instruction,
		);

    	$dbResp = $this->PC->purchase($data);
        // echo "<pre>purchase"; print_r($dbResp);
        // echo "<pre>db"; print_r($this->db->last_query()); exit;
        $PurchaseID = $dbResp;

    	$pname = $this->input->post('pname',true);
    	$price = $this->input->post('price',true);
    	$qty = $this->input->post('qty',true);
    	$total = $this->input->post('total',true);

    	// echo "<pre>pnameold"; print_r($pname);

    	foreach($pname as $key => $row){
    		// echo "<pre>pname"; print_r($row); exit;
    	$data = array(
        'PurchaseID' => $PurchaseID,
        'Pname' => $row,
        'Price' => $price[$key],
        'Qty' => $qty[$key],
        'Total' => $total[$key],
        );

    	$res = $this->PC->Productpurchase($data);
    	// echo "<pre>Productpurchase"; print_r($res);
        // echo "<pre>db"; print_r($this->db->last_query()); exit;
      }
      redirect(base_url("Welcome/Invoice/?id=".$PurchaseID));
    }

    public function Invoice(){
        $purchaseid = $this->input->get("id");
        // $res = $this->PC->getInvoiceData($purchaseid);
        $res = $this->PC->GetInvoiceData('PURCHASE_INV', $purchaseid);
        // echo "res : "; print_r($res); exit;
        if(count($res) > 0){
            $first = $res[0][0];
            $sec = $res[1];
            // echo "<pre> first : "; print_r($first);
            // echo "<pre> sec : "; print_r($sec); exit;
                    $AllTotal = $first['AllTotal'];
                    $Shop = $first['Shop'];
                    $Phone = $first['Phone'];
                    $Address = $first['Address'];
                    $BankName = $first['BankName'];
                    $BranchName = $first['BranchName'];
                    $Account = $first['Account'];
                    $Idfc = $first['Idfc'];
                    $Instruction = $first['Instruction'];
                    // $ProductName = $first['ProductName'];
                    // $Price = $first['Price'];
                    // $Qty = $first['Qty'];
                    // $Total = $first['Total'];
                    $FirmName = $first['FirmName'];
                    $VendorName = $first['VendorName'];

                    $Tax = 300; // new
                    $Shipping = 60; // new
                    $FinalTotal = $AllTotal + $Tax + $Shipping ; //new
                    $date = $this->dt; // new

            $data = [
                'AllTotal' => $AllTotal,
                'Shop' => $Shop,
                'Phone' => $Phone,
                'Address' => $Address,
                'BankName' => $BankName,
                'BranchName' => $BranchName,
                'list' => $sec,
                'Account' => $Account,
                'Idfc' =>$Idfc,
                'Instruction' => $Instruction,
                // 'ProductName' => $ProductName,
                // 'Price' => $Price,
                // 'Qty' => $Qty,
                // 'Total' => $Total,
                'FirmName' => $FirmName,
                'VendorName' => $VendorName,
                'Tax' => $Tax,
                'Shipping' => $Shipping,
                'FinalTotal' => $FinalTotal,
                'date' => $date
            ];  

            // echo "<pre> data : "; print_r($data); exit;
            $this->load->library('pdf');
            $html=$this->load->view("downloadbill",$data,true);
            // $this->load->view("downloadbill",$data);

            //return;
            $this->pdf->createPDF($html, 'Invoice-Bill', true);
        }
    }
}
