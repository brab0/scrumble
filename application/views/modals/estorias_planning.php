<div id="estorias-planning-modal" class="modal fade">
    <div class="modal-dialog" style="width: 770px;">
        <div class="modal-content" style="width: 770px;">      
            <div class="modal-body">
                <section class="content-header">
                    <h1>
                        Planejamento de Estórias
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Sprint Planning</a></li>
                        <li class="active">Nova Tarefa</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">        
                        <div class="col-md-12">
                            <div class="box box-primary">                        
                                <h4 id="estoria_planning_descricao" style="padding: 0 10px" data-id=""></h4>
                                <hr style="margin:0"/>
                                <form role="form" id="form-estoria" data-status="" data-id-estoria=""> 
                                    <div class="box-body">
                                        <div class="form-group"> 
                                            <label>Tarefa</label>
                                            <textarea class="form-control" id="descricao_tarefa" rows="3" placeholder="O quê será necessário para desenvolver a estória?" data-required="sprint-backlog-group"></textarea>
                                        </div>                            
                                        <div class="form-group"> 
                                            <label>Usuário</label>
                                            <select class="form-control" id="usuario_tarefa" data-required="sprint-backlog-group">                                    
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="button" class="pull-right btn btn-primary btn-xs" id="btnAddTarefa">Adicionar</button>
                                    </div>                                            
                                </form>
                            </div>
                            <div class="box" id="box-tarefas">                
                                <div class="box-body" style="padding: 0 5px;">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th style="width:20%">Responsável</th>
                                                    <th style="width:60%">Tarefa</th>                                  
                                                    <th style="width:10%">Pts</th>
                                                    <th style="width:10%">Tipo</th>
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
            </div>
            <div class="modal-footer">        
                <span for="chkContinuarEstoria" class="text-muted pull-left" style="margin-left: 10px;margin-top: 6px;"><input type="checkbox" style="margin-right:5px" id="chkContinuarEstoria" /> Salvar e planejar próxima estória</span>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnFecharModalPlanning">Fechar</button>
                <button type="button" class="btn btn-primary btn-main" id="btnSalvarPlanejamento">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

