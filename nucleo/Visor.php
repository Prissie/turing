<?php

/*
* Classe Visor.
* Serve para atribuir os arquivos que serão mostrados, é cuida de toda parte visual.
*/

class Visor
{
    
    /*
    * Transforma os dados em json.
    */
    public static function Json($data)
    {
        echo json_encode($data);
    }


    /*
    * Redireciona para o arquivo é o layout utilizado.
    */
    public function render($arquivo, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $valor) {
                $this->{$key} = $valor;
            }
        }
        require Config::pegar('CAMINHO_VISOR') . 'layouts/header.php';
        require Config::pegar('CAMINHO_VISOR') . $arquivo . '.php';
        require Config::pegar('CAMINHO_VISOR') . 'layouts/footer.php';
    }

    
    
    /*
    * Redireciona para o arquivo sem o layout.
    */
    public function renderSemLayout($arquivo, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $valor) {
                $this->{$key} = $valor;
            }
        }

        require Config::pegar('CAMINHO_VISOR') . $arquivo . '.php';
    }

    /*
    * Cuida de mostrar as mensagens de erro ou sucesso no app.
    */
    public function renderMensagens()
    {
       
        $sucesso = Sessao::pegar('sucesso');
        $erro = Sessao::pegar('erro');

        if (isset($sucesso)) {
            foreach ($sucesso as $mensagem) {
                echo '<div class="mensagem sucesso">'.$mensagem.'</div>';
            }
        }

        if (isset($erro)) {
             foreach ($erro as $mensagem) {
               echo '<div class="mensagem erro">'.$mensagem.'</div>';
            }
        }
    
        Sessao::setar('sucesso', null);
        Sessao::setar('erro', null);
    }

    /*
    * Verificar o controlador ativo.
    */
    public static function checharControladadorAtivo($arquivo, $controlador_navegacao)
    {
        $arquivo_divido = explode("/", $arquivo);
        $ativo_controlador = $arquivo_divido[0];

        if ($ativo_controlador == $controlador_navegacao) {
            return true;
        }

        return false;
    }


}
