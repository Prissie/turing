
<section id="login" class="centralizar">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading cor-fundo">Login</div>
        <div class="panel-body">
            <?php $this->renderMensagens(); ?>
          <form class="form-horizontal" role="form" method="POST" action="<?php echo Config::pegar('URL'); ?>login/login">

            <div class="form-group">
              <label class="col-md-4 control-label cor-fundo">Email</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="email" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label cor-fundo">Senha</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="senha" placeholder="senha" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label class="cor-fundo">
                    <input type="checkbox" name="lembrar"> Lembra-me
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary cor-fundo-btn">Login</button>

                <a class="btn btn-link cor-fundo" href="<?php echo Config::pegar('URL'); ?>login/resetar">Esqueceu sua senha?</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
