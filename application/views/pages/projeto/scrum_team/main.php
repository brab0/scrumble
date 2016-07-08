<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="display:inline-block">
        Scrum Team
    </h1>
    <button class="btn btn-primary btn-xs" id="add-integrante" style="margin-top:-8px; margin-left:10px">Novo Integrante</button>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Scrum Team</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box" id="box-team">                
                <div class="box-body" style="padding: 0 5px;">
                  <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th style="width:40%">Integrante</th>
                                <th style="width:30%">Email</th>
                                <th style="width:15%">Papel</th>                                
                                <th style="width:15%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->                    
            </div>
        </div>        
    </div>
</section><!-- /.content -->
<?php $this->load->view("modals/integrantes"); ?>