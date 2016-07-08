<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Backlog extends CI_Controller {

    private $view = array();

    public function main_content($slug_projeto) {
        $this->login_model->checkUserSession($slug_projeto);

        $this->view["mainContent"] = "pages/projeto/product_backlog/main";
        $this->view["custom_scripts"] = "pages/projeto/product_backlog/scripts";

        $this->load->view(TEMPLATE_PROJETO, $this->view);
    }

    public function salvar_estoria() {
        $data = json_decode(file_get_contents("php://input"), true);
        $prioridade = 0;

        if ($data["posicao_estoria"] == "inicio") {
            $prioridade = 0;
        } else if ($data["posicao_estoria"] == "meio") {
            $this->db->where("id_projeto", $_SESSION["projeto"]->id_projeto);
            $prioridade = round($this->db->get("estorias")->num_rows() / 2);
        } else {
            $this->db->where("id_projeto", $_SESSION["projeto"]->id_projeto);
            $prioridade = $this->db->get("estorias")->num_rows();
        }
        $this->db->insert("estorias", array("data_estoria" => date("Y-m-d"), "id_usuario" => $_SESSION["usuario"]->id_usuario, "id_projeto" => $_SESSION["projeto"]->id_projeto, "descricao_estoria" => $data["descricao_estoria"], "info_estoria" => $data["info_estoria"], "prioridade_estoria" => $prioridade));

        $this->db->insert("atividades", array(
            "descricao_atividade" => "Uma nova estória foi adicionada por <b>" . $_SESSION["usuario"]->nome_usuario . "</b> ao product backlog.",
            "data_atividade" => date("Y-m-d h:m:s"),
            "tipo_atividade" => "add_estoria",
            "id_projeto" => $_SESSION["projeto"]->id_projeto
        ));
        echo 'success';
    }

    public function salvar_prioridade_estoria() {
        $data = json_decode(file_get_contents("php://input"));

        foreach ($data as $d) {
            $this->db->where("id_estoria", $d->id_estoria);
            $this->db->update("estorias", $d);
        }

        echo 'success';
    }
    
    public function edit_estoria() {
        $data = json_decode(file_get_contents("php://input"));
        
        $this->db->where("id_estoria", $data->id_estoria);
        $this->db->update("estorias", $data);

        echo 'success';
    }
    
    public function remove_estoria() {
        
        $this->db->delete("estorias", array("id_estoria" => $this->input->post("id_estoria")));

        echo 'success';
    }

    public function getEstoriasProjeto() {
        $this->db->select("e.*");
        $this->db->from("estorias e");
        $this->db->join("sprints_has_estorias se", "se.id_estoria = e.id_estoria", "left");
        $this->db->where("id_projeto", $_SESSION["projeto"]->id_projeto);
        $this->db->where("se.id_estoria is null");
        $this->db->order_by("prioridade_estoria", "asc");

        echo json_encode($this->db->get()->result());
    }

}
