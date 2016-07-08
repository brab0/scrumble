<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projetos extends CI_Controller {
    private $view = array();
    
    public function dashboard($projeto = null)
    {       
        $this->view["mainContent"] = "pages/projetos/dashboard/dashboard";
        $this->view["javascripts"] = "pages/projetos/dashboard/dashboard_scripts";
        
        $this->load->view(TEMPLATE_PROJECT, $this->view);
    }

    public function product_backlog($projeto = null)
    {       
        $this->view["mainContent"] = "pages/projetos/product_backlog/main";
        $this->view["javascripts"] = "pages/projetos/product_backlog/scripts";
        
        $this->load->view(TEMPLATE_PROJECT, $this->view);
    }

    // public function dashboard($projeto = null)
    // {       
    //     $this->view["mainContent"] = "pages/projetos/dashboard";
    //     $this->view["javascripts"] = "pages/projetos/dashboard_scripts";
        
    //     $this->load->view(TEMPLATE_PROJECT, $this->view);
    // }

    // public function dashboard($projeto = null)
    // {       
    //     $this->view["mainContent"] = "pages/projetos/dashboard";
    //     $this->view["javascripts"] = "pages/projetos/dashboard_scripts";
        
    //     $this->load->view(TEMPLATE_PROJECT, $this->view);
    // }

    // public function dashboard($projeto = null)
    // {       
    //     $this->view["mainContent"] = "pages/projetos/dashboard";
    //     $this->view["javascripts"] = "pages/projetos/dashboard_scripts";
        
    //     $this->load->view(TEMPLATE_PROJECT, $this->view);
    // }

    public function form()
    {       
        $this->view["mainContent"] = "pages/projetos/form";
        $this->view["javascripts"] = "pages/projetos/form_scripts";
        
        $this->load->view(TEMPLATE_PROJECT, $this->view);
    }

    public function salvar_projeto()
    {           
        $data = json_decode(file_get_contents("php://input"));
        $this->db->insert("projects", $data);
        echo 'success';
    }
}
