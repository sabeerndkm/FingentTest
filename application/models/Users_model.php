<?php 
class Users_model extends CI_Model 
{ 
  function __construct()
  {
    parent::__construct();
  }
/*
* Get users by userId 
*/ 
function get_users($userId)
{
  try{
    return $this->db->get_where('users',array('userId'=>$userId))->row_array();
  } catch (Exception $ex) {
    throw new Exception('Users_model Model : Error in get_users function - ' . $ex);
  }  
}
/*
* Get users by  column name
*/ 
function get_usersbyclm_name($clm_name,$clm_value)
{
  try{
    return $this->db->get_where('users',array($clm_name=>$clm_value,'userStatus !='=>'removed'))->row_array();
  } catch (Exception $ex) {
    throw new Exception('Users_model Madel : Error in get_usersbyclm_name function - ' . $ex);
  }  
}
/*
* Get All users count 
*/ 
function get_all_users_count()
{
  try{
    $this->db->where('userStatus !=','removed');
    $this->db->from('users');
    return $this->db->count_all_results();
  } catch (Exception $ex) {
    throw new Exception('Users_model model : Error in get_all_users_count function - ' . $ex);
  }  
}

/*
* Get all users 
*/ 
function get_all_users($params = array())
{
  try{
    $this->db->where('userStatus !=','removed');
    $this->db->order_by('userId', 'desc');
    if(isset($params) && !empty($params)){
      $this->db->limit($params['limit'], $params['offset']);
    }
    return $this->db->get('users')->result_array();
  } catch (Exception $ex) {
    throw new Exception('Users_model model : Error in get_all_users function - ' . $ex);
  }  
} 
/*
* function to add new users 
*/
function add_users($params)
{
  try{
    $this->db->insert('users',$params);
    return $this->db->insert_id();
  } catch (Exception $ex) {
    throw new Exception('Users_model model : Error in add_users function - ' . $ex);
  }  
}
/* 
* function to update users 
*/
function update_users($userId,$params)
{
  try{
    $this->db->where('userId',$userId);
    return $this->db->update('users',$params);
  } catch (Exception $ex) {
    throw new Exception('Users_model model : Error in update_users function - ' . $ex);
  }  
}
/* 
* function to delete users 
*/
function delete_users($userId)
{
  try{
    return $this->db->delete('users',array('userId'=>$userId));
  } catch (Exception $ex) {
    throw new Exception('Users_model model : Error in delete_users function - ' . $ex);
  }  
}
/*
* Get users by  column name where not in particular id
*/ 
function get_usersbyclm_name_not_id($clm_name,$clm_value,$where_cond)
{
  try{
    $this->db->where('userId!=', $where_cond);
    return $this->db->get_where('users',array($clm_name=>$clm_value,'userStatus !='=>'removed'))->row_array();
  } catch (Exception $ex) {
    throw new Exception('Users_model model : Error in get_usersbyclm_name_not_id function - ' . $ex);
  }  
}
 
}
