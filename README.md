

# Turing


Um simples framework que funciona utilizando todos os recusos do PHP 5.5+, tem alguns recursos que irão te poupar
tempo no desenvolvimento de uma simples aplicação.Se deseja construir aplicações robustas sugiro [Laravel](http://laravel.com), mas se desejar à simplicidade e algo rápido esse conjunto de scripts poderá ser interesante para você.

 
# Licença

Licença [MIT](http://www.opensource.org/licenses/mit-license.php). 
A permissão é concedida, a título gratuito, a qualquer pessoa que obtenha uma cópia deste 
software e arquivos de documentação associados (o "Software"), para lidar sem restrição, incluindo, sem limitação, os direitos para usar, copiar, modificar, mesclar, publicar, distribuir, sub-licenciar e / ou vender.

# História 

Foi desenvolvido um conjunto de scripts para o desenvolvimento mais ágil de pequenas aplicações, o nome escolhido é o sobrenome de Alan [Turing](https://pt.wikipedia.org/wiki/Alan_Turing).


#Atualizações Futuras

 - Reduzir o uso de statics
 - Documentar e refazer nome de classes, métodos e classes em inglês.
 - Tentar reduzir o número de arquivos e deixar mais simples.


# Funcionalidades

  - Desenvolvida com as bases mordernas de desenvolvimento em php;
  - Utiliza a oficial criptografia sugerida pelo php em senhas;
  - Cookie login;
  - A capacidade de resetar a senha via email;
  - Código documentado em português, assim como as variáveis; 
  - A capacidade de barrar múltiplos logins do mesmo usuário;
  - Usa composer como referência para gerenciar pacotes;
  - Verificação de conta via email;
  - Urls amigáveis;
  - Atualização constantes;
  - Usa PSR-0/1/2/4;
  - Utiliza PDO para conexões;
  - Classe Crud para realizar insert, update, select e delete facilmente;
  - E mais algumas outras funcionalidades.

# Requirimentos

Saber o básico de MVC, é a utilização do composer.

  - PHP 5.5+;
  - MySQL Atualizado;
  - Ativo mod_rewrite no servidor;
  - Ativado as seguintes extensões no php_ini: PDO, GD, OPENSSL;
  - Ter uma conta de email para utilizar o SMTP (Pode ser gmail).

# Instalação
	
  -  Transfira os arquivos para seu servidor (Pode ser localhost, utilize xamp, wamp ou easyphp);
  -  Importe o banco de dados através do arquivo .sql no PhpMyAdmin;
  -  Faça as alterações na pasta config e arquivo config.desenvolvimento, adicione as informações de SMTP e de conexão com o banco;
  -  Usuário e senha padrão: turing@turing-exemplo.com/turing. 

# Suporte 
  
  -  Qualquer dúvida me mande um email em ronlima1@live.com