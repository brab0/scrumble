<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sprint extends CI_Controller {

    private $view = array();

    public function main_content($slug_projeto) {
        $this->login_model->checkUserSession($slug_projeto);
        $this->view["mainContent"] = "pages/projeto/sprint/main";
        $this->view["custom_scripts"] = "pages/projeto/sprint/main_scripts";

        $this->load->view(TEMPLATE_PROJETO, $this->view);
    }

    public function sprint_planning($slug_projeto) {
        $this->login_model->checkUserSession($slug_projeto);
        $this->view["mainContent"] = "pages/projeto/sprint/sprint_planning";
        $this->view["custom_scripts"] = "pages/projeto/sprint/sprint_planning_scripts";

        $this->load->view(TEMPLATE_PROJETO, $this->view);
    }

    public function getDadosSprint() {
        $query = "select 
                        t1.id_sprint,
                        t1.slug_projeto,
                        t1.tamanho_sprint,
                        t1.objetivo_sprint,
                        t1.num_sprint,
                        t1.data_ini_sprint,
                        t1.data_fim_sprint,
                        t1.status_sprint,
                        t1.info_sprint,
                        ifnull(sum(t2.pontos_estoria),0) velocidade_sprint,
                        ifnull(t3.data_atual,'') data_atual,
                        ifnull(t3.dia_atual,'') dia_atual
                    from
                        (select 
                            s . *, p.slug_projeto
                        from
                            sprints s
                        inner join projetos p ON p.id_projeto = s.id_projeto
                        where
                            s.id_projeto = " . $_SESSION["projeto"]->id_projeto . "
                        order by s.id_sprint desc) t1

                    left join

                        (SELECT 
                            `s`.`id_sprint`,
                                sum(t.pontos_tarefa) pontos_estoria
                        FROM
                            `estorias` `e`
                        JOIN `sprints_has_estorias` `se` ON `se`.`id_estoria` = `e`.`id_estoria`
                        JOIN `sprints` `s` ON `s`.`id_sprint` = `se`.`id_sprint`
                        JOIN `tarefas` `t` ON `t`.`id_sprints_has_estorias` = `se`.`id_sprints_has_estorias`
                        WHERE `s`.`id_projeto` = " . $_SESSION["projeto"]->id_projeto . "
                                AND `status_sprint` != 'finalizado'
                        GROUP BY `se`.`id_sprints_has_estorias`) t2 
                    ON t1.id_sprint = t2.id_sprint
                    
                    left join                    
                        (SELECT t1.id_sprint, max(data_atual) data_atual, max(dia_atual) dia_atual
                            FROM
                            (
                                    select max(id_sprint) id_sprint 
                                    from sprints s
                                    WHERE `s`.`id_projeto` = " . $_SESSION["projeto"]->id_projeto . "
                            ) t1
                            inner join
                            (
                            SELECT data_status_tarefa data_atual,
                                       dia_sprint dia_atual,
                                   s.id_sprint
                            FROM `tarefas` `t`
                            JOIN `status_tarefas` `st` ON `st`.`id_tarefa` = `t`.`id_tarefa`
                            JOIN `sprints_has_estorias` `se` ON `se`.`id_sprints_has_estorias` = `t`.`id_sprints_has_estorias`
                            JOIN `sprints` `s` ON `s`.`id_sprint` = `se`.`id_sprint`
                            WHERE `s`.`id_projeto` = " . $_SESSION["projeto"]->id_projeto . "                            
                            ) t2
                            on t1.id_sprint = t2.id_sprint) t3
                    ON t1.id_sprint = t3.id_sprint

                    group by id_sprint
                    order by id_sprint desc";

        $sprint = new stdClass();

        $sprint->geral = $this->db->query($query)->row();

        if ($sprint->geral) {
            $query = "select status_tarefa, count(status_tarefa) qtd_tarefas, sum(pontos_tarefa) qtd_pontos
                        from
                        (select 
                                id_tarefa,
                                    pontos_tarefa,
                                    status_tarefa
                            from
                                (SELECT 
                                t.id_tarefa, pontos_tarefa, id_status_tarefas, status_tarefa
                                                FROM
                                                        `tarefas` `t`
                                                JOIN `status_tarefas` `st` ON `st`.`id_tarefa` = `t`.`id_tarefa`
                                                JOIN `sprints_has_estorias` `se` ON `se`.`id_sprints_has_estorias` = `t`.`id_sprints_has_estorias`
                                                JOIN `sprints` `s` ON `s`.`id_sprint` = `se`.`id_sprint`
                                                where
                                                        s.id_sprint = " . $sprint->geral->id_sprint . "
                                                order by id_status_tarefas desc) t1
                            group by id_tarefa) t2
                        group by status_tarefa";


            $status = new stdClass();

            $results = $this->db->query($query)->result();

            foreach ($results as $r) {
                switch ($r->status_tarefa) {
                    case "todo":
                        $status->todo = $r;
                        break;
                    case "andamento":
                        $status->andamento = $r;
                        break;
                    case "teste":
                        $status->teste = $r;
                        break;
                    case "feito":
                        $status->feito = $r;
                        break;
                }
            }

            $sprint->status = $status;
        }

        echo json_encode($sprint);
    }

    public function getEstoriasSprint() {
        $this->db->select("se.id_sprints_has_estorias, e.*, sum(t.pontos_tarefa) pontos_estoria");
        $this->db->from("estorias e");
        $this->db->join("sprints_has_estorias se", "se.id_estoria = e.id_estoria");
        $this->db->join("sprints s", "s.id_sprint = se.id_sprint");
        $this->db->join("tarefas t", "t.id_sprints_has_estorias = se.id_sprints_has_estorias");
        $this->db->where("s.id_sprint", $this->input->post("id_sprint"));
        $this->db->group_by("se.id_sprints_has_estorias");

        echo json_encode($this->db->get()->result());
    }
    
    public function editEstoria() {
        $response = new stdClass();
        
        $this->db->select("*");
        $this->db->from("estorias e");
        $this->db->join("sprints_has_estorias se", "se.id_estoria = e.id_estoria");                
        $this->db->where("se.id_sprints_has_estorias", $this->input->post("id_sprints_has_estorias"));
        
        $estoria = $this->db->get()->row();
        
        $this->db->select("*");
        $this->db->from("tarefas t");
        $this->db->join("usuarios_has_projetos up", "up.id_usuarios_has_projetos = t.id_usuarios_has_projetos");
        $this->db->join("usuarios u", "u.id_usuario = up.id_usuario");
        $this->db->where("t.id_sprints_has_estorias", $this->input->post("id_sprints_has_estorias"));
        
        $estoria->tarefas = $this->db->get()->result();
        
        echo json_encode($estoria);
    }

    public function getUltimaEstoria() {
        $this->db->select("e.*");
        $this->db->from("estorias e");
        $this->db->join("sprints_has_estorias se", "se.id_estoria = e.id_estoria", "left");
        $this->db->where("e.id_projeto", $_SESSION["projeto"]->id_projeto);
        $this->db->where("se.id_estoria is null");
        $this->db->order_by("prioridade_estoria", "asc");

        echo json_encode($this->db->get()->row());
    }

    public function salvar_sprint() {
        $data = json_decode(file_get_contents("php://input"), true);

        $this->db->where("id_projeto", $_SESSION["projeto"]->id_projeto);
        $num_sprint = $this->db->get("sprints")->num_rows() + 1;

        $this->db->insert("sprints", array_merge($data, array("num_sprint" => $num_sprint, "id_projeto" => $_SESSION["projeto"]->id_projeto)));

        echo $_SESSION["projeto"]->slug_projeto;
    }

    public function iniciar_sprint() {
        $this->db->where("id_sprint", $this->input->post("id_sprint"));
        $this->db->update("sprints", array("status_sprint" => "andamento"));

        echo $_SESSION["projeto"]->slug_projeto;
    }

    public function salvarPlanejamento() {
        $data = json_decode(file_get_contents("php://input"), true);

        $this->db->where("status_sprint", "planning");
        $this->db->order_by("id_sprint", "desc");

        $sprint = $this->db->get("sprints")->row();
        $data_ini = $sprint->data_ini_sprint;
        $id_sprint = $sprint->id_sprint;
        $estoria = $data["sprints_has_estorias"];
        
        if($estoria["id_sprints_has_estorias"]==""){
            $this->db->insert("sprints_has_estorias", $data["sprints_has_estorias"]);    
            $id = $this->db->insert_id();
        }
        else{
            $id = $estoria["id_sprints_has_estorias"];
        }
        
        $tarefas = $data["tarefas"];
        $insert = $tarefas["insert"];
        $update = $tarefas["update"];
        $remove = $tarefas["remove"];
        
        
        foreach ($insert as $ins) {
            $this->db->insert("tarefas", array_merge($ins, array("id_sprints_has_estorias" => $id)));
            $id_tarefa = $this->db->insert_id();
            $this->db->insert("status_tarefas", array("id_tarefa" => $id_tarefa, "data_status_tarefa" => $data_ini));
        }
        
        foreach ($remove as $rem) {
            $this->db->delete("tarefas", array("id_tarefa" => $rem));            
        }
        
        foreach ($update as $updt) {
            $this->db->where(array("id_tarefa"=>$updt["id_tarefa"]));
            $this->db->update("tarefas", array_merge($updt, array("id_sprints_has_estorias" => $id)));            
        }

        echo $id_sprint;
    }

    public function salvar_status_tarefa() {
        $data = json_decode(file_get_contents("php://input"));

        $this->db->where("id_status_tarefas", $data->id_status_tarefas);
        $this->db->update("status_tarefas", $data);

        echo 'success';
    }

    public function getSprintBurndown() {
        $id_sprint = $this->input->post("id_sprint");

        $query = "select ifnull(t2.pontos_tarefas,0) pontos_tarefas from
                    (
                        select dia_sprint
                        FROM `tarefas` `t`
                        JOIN `status_tarefas` `st` ON `st`.`id_tarefa` = `t`.`id_tarefa`
                        JOIN `sprints_has_estorias` `se` ON `se`.`id_sprints_has_estorias` = `t`.`id_sprints_has_estorias`
                        WHERE se.id_sprint = " . $id_sprint . "
                        group by dia_sprint
                    ) t1
                  left join 
                    (
                        select dia_sprint, sum(pontos_tarefa) pontos_tarefas
                        FROM `tarefas` `t`
                        JOIN `status_tarefas` `st` ON `st`.`id_tarefa` = `t`.`id_tarefa`
                        JOIN `sprints_has_estorias` `se` ON `se`.`id_sprints_has_estorias` = `t`.`id_sprints_has_estorias`
                        WHERE se.id_sprint = " . $id_sprint . "
                        and status_tarefa != 'feito'
                        group by dia_sprint
                    ) t2
                    on t1.dia_sprint = t2.dia_sprint";

        echo json_encode($this->db->query($query)->result());
    }

    public function getStoryboard() {
        $this->db->select("se.id_sprints_has_estorias, e.*, sum(t.pontos_tarefa) pontos_estoria");
        $this->db->from("estorias e");
        $this->db->join("sprints_has_estorias se", "se.id_estoria = e.id_estoria");
        $this->db->join("sprints s", "s.id_sprint = se.id_sprint");
        $this->db->join("tarefas t", "t.id_sprints_has_estorias = se.id_sprints_has_estorias");
        $this->db->where("s.id_sprint", $this->input->post("id_sprint"));
        $this->db->group_by("se.id_sprints_has_estorias");

        $estorias_query = $this->db->get()->result();
        $arrEstoria = array();

        foreach ($estorias_query as $e) {
            $estorias = $e;
            $estorias->tarefas = $this->getTarefasByEstoria($e->id_sprints_has_estorias);

            array_push($arrEstoria, $estorias);
        }

        echo json_encode($arrEstoria);
    }

    public function getTarefasByEstoria($estoria) {
        $tarefas = new stdClass();

        $query = "select id_status_tarefas, descricao_tarefa, pontos_tarefa, nome_usuario, dia_sprint, status_tarefa
                from(
                SELECT 
                    t.id_tarefa, descricao_tarefa, pontos_tarefa, nome_usuario, id_status_tarefas, dia_sprint, status_tarefa
                FROM
                    `tarefas` `t`
                        JOIN
                    `usuarios_has_projetos` `up` ON `up`.`id_usuarios_has_projetos` = `t`.`id_usuarios_has_projetos`
                        JOIN
                    `usuarios` `u` ON `u`.`id_usuario` = `up`.`id_usuario`
                        JOIN
                    `status_tarefas` `st` ON `st`.`id_tarefa` = `t`.`id_tarefa`
                WHERE `id_sprints_has_estorias` = " . $estoria . "
                        order by dia_sprint desc) t1
                group by t1.id_tarefa";

        $results = $this->db->query($query)->result();
        $tarefas->todo = array();
        $tarefas->andamento = array();
        $tarefas->teste = array();
        $tarefas->feito = array();

        foreach ($results as $r) {
            switch ($r->status_tarefa) {
                case "todo":
                    $tarefas->todo[] = $r;
                    break;
                case "andamento":
                    $tarefas->andamento[] = $r;
                    break;
                case "teste":
                    $tarefas->teste[] = $r;
                    break;
                case "feito":
                    $tarefas->feito[] = $r;
                    break;
            }
        }

        return $tarefas;
    }

    public function cron_next_sprint_day() {
        $query = "select t1.`id_tarefa`, t1.`status_tarefa`, (t1.dia_sprint + 1) dia_sprint
                    from (SELECT 
                                                `st`.`id_tarefa`, `st`.`status_tarefa`, dia_sprint
                                        FROM
                                                `status_tarefas` `st`
                                                        INNER JOIN
                                                `tarefas` `t` ON `t`.`id_tarefa` = `st`.`id_tarefa`
                                                        INNER JOIN
                                                `sprints_has_estorias` `se` ON `t`.`id_sprints_has_estorias` = `se`.`id_sprints_has_estorias`
                                                        INNER JOIN
                                                `sprints` `s` ON `se`.`id_sprint` = `s`.`id_sprint`
                                        WHERE
                                                `st`.`id_tarefa` = `t`.`id_tarefa`
                                        AND `status_sprint` = 'andamento'
                    order by dia_sprint desc) t1
                    group by id_tarefa";

        $tarefas = $this->db->query($query)->result_array();

        $hoje = array("data_status_tarefa" => "2015-11-16");

        $this->db->trans_start();

        foreach ($tarefas as $t) {
            $this->db->insert("status_tarefas", array_merge($t, $hoje));
        }

        $this->db->trans_complete();
    }
    
    public function cron_next_sprint_day_by_id($id_sprint) {
        $query = "select t1.`id_tarefa`, t1.`status_tarefa`, (t1.dia_sprint + 1) dia_sprint
                    from (SELECT 
                                                `st`.`id_tarefa`, `st`.`status_tarefa`, dia_sprint
                                        FROM
                                                `status_tarefas` `st`
                                                        INNER JOIN
                                                `tarefas` `t` ON `t`.`id_tarefa` = `st`.`id_tarefa`
                                                        INNER JOIN
                                                `sprints_has_estorias` `se` ON `t`.`id_sprints_has_estorias` = `se`.`id_sprints_has_estorias`
                                                        INNER JOIN
                                                `sprints` `s` ON `se`.`id_sprint` = `s`.`id_sprint`
                                        WHERE
                                                `st`.`id_tarefa` = `t`.`id_tarefa`
                                        AND s.id_sprint = $id_sprint
                    order by dia_sprint desc) t1
                    group by id_tarefa";

        $tarefas = $this->db->query($query)->result_array();

        $hoje = array("data_status_tarefa" => "2015-11-11");

        $this->db->trans_start();

        foreach ($tarefas as $t) {
            $this->db->insert("status_tarefas", array_merge($t, $hoje));
        }

        $this->db->trans_complete();
    }
    
}
