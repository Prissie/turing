<?php

/*
*  Classe Aplicação.
*  Está classe serve para iniciar a aplicação, contém as 
*  funções que determina as rotas e ações feitas pelo app.
*/

class Aplicacao
{

    private $controlador;
    private $parametros = array();
    private $controlador_nome;
    private $acao_nome;

    /* 
    * Construtor da aplicação, inicia as funções que 
    * determinam os controladores e ações do sistema.
    */
    public function __construct()
    {
        $this->dividirUrl();
	    $this->criarControladorAcaoNomes();
        $this->staterControlador();   
    }

    /* 
    * Método que retorna e devolver a view a página de erro.
    */
    private function retornarError()
    {     
        require Config::pegar('CAMINHO_CONTROLADOR') . 'ErrorControlador.php';

        $this->controlador = new ErrorControlador;
        $this->controlador->index();
    }


    /* 
    * Aqui é o método que verifica se cada arquivo existe e transforma em um controlador.
    * Também checa se o controlador
    */
    private function staterControlador()
    {
        // Verifica se o arquivo existe, caso ao contrário retorna a página de erro.
        if (file_exists(Config::pegar('CAMINHO_CONTROLADOR') . $this->controlador_nome . '.php')) {

            // Faz o requerimento do arquivo e instancia como um controlador.
            require Config::pegar('CAMINHO_CONTROLADOR') . $this->controlador_nome . '.php';
            $this->controlador = new $this->controlador_nome();

            // Faz a verificação se o método existe.
            if (method_exists($this->controlador, $this->acao_nome)) {
                if (!empty($this->parametros)) {
                    // Chama o método e as funções.
                    call_user_func_array(array($this->controlador, $this->acao_nome), $this->parametros);
                } else {
                  return $this->controlador->{$this->acao_nome}();
                }
            } else {
               return $this->retornarError();
            }
        } else {
             return $this->retornarError();
        }
    }

    /*
    * Pega a url e a divide em partes.
    */
    private function dividirUrl()
    {
        if (Requisitar::pegar('url')) {

            $url = trim(Requisitar::pegar('url'), '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            /* Transforma as urls, é atribui o controlador e a ação do controlador.
            *  Ex. Local/login/index - login é o controlador e index a ação.
            */
            $this->controlador_nome = isset($url[0]) ? $url[0] : null;
            $this->acao_nome = isset($url[1]) ? $url[1] : null;
       
            unset($url[0], $url[1]);

            $this->parametros = array_values($url);
        }
    }

    /*
    * Pega o controlador e ação padrão do sistema que está contido no arquivo config.
    */
	private function criarControladorAcaoNomes()
	{
		/* Se não existe um controlador, pegue o que está na config.*/
		if (!$this->controlador_nome) {
			$this->controlador_nome = Config::pegar('DEFAULT_CONTROLADOR');
		}

        /* Se não existe uma ação, pegue o que está na config.*/
		if (!$this->acao_nome OR (strlen($this->acao_nome) == 0)) {
			$this->acao_nome = Config::pegar('DEFAULT_ACAO');
		}
        
		$this->controlador_nome = ucwords($this->controlador_nome) . 'Controlador';
	}


}
