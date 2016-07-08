<div id="modal-estorias" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
        <section class="content-header">
            <h1>
                Estórias
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Product Backlog</a></li>
                <li class="active">Nova Estória</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">        
                <div class="col-md-12">
                    <div class="box box-primary">                        
                        <form role="form" id="form-estoria">
                          <div class="box-body">
                            <input type="hidden" id="id-estoria" />
                            <div class="form-group"> 
                                <label>Descrição</label>                                                    
                                <textarea class="form-control" id="descricao_estoria" rows="4" placeholder="Uma estória completa deve conter: onde, quem, o quê e por quê." data-required="product-backlog-group"></textarea>
                            </div>
                            <div class="form-group"> 
                                <label>Informações Adicionais</label>                                                    
                                <textarea class="form-control" id="info_estoria" rows="4" placeholder="Especifique detalhes importantes da estória"></textarea>
                            </div>
                            <div class="form-group"> 
                                <label>Posição no Backlog</label>                                                    
                                <select class="form-control" id="posicao_estoria">
                                    <option value="inicio">No Início</option>
                                    <option value="meio">No Meio</option>
                                    <option value="final">No Final</option>
                                </select>
                            </div>
                          </div><!-- /.box-body -->                                            
                        </form>
                    </div>
                </div>        
            </div>
        </section><!-- /.content -->
      </div>
      <div class="modal-footer">
        <label for="chkContinuar" class="text-muted pull-left" style="font-weight:normal; margin-left: 10px;margin-top: 6px;"><input type="checkbox" style="margin-right:5px" id="chkContinuar" checked/> Continuar adicionando</label>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnFecharModalEstoria">Fechar</button>
        <button type="button" class="btn btn-primary btn-main" id="btnSalvarEstoria">Salvar</button>
        <button type="button" class="btn btn-primary hidden" id="btnEditEstoria">Salvar</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

