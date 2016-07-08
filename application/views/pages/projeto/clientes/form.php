<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Estórias
        <small>Nova Estória</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Estórias</a></li>
        <li class="active">Nova Estória</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Preencha o formulário abaixo para cadastrar uma nova estória</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="form-estoria">
                  <div class="box-body">
                    <div class="form-group">
                        <label class="control-label" for="name_story">Nome</label>
                        <input type="text" class="form-control" id="name_story" placeholder="Identificação da Estória" data-required="true">
                    </div>                    
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" id="descricao_story" rows="3" placeholder="Descreva o projeto sucintamente" data-required="true"></textarea>
                    </div> 
                  </div><!-- /.box-body -->                  
                  <div class="box-footer">
                    <button type="button" class="btn btn-default">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarEstoria">Salvar</button>
                  </div>
                </form>
            </div>
        </div>        
    </div>
</section><!-- /.content -->