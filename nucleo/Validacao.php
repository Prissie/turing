<?php

/*
* Classe Validacao.
* Serve para conferir dados de maneira básica.
*/

class Validacao
{
  	private $dados;
    private $erros = array();

    public  function setarCampo($valor, $campo, $parametro = null)
    {
    	$this->dados = array("valor" => trim($valor),
    						 "nome" => $campo,
    						 "parametro" => $parametro,
    						 );
    	return $this;
    }

    public  function obrigatorio()
    {
    	if(empty($this->dados['valor'])){
    		$this->erros[] = sprintf("O campo %s é obrigatório!", $this->dados['nome']);

    	}
    	return $this;
    }

    public function email()
    {
    	if(!filter_var($this->dados['valor'], FILTER_VALIDATE_EMAIL)){
    		$this->erros[] = sprintf("O campo %s só aceita um e-mail válido!", $this->dados['nome']);
    	}
    	return $this;
    }


    public function numerico()
    {
        if(!is_numeric($this->dados['valor'])){
         	$this->erros[] = sprintf("O campo %s tem que ser númerico!", $this->dados['nome']);
        }
     	return $this;
    }

    public function tamanhoExato()
    {
    	if(!strlen($this->dados['valor'] == $this->dados['parametro'])){
         	$this->erros[] = sprintf("O campo %s tem que ter o tamanho de %s!", $this->dados['nome'],$this->dados['parametro']);
        }
    	return $this;
    }

    public function tamanhoMaximo()
    {
        if(!strlen($this->dados['valor'] < $this->dados['parametro'])){
            $this->erros[] = sprintf("O campo %s tem que ser menor de %s!", $this->dados['nome'],$this->dados['parametro']);
        }
        return $this;
    }

    public function comparar()
    {
        if(!($this->dados['valor'] == $this->dados['parametro'])){
            $this->erros[] = sprintf("Os campos %s  tem que ser iguais!", $this->dados['nome']);
        }
        return $this;
    }

    public function validar(){

    	if(empty($this->erros)){
    		return true;
    	}else{
    		return false;
    	}
    }
 
    public function pegarErros(){
        foreach ($this->erros as $erro) {
            Sessao::adicionar('erro', $erro);
        }
        return $this->erros;
    }




    
}