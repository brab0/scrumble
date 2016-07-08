<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $view = array();
    
    public function main_content($projeto = null)
    {       
        $this->view["mainContent"] = "pages/usuario/dashboard/main";
        $this->view["custom_scripts"] = "pages/usuario/dashboard/scripts";
        
        $this->load->view(TEMPLATE_USUARIO, $this->view);
    }

    public function getListaProjetos(){
    	$this->db->select("p.*");
    	$this->db->from("projetos p");
    	$this->db->join("usuarios_has_projetos up", "up.id_projeto = p.id_projeto");
    	$this->db->where("up.id_usuario", $_SESSION["usuario"]->id_usuario);

    	$r = $this->db->get()->result();

    	echo json_encode($r);
    }

    public function getAtividades(){
        $this->db->select("a.*, p.nome_projeto");
        $this->db->from("atividades a");
        $this->db->join("usuarios_has_projetos up", "up.id_projeto = a.id_projeto");
        $this->db->join("projetos p", "up.id_projeto = p.id_projeto");
        $this->db->where("up.id_usuario", $_SESSION["usuario"]->id_usuario);
        $this->db->order_by("id_atividade", "desc");
        $this->db->limit("6");
        
        $r = $this->db->get()->result();

        echo json_encode($r);
    }
}
