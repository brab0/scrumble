<div id="projeto-novo-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
        <section class="content-header">
            <h1>
                Adicionar Projeto
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Projetos</a></li>
                <li class="active">Novo Projeto</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">        
                <div class="col-md-12">
                    <div class="box box-primary">                
                        <form role="form" id="form-projeto">
                          <div class="box-body">
                            <div class="form-group">
                                <label class="control-label" for="name_project">Nome</label>
                                <input type="text" class="form-control" id="name_project" placeholder="Identificação do Projeto" data-required="projeto-group">
                            </div>                    
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control" id="descricao_project" rows="3" placeholder="Descreva o projeto sucintamente" data-required="projeto-group"></textarea>
                            </div>    
                            <div class="form-group">
                                <label class="control-label" for="url_project">Url</label>
                                <input type="text" class="form-control" id="url_project" placeholder="Url do Projeto">
                            </div>                    
                            <div class="form-group">
                                <label>Informações Adicionais</label>
                                <textarea class="form-control" id="infos_project" rows="3" placeholder="ex: urls, acessos dev etc"></textarea>
                            </div>  
                            <hr />                  
                            <div class="form-group">
                                <label class="control-label">Qual seu papel dentro do projeto?</label>
                                <select class="form-control" id="papel">
                                    <option value="1">Product Owner</option>
                                    <option value="2">Scrum Master</option>
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
        <span for="chkIrProjeto" class="text-muted pull-left" style="margin-left: 10px;margin-top: 6px;"><input type="checkbox" style="margin-right:5px" id="chkIrProjeto" checked/> Salvar e ir para o projeto</span>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnFecharModalProjeto">Fechar</button>
        <button type="button" class="btn btn-primary btn-main" id="btnSalvarProjeto">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->