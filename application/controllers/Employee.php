<?php 
class Employee extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library("excel");
        $this->load->model('Employee_model');
    } 
/*
* Listing of employee
*/
public function index()
{
    try{
        $this->session->set_userdata('menu_selection_header', "employee_mgnt");
        $this->session->set_userdata('menu_selection_link', "employee_link_active");
        $data['noof_page'] = 0;
        $data['employee'] = $this->Employee_model->get_all_employee();
        $data['_view'] = 'employee/index';
        $this->load->view('layouts/main',$data);
    } catch (Exception $ex) {
        throw new Exception('Employee Controller : Error in index function - ' . $ex);
    }  
}
/*
* Adding a new employee
*/
function add()
{  
    try{
        $params = array(
            'employeeCode'=> $this->input->post('employeeCode'),
            'employeeName'=> $this->input->post('employeeName'),
            'employeeDepartment'=> $this->input->post('employeeDepartment'),
            'employeeAge'=> $this->input->post('employeeAge'),
            'experienceInOrganization'=> $this->input->post('experienceInOrganization'),
            'addedDate'=>DATE_TIME,
            'addedBy'=>$this->session->userdata(SESSION_ADMIN_NAME),
            'employeeStatus'=> $this->input->post('employeeStatus'),
        );
        $this->load->library('upload');
        $this->load->library('form_validation');

        $empCode_val = $this->input->post('employeeCode');
        $empCode_arr = $this->Employee_model->get_employeebyclm_name('employeeCode',$empCode_val);
        $this->form_validation->set_rules('employeeCode','Employee Code','required');
        if($empCode_arr != null){
            $this->form_validation->set_rules('employeeCode','Employee Code','form_validation_titleexist');
        }

        $this->form_validation->set_rules('employeeName','Employee Name','required');
        $this->form_validation->set_rules('employeeDepartment','Employee Department','required');
        $this->form_validation->set_rules('employeeAge','Employee Age','required');
        $this->form_validation->set_rules('experienceInOrganization','Experience In Organization','required');
        if($this->form_validation->run())  
        {  
            $employeeId = $this->Employee_model->add_employee($params);
            $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully added.</div>');
            redirect('employee/index');
        }
        else
        { 
            $data['_view'] = 'employee/add';
            $this->load->view('layouts/main',$data);
        }
    } catch (Exception $ex) {
        throw new Exception('Employee Controller : Error in add function - ' . $ex);
    }  
}  
/*
* Editing a employee
*/
public function edit($employeeId)
{   
    try{
        $data['employee'] = $this->Employee_model->get_employee($employeeId);
        $this->load->library('upload');
        $this->load->library('form_validation');
        if(isset($data['employee']['employeeId']))
        {
            $params = array(
                'employeeCode'=> $this->input->post('employeeCode'),
                'employeeName'=> $this->input->post('employeeName'),
                'employeeDepartment'=> $this->input->post('employeeDepartment'),
                'employeeAge'=> $this->input->post('employeeAge'),
                'experienceInOrganization'=> $this->input->post('experienceInOrganization'), 
                'updatedDate'=>DATE_TIME,
                'updatedBy'=>$this->session->userdata(SESSION_ADMIN_NAME),
                'employeeStatus'=> $this->input->post('employeeStatus'),
            );

            $empCode_val = $this->input->post('employeeCode');
            $empCode_arr = $this->Users_model->get_usersbyclm_name_not_id('employeeCode',$empCode_val,$employeeId);
            $this->form_validation->set_rules('employeeCode','Employee Code','required');
            if($empCode_arr != null){
                $this->form_validation->set_rules('employeeCode','Employee Code','unique');
            }

            $this->form_validation->set_rules('employeeName','Employee Name','required');
            $this->form_validation->set_rules('employeeDepartment','Employee Department','required');
            $this->form_validation->set_rules('employeeAge','Employee Age','required');
            $this->form_validation->set_rules('experienceInOrganization','Experience In Organization','required');
            if($this->form_validation->run())  
            {  
                $this->Employee_model->update_employee($employeeId,$params);
                $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully updated.</div>');
                redirect('employee/index');
            }
            else
            {
                $data['_view'] = 'employee/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The employee you are trying to edit does not exist.');
    } catch (Exception $ex) {
        throw new Exception('Employee Controller : Error in edit function - ' . $ex);
    }  
} 
/*
* Deleting employee
*/
function remove($employeeId)
{
    try{
        $employee = $this->Employee_model->get_employee($employeeId);
        if(isset($employee['employeeId']))
        {
            $remove_param = array('employeeStatus'=>'removed');
            $this->Employee_model->update_employee($employeeId,$remove_param);
            $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully Removed.</div>');
            redirect('employee/index');
        }
        else
            show_error('The employee you are trying to delete does not exist.');
    } catch (Exception $ex) {
        throw new Exception('Employee Controller : Error in remove function - ' . $ex);
    }  
}
/*
* View more a employee
*/
public function view_more($employeeId)
{   
    try{
        $data['employee'] = $this->Employee_model->get_employee($employeeId);
        if(isset($data['employee']['employeeId']))
        {
            $data['_view'] = 'employee/view_more';
            $this->load->view('layouts/main',$data);
        }
        else
            show_error('The employee you are trying to view more does not exist.');
    } catch (Exception $ex) {
        throw new Exception('Employee Controller : Error in View more function - ' . $ex);
    }  
} 

/*
* Import employees
*/
public function import()
{   
    try {
        $this->load->library('form_validation');
        if (isset($_FILES["file"]["name"])) {
            $path   = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow         = $worksheet->getHighestRow();
                $highestColumn      = $worksheet->getHighestColumn();
                $colNumber          = PHPExcel_Cell::columnIndexFromString($highestColumn);

                if($highestRow > 21 || $colNumber < 5) {
                    $this->form_validation->set_rules('csv_file','File does not meet standards! Try another file. CSV File','required');
                }

                $sample_sheet_used = $this->input->post('sample_sheet_used');
                $this->form_validation->set_rules('sample_sheet_used','Sample sheet used','required');
                if($sample_sheet_used == 'No') {
                    $employeeCode               = $this->input->post('employeeCode');
                    $employeeName               = $this->input->post('employeeName');
                    $employeeDepartment         = $this->input->post('employeeDepartment');
                    $employeeAge                = $this->input->post('employeeAge');
                    $experienceInOrganization   = $this->input->post('experienceInOrganization');

                    $employeeCode = $employeeCode-1;
                    $employeeName = $employeeName-1;
                    $employeeDepartment = $employeeDepartment-1;
                    $employeeAge = $employeeAge-1;
                    $experienceInOrganization = $experienceInOrganization-1;


                    $this->form_validation->set_rules('employeeCode','Employee Code','required');
                    $this->form_validation->set_rules('employeeName','Employee Name','required');
                    $this->form_validation->set_rules('employeeDepartment','Employee Department','required');
                    $this->form_validation->set_rules('employeeAge','Date of birth','required');
                    $this->form_validation->set_rules('experienceInOrganization','Joining Date','required');

                    if($this->form_validation->run()) {
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $employeeCode_val = $worksheet->getCellByColumnAndRow($employeeCode, $row)->getValue();
                            $employeeName_val = $worksheet->getCellByColumnAndRow($employeeName, $row)->getValue();
                            $employeeDepartment_val = $worksheet->getCellByColumnAndRow($employeeDepartment, $row)->getValue();
                            $employeeAge_val = $worksheet->getCellByColumnAndRow($employeeAge, $row)->getValue();
                            $experienceInOrganization_val = $worksheet->getCellByColumnAndRow($experienceInOrganization, $row)->getValue();

                            $dob   = $employeeAge_val;
                            $exp   = $experienceInOrganization_val;
                            $cur   = DATE;
                            
                            $diff_age       = abs(strtotime($cur) - strtotime($dob));
                            $employeeAge    = floor($diff_age / (365*60*60*24));

                            $diff_exp       = abs(strtotime($cur) - strtotime($exp));
                            $experienceInOrganization =  floor($diff_exp / (365*60*60*24));

                            $empCode_arr = array();
                            $empCode_val = $worksheet->getCellByColumnAndRow($employeeCode, $row)->getValue();
                            $empCode_arr = $this->Employee_model->get_employeebyclm_name('employeeCode',$empCode_val);
                            if(empty($empCode_arr) && $empCode_val != null) {
                                $param = array(
                                    'employeeCode'=>$employeeCode_val,
                                    'employeeName'=>$employeeName_val,
                                    'employeeDepartment'=>$employeeDepartment_val,
                                    'employeeAge'=>$employeeAge,
                                    'experienceInOrganization'=>$experienceInOrganization,
                                    'addedDate'=>DATE_TIME,
                                    'addedBy'=>$this->session->userdata(SESSION_ADMIN_NAME),
                                    'employeeStatus'=>'active'
                                );
                                $this->Employee_model->add_employee($param);
                            }
                        }
                        $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully added.</div>');
                        redirect('employee/import');
                    } else {
                        $data['_view'] = 'employee/import_employees';
                        $this->load->view('layouts/main',$data);
                    }
                } else {
                    if($this->form_validation->run()) {
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $employeeCode_val = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $employeeName_val = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $employeeDepartment_val = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $employeeAge_val = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $experienceInOrganization_val = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

                            $dob   = $employeeAge_val;
                            $exp   = $experienceInOrganization_val;
                            $cur   = DATE;
                            
                            $diff_age       = abs(strtotime($cur) - strtotime($dob));
                            $employeeAge    = floor($diff_age / (365*60*60*24));

                            $diff_exp       = abs(strtotime($cur) - strtotime($exp));
                            $experienceInOrganization =  floor($diff_exp / (365*60*60*24));

                            $empCode_arr = array();
                            $empCode_val = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $empCode_arr = $this->Employee_model->get_employeebyclm_name('employeeCode',$empCode_val);
                            if(empty($empCode_arr) && $empCode_val != null) {
                                $param = array(
                                    'employeeCode'=>$employeeCode_val,
                                    'employeeName'=>$employeeName_val,
                                    'employeeDepartment'=>$employeeDepartment_val,
                                    'employeeAge'=>$employeeAge,
                                    'experienceInOrganization'=>$experienceInOrganization,
                                    'addedDate'=>DATE_TIME,
                                    'addedBy'=>$this->session->userdata(SESSION_ADMIN_NAME),
                                    'employeeStatus'=>'active'
                                );
                                $this->Employee_model->add_employee($param);
                            }
                        }
                        $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully added.</div>');
                        redirect('employee/import');
                    } else {
                        $data['_view'] = 'employee/import_employees';
                        $this->load->view('layouts/main',$data);
                    }
                }
            }
        } else {
            $data['_view'] = 'employee/import_employees';
            $this->load->view('layouts/main',$data);
        }
    } catch (Exception $ex) {
        throw new Exception('Employee Controller : Error in import function - ' . $ex);
    }  
} 

/*
    // Sample sheet for import employees
*/
public function sample_sheet()
{
    $object = new PHPExcel();
    $object->setActiveSheetIndex(0);
    $table_columns = array("Employee Code", "Employee Name", "Employee Department", "Employee Date of Birth (yyyy-mm-dd)", "Joining Date (yyyy-mm-dd)");
    $column = 0;
    foreach ($table_columns as $field) {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
    }
    $excel_row = 2;
    $in = "";

    $employeeCode = "";
    $employeeName = "";
    $employeeDepartment = "";
    $employeeAge = "";
    $experienceInOrganization = "";


    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $employeeCode);
    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $employeeName);
    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $employeeDepartment);
    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $employeeAge);
    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $experienceInOrganization);

    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Employee-Data-upload-sheet-' . DATE_TIME . '.csv"');

    $object_writer->save('php://output');
}


}
