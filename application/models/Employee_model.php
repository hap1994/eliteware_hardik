<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {
	
	public function getEmployees($postData=null){

		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		## Search 
		$searchQuery = "";
		if($searchValue != ''){
		$searchQuery = " (emp_name like '%".$searchValue."%' or email like '%".$searchValue."%' or city like'%".$searchValue."%' ) ";
		}

		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$records = $this->db->get('employees')->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(*) as allcount');
		if($searchQuery != '')
			$this->db->where($searchQuery);
		$records = $this->db->get('employees')->result();
		$totalRecordwithFilter = $records[0]->allcount;

		## Fetch records
		$this->db->select('*');
		if($searchQuery != '')
			$this->db->where($searchQuery);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get('employees')->result();

		$data = array();

		foreach($records as $record ){

			$data[] = array( 
				"emp_code"=> $record->emp_code,
				"profile_img"=> '<img src="'.base_url().'assets/images/'.$record->profile_img.'" width="150" height="100" class="img-thumbnail" />',
				"full_name"=> ucwords(($record->first_name.' '.$record->last_name)),
				"joining_date"=> $record->joining_date,
			); 
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response; 
	}

    public function save_upload($insertData) {
       	$this->db->insert('employees',$insertData);
        $insert_id = $this->db->insert_id();
   		return $insert_id;
    }     

	public function get_employee_code() {
		$count = $this->db->count_all('employees');
		//$count = 5;
		//var_dump($count);
		//exit;
		$formatedNumber = sprintf("%04d", ($count+1));
		$employeeId = "EMP-".($formatedNumber);
		return $employeeId;
	}
}
