<!doctype html>
<html>
        <head>
    		<title>Turing</title>
    		<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
    		<link rel="stylesheet" href="<?php echo Config::pegar('URL'); ?>css/app.css" />
            <link rel="stylesheet" href="<?php echo Config::pegar('URL'); ?>css/style.css" />

    	</head>
    <body>

    <header>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Config::pegar('URL'); ?>">Turing</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php  if (!Sessao::checar()) {  ?>

                <ul class="nav navbar-nav">
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "index")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "login")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>login">Login</a></li>
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "registro")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>registro">Registro</a></li>
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "error")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>error/index">404</a></li>
                </ul>
            <?php } else { ?>

                <ul class="nav navbar-nav">
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "painel")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>painel">Painel</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "json")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>usuarios/json">Json</a></li>
                    <li <?php if (Visor::checharControladadorAtivo($arquivo, "usuario")) { echo ' class="active" '; } ?>><a href="<?php echo Config::pegar('URL'); ?>usuarios">Usuário</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo Config::pegar('URL'); ?>usuarios/mostrarPerfil/<?php echo Sessao::pegar('id');?>">Meu Perfil</a></li>
                            <li><a href="<?php echo Config::pegar('URL'); ?>login/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
               
            </div>
        </div>
    </nav>
    </header>