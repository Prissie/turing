
<section id="mudarSenha" class="centralizar">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading cor-fundo">Mudar a Senha</div>
        <div class="panel-body">
           <?php $this->renderMensagens(); ?>
          <form class="form-horizontal" role="form" method="POST" action="<?php echo Config::pegar('URL'); ?>login/salvarNovaSenha">
            <div class="form-group">
              <label class="col-md-4 control-label cor-fundo">Senha</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="senha" placeholder="digite sua nova senha" pattern=".{6,}" required>
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-4 control-label cor-fundo">Confirma a Senha</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="csenha" placeholder="digite novamente a mesma senha" pattern=".{6,}" required>
              </div>
            </div>
            <input type='hidden' name='email' value='<?php echo $this->email; ?>' />
            <input type='hidden' name='reset_hash' value='<?php echo $this->reset_hash; ?>' />

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary cor-fundo-btn">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
