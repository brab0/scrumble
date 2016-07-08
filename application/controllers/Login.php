<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $view = array();
    
    public function index()
    {    	
        $this->view["mainContent"] = "pages/entrada/login/main";
        $this->view["custom_scripts"] = "pages/entrada/login/scripts";
        
        $this->load->view(TEMPLATE_ENTRADA, $this->view);
    }

    public function checkCredentials()
    {           
        $data = json_decode(file_get_contents("php://input"));
                
        $usu = $this->login_model->check_credentials($data);
        
        if($usu->num_rows()>0){
            $r = $usu->result();
            $id = $r[0]->id_usuario;            

            $_SESSION["usuario"] = $this->login_model->getUserCredentials($id);
            
            echo 'success';
        }        
        else{
            echo 'fail';
        }
    }
}
