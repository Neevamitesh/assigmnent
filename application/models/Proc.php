<?php 
	class Proc extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function getfirm(){ 
	  $query = "SELECT * FROM firm WHERE BitStatus = 1";
	  $result = $this->db->query($query);
	  return $result;
	}

	public function getvendor(){ 
	  $query = "SELECT * FROM vendor WHERE BitStatus = 1";
	  $result = $this->db->query($query);
	  return $result;
	}

	public function getproduct(){
	  $query = "SELECT * FROM product WHERE BitStatus = 1";
	  $result = $this->db->query($query);
	  return $result;
	}

	public function getVendorData($Vendors){ 
	  $query = "SELECT * FROM vendor WHERE BitStatus = 1 AND VendorID = $Vendors";
	  $result = $this->db->query($query);
	  return $result;
	}

	public function purchase($data){
		$this->db->insert('purchase', $data);
		$insert_id = $this->db->insert_id();
        return  $insert_id;
	}

	public function Productpurchase($data){
		$this->db->insert('purchaseproduct', $data);
		$insert_id = $this->db->insert_id();
        return  $insert_id;
	}

	public function getInvoiceDataold($purchaseid){ 
	  $query = "SELECT p.*,pd.PurchaseProductID,pd.Pname,pd.Price,pd.Qty,pd.Total,prd.ProductID,	  prd.ProductName,fm.FirmName,v.VendorName
				FROM purchase p
				LEFT JOIN purchaseproduct pd ON pd.PurchaseID = p.PurchaseID
				LEFT JOIN product prd ON prd.ProductID = pd.Pname
				LEFT JOIN firm fm ON fm.FirmID = p.FirmID
				LEFT JOIN vendor v ON v.VendorID = p.VendorID
				WHERE p.PurchaseID = $purchaseid AND p.BitStatus = 1";
	  $queryString = $this->db->query($query);
	  return $this->GetMultipleQueryResult($queryString);
	}

	public function GetInvoiceData($type = null, $pid = 0){
            $DTParams = [$type, $pid];
            $Proc = "stp_get_linvoice_data";
            $queryString = $this->GetMultiQuery($Proc, $DTParams);
            return $this->GetMultipleQueryResult($queryString);
    }

    private function GetMultiQuery($Name,$Param=[]){ 

            $Result = null;

            try{

                $Param = $this->FilterArray($Param);

                $Q = $this->escapeParameter($Param);
                $Result = "CALL {$Name}({$Q})";

            }catch(Exception $e){

                echo $e->getMessage();

            }

            return $Result;

        }

    private function escapeParameter($param){
        return implode(',',array_map(function($row){
            return $this->db->escape($row);
        },$param));
    }

	public function GetMultipleQueryResult($queryString){
            if (empty($queryString)) {
                return false;
            }

            $index     = 0;
            $ResultSet = array();

            /* execute multi query */
            if (mysqli_multi_query($this->db->conn_id, $queryString)) {
                do {
                    $result = mysqli_store_result($this->db->conn_id);
                    if ($result) {
                        $rowID = 0;
                        $ResultSet[$index] = [];
                        while ($row = $result->fetch_assoc()) {
                            $ResultSet[$index][$rowID] = $row;
                            $rowID++;
                        }
                    }
                    $index++;
                    // mysqli_free_result($result);
                } while (mysqli_more_results($this->db->conn_id) && mysqli_next_result($this->db->conn_id));
            }

            return $ResultSet;
        }

        private function Api($Name,$Param=[]){ 

            $Result = null;

            try{

                $Param = $this->FilterArray($Param);

                $Q = $this->QM($Param);

                $Result = $this->db->query("CALL {$Name}({$Q})",$Param);

                $Result->next_result();

            }catch(Exception $e){

                echo $e->getMessage();

            }

            return $Result;

        }

        private function QM($Array){

            $Q = [];

            for($i=0;$i<count($Array);$i++){

                $Q[] = "?";

            }

            return implode(",",$Q);

        }

        private function FilterArray($Array=[]){

            foreach ($Array as $key => $value) {

                if(empty($value)){

                    $Array[$key] = "null";

                }

            }

            return $Array;

        }
} 


?>