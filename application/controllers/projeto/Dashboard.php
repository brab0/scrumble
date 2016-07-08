<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $view = array();
    
    public function main_content($slug_projeto)
    {    	
        $this->view["mainContent"] = "pages/projeto/dashboard/main";        
        $this->view["custom_scripts"] = "pages/projeto/dashboard/scripts";        
        
        $this->login_model->checkUserSession($slug_projeto);
        
        $this->load->view(TEMPLATE_PROJETO, $this->view);
    }

    public function getDadosProjeto(){    	
    	$this->db->select("p.*");
    	$this->db->from("projetos p");
    	$this->db->where("id_projeto", $_SESSION["projeto"]->id_projeto);

    	echo json_encode($this->db->get()->row());
    }

    public function getAtividadesProjeto(){    	    
    	$this->db->where("id_projeto", $_SESSION["projeto"]->id_projeto);
        $this->db->order_by("id_atividade", "desc");
        $this->db->limit("6");

    	echo json_encode($this->db->get("atividades")->result());
    }
}
