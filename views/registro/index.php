
<section id="registro" class="centralizar">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading cor-fundo">Registro</div>
				<div class="panel-body">
					<?php $this->renderMensagens(); ?>
					<form class="form-horizontal" role="form" method="POST" action="<?php echo Config::pegar('URL'); ?>registro/novaconta">

						<div class="form-group">
							<label class="col-md-4 control-label cor-fundo">Nome</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nome" placeholder="nome" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label cor-fundo">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" placeholder="email" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label cor-fundo">Senha</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="senha"  placeholder="senha" pattern=".{6,}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label cor-fundo">Confirmar Senha</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="csenha" placeholder="confirme a senha" pattern=".{6,}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4 ">
								<button type="submit" class="btn btn-primary cor-fundo-btn">
									Registrar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</section>