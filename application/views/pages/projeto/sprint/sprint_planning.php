<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="display:inline-block">
        Sprint
        <small>Sprint Planning</small>
    </h1>
    <button class="btn btn-primary btn-xs" id="iniciar-sprint" style="margin-top:-8px; margin-left:10px">Iniciar Sprint</button>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Sprint</a></li>
        <li class="active">Sprint Planning</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->    
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary" id="box-sprint" data-id="">
                <div class="box-header with-border">
                    <h3 class="box-title" id="num_sprint"></h3>
                </div>        
                <div class="box-body">            
                    <strong><i class="fa fa-book margin-r-5"></i>  Objetivo do Sprint</strong>
                    <p class="text-muted" id="objetivo_sprint">              
                    </p>
                    <hr>                    
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Período</strong>  
                    <p class="text-muted" id="periodo_sprint"></p>                        
                    <hr>  
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Velocidade Inicial</strong>  
                    <p class="text-muted" id="velocidade_sprint"></p>                        
                    <hr>  
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Informações Adicionais</strong>
                    <p class="text-muted" id="info_sprint">              
                    </p>            
                </div><!-- /.box-body -->
            </div><!-- /.box -->                      
        </div><!-- /.box -->                      
        <div class="col-md-9">
            <div class="box box-primary" id="box-sprint-backlog">
                <div class="box-header with-border">
                    <h3 class="box-title">Sprint Backlog</h3>    
                    <button class="btn btn-primary btn-xs" style="margin-top:-6px; margin-left:10px" id="planejar-estoria">Adicionar Estórias e Tarefas</button>
                </div><!-- /.box-header -->
                <!-- form start -->        
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <th>Estória</th>
                        <th class="text-center">Esforço</th>
                        <th class="text-center"></th>
                        </thead>
                        <tbody>                      
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div><!-- /.row -->
</section><!-- /.content -->

<?php $this->load->view("modals/estorias_planning"); ?>
