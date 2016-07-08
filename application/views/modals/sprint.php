<div id="sprint-novo-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">      
            <div class="modal-body">
                <section class="content-header">
                    <h1>
                        Novo Sprint
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Sprint</a></li>
                        <li class="active">Novo Sprint</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">        
                        <div class="col-md-12">
                            <div class="box box-primary">                
                                <form role="form" id="form-sprint">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Objetivo</label>
                                            <textarea class="form-control" id="txt_objetivo_sprint" rows="3" placeholder="Descreva q quê este sprint se propõe" data-required="sprint-group"></textarea>
                                        </div> 
                                        <div class="row">  
                                            <div class="col-md-6 form-group">
                                                <label>Data de Início:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="txt_data_ini_sprint" readonly style="background:#fff">
                                                    <input type="hidden" id="hidden_data_ini_sprint"/>
                                                    <input type="hidden" id="hidden_data_fim_sprint" />
                                                </div><!-- /.input group -->
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Tamanho:</label>
                                                <div class="form-group">                                                    
                                                    <select class="form-control" id="ddlTamanhoSprint">
                                                        <option value="1">Uma Semana</option>
                                                        <option value="2">Duas Semanas</option>
                                                        <option value="3">Três Semanas</option>
                                                        <option value="4">Quatro Semanas</option>
                                                        <option value="5">Cinco Semanas</option>
                                                        <option value="6">Seis Semanas</option>
                                                    </select>
                                                </div><!-- /.input group -->
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Informações Adicionais</label>
                                            <textarea class="form-control" id="info_sprint" rows="3" placeholder="ex: urls, acessos dev etc"></textarea>
                                        </div>                              
                                    </div><!-- /.box-body -->
                                </form>
                            </div>            
                        </div>        
                    </div>
                </section><!-- /.content -->
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnFecharModalSprint">Fechar</button>
                <button type="button" class="btn btn-primary btn-main" id="btnSalvarSprint">Salvar e Começar Sprint Planning</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->