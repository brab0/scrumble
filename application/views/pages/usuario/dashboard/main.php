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
      <div class="col-md-6">  
        <div id="lista-projetos" class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Projetos</h3>
            <button class="btn btn-primary btn-xs add-projeto" style="margin:-5px 0 0 10px">Adicionar</button>
          </div>        
          <div class="box-body">            
          </div>            
        </div> 
      </div>
      <div class="col-md-6">
        <div class="box box-primary" id="box-atividades">
          <div class="box-header with-border">
            <h3 class="box-title">Últimas atividades dentro do sistema</h3>
          </div><!-- /.box-header -->
          <!-- form start -->        
          <div class="box-body">            
          </div><!-- /.box-body -->        
        </div>        
      </div> 
    </div><!-- /.row -->
</section><!-- /.content -->     

