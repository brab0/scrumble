<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
    public function check_credentials($data)
    {        
        $this->db->select("email_usuario,nome_usuario,id_usuario");        
        $this->db->where("email_usuario", $data->email_usuario);
        $this->db->where("senha_usuario", $data->senha_usuario);
        $this->db->where("ativo", 1);
        
        return $this->db->get("usuarios");        
    }    

    public function getUserCredentials($id){        
        $this->db->where('id_usuario', $id);
        $this->db->update('usuarios', array('hash_usuario' => mt_rand()));

        $this->db->select("email_usuario,nome_usuario,hash_usuario,id_usuario");        
        $this->db->where("id_usuario", $id);
        $this->db->where("ativo", 1);
        $r = $this->db->get("usuarios")->result();
        return $r[0];
    }

    public function checkUserSession($slug_projeto = null){        
        if(isset($_SESSION["usuario"])){  
            $data = $_SESSION["usuario"];   
            
            if($slug_projeto!=null){
                $this->db->join("usuarios_has_projetos up", "up.id_usuario = u.id_usuario");
                $this->db->join("papeis p", "p.id_papel = up.id_papel");
                $this->db->join("projetos pr", "pr.id_projeto = up.id_projeto");
                $this->db->where("pr.slug_projeto", $slug_projeto);
            }
            $this->db->where("email_usuario", $data->email_usuario);
            $this->db->where("hash_usuario", $data->hash_usuario);            
            $this->db->where("ativo", 1);            
            
            $r = $this->db->get("usuarios u")->result();

            if(count($r) == 0){              
                exit("You shall not pass!!!");
            }
            else if($slug_projeto != null){
				$projeto = new stdClass();
				$projeto->id_projeto = $r[0]->id_projeto;
				$projeto->slug_projeto = $r[0]->slug_projeto;
				$projeto->nome_projeto = $r[0]->nome_projeto;
				
				$_SESSION["projeto"] = $projeto;				
				
                $_SESSION["usuario"]->papel = $r[0]->nome_papel;
            }
        }
        else{
            exit("You shall not pass!!!");
        }
    }
}
