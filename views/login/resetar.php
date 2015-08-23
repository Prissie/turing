
<section id="resetar" class="centralizar">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading cor-fundo">Resetar Senha</div>
        <div class="panel-body">
           <?php $this->renderMensagens(); ?>
          <form class="form-horizontal" role="form" method="POST" action="<?php echo Config::pegar('URL'); ?>login/resetarSenha">

            <div class="form-group">
              <label class="col-md-4 control-label cor-fundo">Email</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="digite seu email" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary cor-fundo-btn">Lembrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
