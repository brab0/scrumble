<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrum_Team extends CI_Controller {
    private $view = array();
    
    public function main_content($slug_projeto)
    {       
		$this->login_model->checkUserSession($slug_projeto);
        $this->view["mainContent"] = "pages/projeto/scrum_team/main";
        $this->view["custom_scripts"] = "pages/projeto/scrum_team/scripts";
        
        $this->load->view(TEMPLATE_PROJETO, $this->view);
    }

    public function adicionar_integrante()
    {           
        $data = json_decode(file_get_contents("php://input"));        
        $id_usuario = 0;
        $this->db->where("email_usuario", $data->email_usuario);        
        $usuarios = $this->db->get("usuarios")->result();
        if(count($usuarios)==0){
            $this->db->insert("usuarios", array("email_usuario" => $data->email_usuario));
            $id_usuario = $this->db->insert_id();
        }
        else{
            $id_usuario = $usuarios[0]->id_usuario;            
        }        

        $this->db->insert("usuarios_has_projetos", array("id_projeto"=>$_SESSION["projeto"]->id_projeto, "id_papel" => $data->id_papel, "id_usuario"=>$id_usuario));

        $this->db->insert("atividades", array(
                                            "descricao_atividade" => "O usuário <b>". $data->email_usuario . "</b> foi adicionado à equipe.",
                                            "data_atividade" => date("Y-m-d h:m:s"),
                                            "tipo_atividade" => "add_scrum_team",
                                            "id_projeto" => $_SESSION["projeto"]->id_projeto
                                            ));

        echo 'success';
    }

     public function getScrumTeam(){
        $this->db->select("u.id_usuario, u.nome_usuario, u.email_usuario, p.nome_papel");
        $this->db->from("usuarios u");
        $this->db->join("usuarios_has_projetos up", "up.id_usuario = u.id_usuario");
        $this->db->join("papeis p", "up.id_papel = p.id_papel");
        $this->db->where("up.id_projeto", $_SESSION["projeto"]->id_projeto);
        $this->db->where("u.ativo", 1);

        echo json_encode($this->db->get()->result());
    }

    public function getAllScrumTeam(){
        $this->db->select("u.id_usuario, u.nome_usuario, u.email_usuario, p.nome_papel, u.ativo");
        $this->db->from("usuarios u");
        $this->db->join("usuarios_has_projetos up", "up.id_usuario = u.id_usuario");
        $this->db->join("papeis p", "up.id_papel = p.id_papel");
        $this->db->where("up.id_projeto", $_SESSION["projeto"]->id_projeto);        

        echo json_encode($this->db->get()->result());
    }

    public function getDdlDevelopmentTeam(){
        $this->db->select("up.id_usuarios_has_projetos, u.nome_usuario, p.nome_papel");
        $this->db->from("usuarios u");
        $this->db->join("usuarios_has_projetos up", "up.id_usuario = u.id_usuario");
        $this->db->join("papeis p", "up.id_papel = p.id_papel");
        $this->db->where("up.id_projeto", $_SESSION["projeto"]->id_projeto);
        $this->db->where("u.ativo", 1);
        $this->db->where("(p.id_papel = 3 or p.id_papel = 4)");

        echo json_encode($this->db->get()->result());
    }    
}
