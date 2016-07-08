<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="display:inline-block">
        Sprint
    </h1>
    <button class="btn btn-primary btn-xs" id="novo-sprint" style="margin: -10px 0 0 20px;">Novo Sprint</button>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Sprint</a></li>        
    </ol>
</section>

<!-- Main content -->
<section class="content" id="main-sprint">    
    <div class="hidden" id="wrap-sprint">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-grey" id="info-box-todo">
                    <span class="info-box-icon"><i class="fa fa-archive"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ToDo</span>
                        <span class="info-box-qtd-pontos info-box-number"></span>
                        <span class="info-box-qtd-tarefas progress-description"></span>
                    </div><!-- /.info-box-content -->
                </div> 
            </div> 
            <div class="col-md-3">
                <div class="info-box bg-blue" id="info-box-andamento">
                    <span class="info-box-icon"><i class="fa fa-play"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Em Andamento</span>
                        <span class="info-box-qtd-pontos info-box-number"></span>
                        <span class="info-box-qtd-tarefas progress-description"></span>
                    </div><!-- /.info-box-content -->
                </div>
            </div>       
            <div class="col-md-3">
                <div class="info-box bg-yellow" id="info-box-teste">
                    <span class="info-box-icon"><i class="fa fa-recycle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Em Teste</span>
                        <span class="info-box-qtd-pontos info-box-number"></span>
                        <span class="info-box-qtd-tarefas progress-description"></span>
                    </div><!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-green" id="info-box-feito">
                    <span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Feito</span>
                        <span class="info-box-qtd-pontos info-box-number"></span>
                        <span class="info-box-qtd-tarefas progress-description"></span>
                    </div><!-- /.info-box-content -->
                </div> 
            </div> 
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary" id="box-sprint">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="num_sprint"></h3>
                    </div>        
                    <div class="box-body" style="min-height: 280px; padding:20px">
                            <strong><i class="fa fa-book margin-r-5"></i>  Objetivo do Sprint</strong>
                            <p class="text-muted" id="objetivo_sprint"></p>                                         
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Período</strong>  
                            <p class="text-muted" id="periodo_sprint"></p>                                            
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Velocidade Inicial</strong>  
                            <p class="text-muted" id="velocidade_sprint"></p>                        
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Informações Adicionais</strong>
                            <p class="text-muted" id="info_sprint"></p>                    
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-warning btn-xs" id="finalizar-sprint">Finalizar Sprint</button>           
                    </div>
                </div><!-- /.box -->                            
            </div>
            <div class="col-md-8 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom" style="height: 368px;">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#revenue-chart" data-toggle="tab">Burndown Chart</a></li>
                        <li class="pull-left header"><i class="fa fa-database"></i> Sprint Backlog </li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div>           
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" id="box-storyboard">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="title-storyboard">Storyboard - <span id="dia-atual"></span><span id="data-atual"></span></h3>
                        <label for="chkMinhasEstorias" class="pull-right" style="vertical-align: top;font-weight: normal;"><input type="checkbox" id="chkMinhasEstorias" style="vertical-align: top;font-weight: normal;"/> Mostar Somente minhas tarefas</label>
                    </div>                 
                    <div class="box-body">
                        <table>
                            <thead>
                            <th>To Do</th>
                            <!-- <th>To Do</th> -->
                            <th>Em Andamento</th>
                            <th>Testando</th>
                            <th>Feito</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>        
                </div>        
            </div> 
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->
<style>
    #box-storyboard .box-body{
        min-height:500px
    }

    #box-storyboard .box-body table{
        width:100%;
        min-height: 500px;
    }

    #box-storyboard .box-body table tbody tr td,
    #box-storyboard .box-body table thead th{
        width:20%;
        text-align:center;
        vertical-align: middle;
    }    

    thead tr{
        border-bottom: 2px solid #e0e0e0
    }        

    tbody tr{
        border-bottom: 1px dotted #D5D5D5
    }

    td, th{
        border-right:1px solid #eee;
    }

    th{
        padding-bottom:6px
    }

    td{
        padding:6px 0
    }

    td:last-child, th:last-child{
        border-right:0 !important;
    }

    #box-storyboard .box-body table tbody tr td ul{
        padding:5px;
        margin:0;
        overflow:auto;
    }

    #box-storyboard .box-body table tbody tr td li{
        padding: 5px;
        margin: 2px;
        list-style: none;
        background: rgb(253, 255, 185);
        border: 1px solid #f0f0f0;
        min-height: 60px;
        vertical-align: middle;
        cursor: -webkit-grab;
        width: 48%;
        font-size: 12px;
        display: inline-block;
    }

    #box-storyboard .box-body table tbody tr td li p, #box-storyboard .box-body table tbody tr td li h5{
        margin: 5px;
		line-height: 16px;
		font-size: 13px;
		color: #000;
		font-weight: lighter;
    }

    #box-storyboard .box-body table tbody tr td li h6{
        font-weight: bold;
        padding: 0 0 5px;
        margin: 0;
        border-bottom: 1px dotted #c9c9c9;
        font-size: 12px;
    }        

    td.estoria div h4{padding: 10px 10px 10px 0;}

    td.estoria div p{padding: 10px 10px 10px 0; font-size:14px; font-style: italic;}

    .sort-highlight{
        background:#fafafa !important;
        border:2px dashed #ddd!important;
    }

    .ui-sortable-helper{
        -webkit-box-shadow: 1px 0px 28px -9px rgba(0,0,0,0.6);
        -moz-box-shadow: 1px 0px 28px -9px rgba(0,0,0,0.6);
        box-shadow: 1px 0px 28px -9px rgba(0,0,0,0.6);
    }
    .edit-estoria{    	
    	font-size: 16px;
    }
</style>
<?php $this->load->view("modals/estorias_planning"); ?>
<?php $this->load->view("modals/sprint"); ?>