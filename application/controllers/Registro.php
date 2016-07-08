<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {
    private $view = array();
    
    public function index()
    {    	
        $this->view["mainContent"] = "pages/entrada/registro/main";
        $this->view["custom_scripts"] = "pages/entrada/registro/scripts";
        
        $this->load->view(TEMPLATE_ENTRADA, $this->view);
    }

    public function cadastrar_usuario()
    {           
        $data = json_decode(file_get_contents("php://input"),true);

        $this->db->where("email_usuario", $data["email_usuario"]); 
        $r = $this->db->get("usuarios")->result();
        
        if(count($r)==0){
            $this->db->insert("usuarios", array_merge($data, array("ativo"=>1)));
        }
        else{                        
            $this->db->where("id_usuario", $r[0]->id_usuario);
            $this->db->update("usuarios", array_merge($data, array("ativo"=>1)));            
        }        
        
        echo $r[0]->id_usuario;
    }
}
