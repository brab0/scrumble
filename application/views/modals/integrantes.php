<div id="integrante-novo-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="height: 325px;">      
      <div class="modal-body" style="height: 260px;">
        <section class="content-header">
            <h1>
                Adicionar Integrante
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Scrum Team</a></li>
                <li class="active">Novo Integrante</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" style="height: auto !important;min-height: 100px !important;">
            <div class="row">        
                <div class="col-md-12">
                    <div class="box box-primary">                
                        <form role="form" id="form-integrante">
                          <div class="box-body">
                            <div class="form-group has-feedback">
                                <label>Email do novo integrante</label>
                                <input type="email" class="form-control" placeholder="Email" id="email-usuario" data-required="scrum-team-group">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Papel dentro do Projeto</label>
                                <select class="form-control" id="id-papel" data-required="scrum-team-group">
                                    <option value="1">Product Owner</option>
                                    <option value="2">Scrum Master</option>
                                    <option value="3">Team Developer</option>
                                    <option value="4">Herói</option>
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
        <span for="chkContinuarIntegrante" class="text-muted pull-left" style="margin-left: 10px;margin-top: 6px;"><input type="checkbox" style="margin-right:5px" id="chkContinuarIntegrante" checked/> Continuar adicionando</span>     
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnFecharModalIntegrante">Fechar</button>
        <button type="button" class="btn btn-primary btn-main" id="btnAdicionarIntegrante">Adicionar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
