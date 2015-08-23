<div class="container-fluid">
  <div class="row">
  	<div class="col-md-6 col-md-offset-3">
  		<div class=" panel panel-default">
  			<div class="panel-heading cor-fundo">Perfil</div>
				<div class="panel-body">
				<p class="cor-fundo">Exemplo simples de como mostrar o perfil, agora é com você!</p>
                 <div class="col-md-3">
                      <?php if ($this->usuario) { ?>
           	 
                     		
                            <h2 class="cor-fundo"><?= $this->usuario->nome; ?></h2>
                            <h4 class="cor-fundo"><?= $this->usuario->email; ?></h4>
                            <td><?= ($this->usuario->ativo == 0 ? '<span class="label label-error">Ativo</span>' : '<span class="label label-success">Ativo</span>'); ?></td>
             				
       				 <?php } ?>
                 </div>
            </div>
        </div>            
    </div>
  </div>
</div>
