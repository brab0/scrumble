<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Product Backlog
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Backlog</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">      
      <div class="col-md-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
          <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Burndown Chart</a></li>              
              <li class="pull-left header"><i class="fa fa-database"></i> Quantidade de Estórias</li>
          </ul>
          <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
          </div>
        </div><!-- /.nav-tabs-custom -->            
      </div><!-- /.Left col -->      
      <div class="col-md-12">
        <div class="box box-primary" id="box-estorias">
          <div class="box-header with-border">
            <h3 class="box-title">Estórias do sistema</h3>
            <button class="btn btn-primary btn-xs" style="margin-left:10px; margin-top:-4px" id="add-estoria">Adicionar</button>
          </div><!-- /.box-header -->
          <!-- form start -->        
          <div class="box-body">  
              <ul class="product-backlog-list ui-sortable row">                  
              </ul>
          </div><!-- /.box-body -->        
        </div>        
      </div> 
    </div><!-- /.row -->
</section><!-- /.content -->
<style>
    .handle{
        margin-right: 10px;
        cursor: move;
    }
    
    .product-backlog-list{
        padding: 0;
        margin: -10px;
        overflow: auto;
    }
    
    .product-backlog-list li{
        list-style: none;        
        border-bottom: 1px solid #f0f0f0;
        padding:15px 20px;        
    }  
    
    .ui-sortable-helper{
        background: #fff;
        box-shadow: 0px 0px 20px -8px #444;
    }    
    
    .edit_estoria{                
        display: inline-block;
        margin-right: 4px;
    }    

</style>
<?php $this->load->view("modals/estorias"); ?>
