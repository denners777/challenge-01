<div class="well collapse" id="forms">
    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active">
            <a href="#cliente1" aria-controls="cliente1" role="tab" data-toggle="tab">Dados do Cliente</a>
        </li>
        <li role="presentation">
            <a href="#cliente2" aria-controls="cliente2" role="tab" data-toggle="tab">Endereço do Cliente</a>
        </li>
        <li role="presentation">
            <a href="#cliente3" aria-controls="cliente3" role="tab" data-toggle="tab">Dados Pessoais e Profissionais do Cliente</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <?php echo form_open('clientes/save', ['class' => 'form-horizontal', 'autocomplete' => 'off', 'onsubmit' => 'return validaForm(this);', 'novalidate' => 'novalidate'] ); ?>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="cliente1">
            <div class="row br_top_tabs">
                <fieldset class="col-lg-4 col-lg-offset-1">

                    <input type="hidden" id="id" name="id" value="" />
                    <input type="hidden" id="baseUrl" value="<?php echo site_url('clientes'); ?>" />

                    <div class="form-group">
                        <label for="cpf" class="col-sm-2 control-label">CPF *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control maskCpf" id="cpf" name="cpf" maxlength="11" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha" class="col-sm-2 control-label">Senha *</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="senha" name="senha" maxlength="32" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Nome *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="255" required="required" />
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4 col-lg-offset-1">
                    <div class="form-group">
                        <label for="telefone" class="col-sm-2 control-label">Telefone *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control maskPhone" id="telefone" name="telefone" maxlength="45" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">E-mail *</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" maxlength="255" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dt_nasc" class="col-sm-2 control-label">Data de Nascimento *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control maskDate" id="dt_nasc" name="dt_nasc" maxlength="10" required="required" />
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cliente2">

            <div class="row br_top_tabs">
                <fieldset class="col-lg-4 col-lg-offset-1">

                    <div class="form-group">
                        <label for="cep" class="col-sm-2 control-label">CEP *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cep" name="cep" maxlength="8" required="required" onchange="getCep(this)" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="logr" class="col-sm-2 control-label">Logradouro *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="logr" name="logr" maxlength="255" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numero" class="col-sm-2 control-label">Número *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="numero" name="numero" maxlength="20" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="compl" class="col-sm-2 control-label">Complemento</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="compl" name="compl" maxlength="50" />
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4 col-lg-offset-1">

                    <div class="form-group">
                        <label for="bairro" class="col-sm-2 control-label">Bairro *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bairro" name="bairro" maxlength="100" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cidade" class="col-sm-2 control-label">Cidade *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cidade" name="cidade" maxlength="100" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uf" class="col-sm-2 control-label">Estado *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="uf" name="uf" maxlength="2" required="required" />
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cliente3">

            <div class="row br_top_tabs">
                <fieldset class="col-lg-4 col-lg-offset-1">

                    <div class="form-group">
                        <label for="rg" class="col-sm-2 control-label">RG</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rg" name="rg" maxlength="20" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dt_exp_rg" class="col-sm-2 control-label">Data Expedição</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control maskDate" id="dt_exp_rg" name="dt_exp_rg" maxlength="10" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="org_exp_rg" class="col-sm-2 control-label">Órgão Expedidor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="org_exp_rg" name="org_exp_rg" maxlength="15" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="est_civil" class="col-sm-2 control-label">Estado Civil *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="est_civil" name="est_civil" maxlength="15" required="required" />
                        </div>
                    </div>
                </fieldset>
                <fieldset class="col-lg-4 col-lg-offset-1">

                    <div class="form-group">
                        <label for="categoria" class="col-sm-2 control-label">Categoria </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="categoria" name="categoria">
                                <option value="Empregado">Empregado</option>
                                <option value="Empregador">Empregador</option>
                                <option value="Autônomo">Autônomo</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="empresa" name="empresa" maxlength="50" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profissao" class="col-sm-2 control-label">Profissão</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="profissao" name="profissao" maxlength="50" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="renda_bruta" class="col-sm-2 control-label">Renda Bruta</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control maskMoney" id="renda_bruta" name="renda_bruta" />
                        </div>
                    </div>

                </fieldset>
            </div>

        </div>
        <hr />
        <div class="row">
            <div class="form-group">
                <div class="col-sm-7 col-sm-offset-1 text-danger" id="display_errors"></div>
                <div class="col-sm-3">
                    <div class="btn-group pull-right" role="group" aria-label="buttons-form">
                        <button type="button" class="btn btn-default togglerForms" data-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">Fechar</button>
                        <button type="reset" class="btn btn-default">Limpar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="container">
    <h1 class="page-header">Clientes <button type="button" class="btn btn-success pull-right" onclick="newRecord()">Novo</button></h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <?php if (!empty($clientes)): ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Est. Civil</th>
                        <th>Profissão</th>
                        <th>Renda Bruta</th>
                        <th width="120px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente->id; ?></td>
                            <td><?php echo $cliente->cpf; ?></td>
                            <td nowrap="true"><?php echo $cliente->nome; ?></td>
                            <td><?php echo $cliente->email; ?></td>
                            <td><?php echo $cliente->bairro; ?></td>
                            <td><?php echo $cliente->cidade; ?></td>
                            <td><?php echo $cliente->est_civil; ?></td>
                            <td><?php echo $cliente->profissao; ?></td>
                            <td><?php echo $cliente->renda_bruta; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="buttons_actions">
                                    <button type="button" class="btn btn-default btn-sm" title="Visualizar" data-id="<?php echo $cliente->id; ?>" onclick="viewRecord(this)">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" title="Editar" data-id="<?php echo $cliente->id; ?>" onclick="editRecord(this)">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" title="Deletar" data-id="<?php echo $cliente->id; ?>" onclick="deleteRecord(this)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td>Não há dados a serem exibidos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="viewModalLabel">Modal title</h4>
            </div>
            <div class="modal-body" id="viewModalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>