<div class="container-fluid">
  <div class="row">
  	<div class="col-lg-6 col-md-offset-3">
  		<div class=" panel panel-default">
  			<div class="panel-heading cor-fundo">Perfil</div>
				<div class="panel-body">
				    <p class="cor-fundo">Exemplo simples de como mostrar o perfil, agora é com você!</p>
            <div class="col-md-8">
                  <?php if($this->usuarios){ ?>
                  <table class="overview-table">
                    <thead>
                      <tr>
                        <td class="cor-fundo">Nome</td>
                        <td class="cor-fundo">Email</td>
                        <td class="cor-fundo">Ativo</td>
                        <td class="cor-fundo">Acesso</td>
                      </tr>
                    </thead>

                  <?php foreach ($this->usuarios as $usuario) {?>
                        <tr class="<?= ($usuario->ativo == 0 ? 'inativo' : 'ativo'); ?>">
                          <td class="cor-fundo"><?= $usuario->nome; ?></td>
                          <td class="cor-fundo"><?= $usuario->email; ?></td>
                          <td class="cor-fundo"><?= $usuario->ativo == 0 ? '<span class="label label-error">Ativo</span>' : '<span class="label label-success">Ativo</span>'; ?></td> 
                          <td class="cor-fundo"><a href="<?= Config::pegar('URL') . 'usuarios/mostrarPerfil/' . $usuario->id; ?>">Perfil</a></td>

                         </tr>  
                        <?php }?>
                  </table>
                  <?php } ?>
            </div>
        </div>
      </div>            
    </div>
  </div>
</div>
