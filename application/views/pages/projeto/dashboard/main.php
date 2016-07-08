<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary" id="box-projeto">
          <div class="box-header with-border">
            <h3 class="box-title" id="nome_projeto"></h3>
          </div>        
          <div class="box-body">            
            <strong><i class="fa fa-book margin-r-5"></i>  Descrição</strong>
            <p class="text-muted" id="descricao_projeto">              
            </p>
            <hr>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Url</strong>
            <p class="text-muted" id="url_projeto"></p>            
            <hr>            
            <strong><i class="fa fa-map-marker margin-r-5"></i> Sprint Atual</strong>  
            <span class="pull-right" style="color: #838383;font-size: 12px;">01/02 - 14/02</span>
            <br clear="both" />
            <p class="text-muted" id="sprint-projeto"></p>
            <a href="#" class="link pull-right">Ver Detalhes</a>
            <br clear="both" />
            <hr>  
            <strong><i class="fa fa-map-marker margin-r-5"></i> Informações Adicionais</strong>
            <p class="text-muted" id="infos-projeto" style="text-overflow: ellipsis;overflow: hidden;">              
            </p>
            <hr> 
            <button class="btn btn-primary btn-xs" id="editar-projeto">Editar Projeto</button>           
          </div><!-- /.box-body -->
        </div><!-- /.box -->      
        <div class="box box-success" id="box-scrum-team">
            <div class="box-header with-border">
              <h3 class="box-title">Scrum Team</h3>
              <div class="box-tools pull-right">
                <span class="label label-success" id="qtd-integrantes"></span>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                
              </ul><!-- /.users-list -->
            </div><!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary btn-xs" id="add-integrante">Adicionar Integrante</button>              
            </div><!-- /.box-footer -->
        </div>
      </div>
      <div class="col-md-9 connectedSortable">        
        <div class="nav-tabs-custom">            
          <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Burndown Chart</a></li>
              <li class="pull-left header"><i class="fa fa-database"></i> Product Backlog <button class="btn btn-primary btn-xs" style="margin-left: 10px;" id="add-estoria">Adicionar Estória</button></li>
          </ul>
          <div class="tab-content no-padding">              
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
          </div>
        </div><!-- /.nav-tabs-custom -->            
      </div><!-- /.Left col -->      
      <div class="col-md-9">
        <div class="box box-primary" id="box-atividades">
          <div class="box-header with-border">
            <h3 class="box-title">Últimas atividades dentro do sistema</h3>
          </div><!-- /.box-header -->              
          <div class="box-body">            
          </div><!-- /.box-body -->        
        </div>        
      </div> 
    </div><!-- /.row -->
</section><!-- /.content -->
<?php $this->load->view("modals/integrantes"); ?>
<?php $this->load->view("modals/estorias"); ?>
