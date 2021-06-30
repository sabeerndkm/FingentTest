<?php 
class Employee_model extends CI_Model 
{ 
  function __construct()
  {
    parent::__construct();
  }
/*
* Get employee by employeeId 
*/ 
function get_employee($employeeId)
{
  try{
    return $this->db->get_where('employee',array('employeeId'=>$employeeId))->row_array();
  } catch (Exception $ex) {
    throw new Exception('Employee_model Model : Error in get_employee function - ' . $ex);
  }  
}
/*
* Get employee by  column name
*/ 
function get_employeebyclm_name($clm_name,$clm_value)
{
  try{
    return $this->db->get_where('employee',array($clm_name=>$clm_value,'employeeStatus !='=>'removed'))->row_array();
  } catch (Exception $ex) {
    throw new Exception('Employee_model Madel : Error in get_employeebyclm_name function - ' . $ex);
  }  
}
/*
* Get All employee count 
*/ 
function get_all_employee_count()
{
  try{
    $this->db->where('employeeStatus !=','removed');
    $this->db->from('employee');
    return $this->db->count_all_results();
  } catch (Exception $ex) {
    throw new Exception('Employee_model model : Error in get_all_employee_count function - ' . $ex);
  }  
}

/*
* Get all employee 
*/ 
function get_all_employee($params = array())
{
  try {
    $this->db->where('employeeStatus !=','removed');
    $this->db->order_by('employeeId', 'desc');
    if(isset($params) && !empty($params)){
      $this->db->limit($params['limit'], $params['offset']);
    }
    return $this->db->get('employee')->result_array();
  } catch (Exception $ex) {
    throw new Exception('Employee_model model : Error in get_all_employee function - ' . $ex);
  }  
} 
/*
* function to add new employee 
*/
function add_employee($params)
{
  try{
    $this->db->insert('employee',$params);
    return $this->db->insert_id();
  } catch (Exception $ex) {
    throw new Exception('Employee_model model : Error in add_employee function - ' . $ex);
  }  
}
/* 
* function to update employee 
*/
function update_employee($employeeId,$params)
{
  try{
    $this->db->where('employeeId',$employeeId);
    return $this->db->update('employee',$params);
  } catch (Exception $ex) {
    throw new Exception('Employee_model model : Error in update_employee function - ' . $ex);
  }  
}
/* 
* function to delete employee 
*/
function delete_employee($employeeId)
{
  try{
    return $this->db->delete('employee',array('employeeId'=>$employeeId));
  } catch (Exception $ex) {
    throw new Exception('Employee_model model : Error in delete_employee function - ' . $ex);
  }  
}
/*
* Get employee by  column name where not in particular id
*/ 
function get_employeebyclm_name_not_id($clm_name,$clm_value,$where_cond)
{
  try{
    $this->db->where('employeeId!=', $where_cond);
    return $this->db->get_where('employee',array($clm_name=>$clm_value,'employeeStatus !='=>'removed'))->row_array();
  } catch (Exception $ex) {
    throw new Exception('Employee_model model : Error in get_employeebyclm_name_not_id function - ' . $ex);
  }  
}
 
}
