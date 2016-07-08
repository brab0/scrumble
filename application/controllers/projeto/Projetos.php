<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projetos extends CI_Controller {
    public function salvar_projeto()
    {   
		$this->load->helper("slugify");
		        
        $data = json_decode(file_get_contents("php://input"), true);               
		$projeto = $data["projeto"];
		$slug = slugify($projeto["nome_projeto"]);
		
        $this->db->insert("projetos", array_merge($projeto, array("slug_projeto"=> $slug)));
        $id = $this->db->insert_id();

        $this->db->insert("usuarios_has_projetos", array("id_projeto"=>$id, "id_papel" => $data["papel"], "id_usuario"=>$_SESSION["usuario"]->id_usuario));
        
        echo $slug;
    }
}
