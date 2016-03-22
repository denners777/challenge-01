<?php if (!empty($clientes)): ?>
    <?php foreach ($clientes as $cliente): ?>
        <div class="row">
            <dl class="col-md-4">
                <dt>ID</dt>
                <dd><?php echo $cliente->id; ?></dd>
                <dt>CPF</dt>
                <dd><?php echo $cliente->cpf; ?></dd>
                <dt>Nome</dt>
                <dd><?php echo $cliente->nome; ?></dd>
                <dt>Telefone</dt>
                <dd><?php echo $cliente->telefone; ?></dd>
                <dt>E-mail</dt>
                <dd><?php echo $cliente->email; ?></dd>
                <dt>Data Nascimento</dt>
                <dd><?php echo $cliente->dt_nasc; ?></dd>
            </dl>
            <dl class="col-md-4">
                <dt>CEP</dt>
                <dd><?php echo $cliente->cep; ?></dd>
                <dt>Logradouro</dt>
                <dd><?php echo $cliente->logr; ?></dd>
                <dt>Número</dt>
                <dd><?php echo $cliente->numero; ?></dd>
                <dt>Complemento</dt>
                <dd><?php echo $cliente->compl; ?></dd>
                <dt>Bairro</dt>
                <dd><?php echo $cliente->bairro; ?></dd>
                <dt>Cidade</dt>
                <dd><?php echo $cliente->cidade; ?></dd>
                <dt>Estado</dt>
                <dd><?php echo $cliente->uf; ?></dd>
            </dl>
            <dl class="col-md-4">
                <dt>RG</dt>
                <dd><?php echo $cliente->rg; ?></dd>
                <dt>Data Expedição</dt>
                <dd><?php echo $cliente->dt_exp_rg; ?></dd>
                <dt>Órgão Expedidor</dt>
                <dd><?php echo $cliente->org_exp_rg; ?></dd>
                <dt>Estado Civil</dt>
                <dd><?php echo $cliente->est_civil; ?></dd>
                <dt>Categoria</dt>
                <dd><?php echo $cliente->categoria; ?></dd>
                <dt>Empresa</dt>
                <dd><?php echo $cliente->empresa; ?></dd>
                <dt>Profissão</dt>
                <dd><?php echo $cliente->profissao; ?></dd>
                <dt>Renda Bruta</dt>
                <dd><?php echo $cliente->renda_bruta; ?></dd>
            </dl>
            <dl class="col-md-6">
                <dt>Criado em</dt>
                <dd><?php echo $cliente->createin; ?></dd>
                <dt>Atualizado em</dt>
                <dd><?php echo $cliente->updatein; ?></dd>
            </dl>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    Não há dados a serem exibidos.
<?php endif; ?>