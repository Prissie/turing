<?php


namespace app\core;
use App\core\Request as Request;
use app\core\Config as Config;
use app\core\Session as Session;

class View
{
    
 
    public static function Json($data)
    {
        echo json_encode($data);
    }


    public function render($filename, $data = null)
    {
        $config = new Config();
        if($config->get('system','maintenance') == '1'){
             require Request::pathView().'manutencao/index.php';
             exit();
        }

        if($config->get('system','debug') == '1'){
             require Request::pathView().'debug/index.php';
        }

      
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        require Request::pathView().'template/header.php';
        require Request::pathView(). $filename . '.php';
        require Request::pathView().'template/footer.php';
       
    }

  
    public function renderMenssagens()
    {
       
        $sucess = Session::get('sucess');
        $erro = Session::get('fail');

        if (isset($sucess)) {
            foreach ($sucess as $message) {
                echo '<div class="message sucess">'.$message.'</div>';
            }
        }

        if (isset($erro)) {
             foreach ($erro as $message) {
               echo '<div class="message fail">'.$message.'</div>';
            }
        }
    
        Sessao::setar('sucess', null);
        Sessao::setar('fail', null);
    }

    public static function checkForAtiveController($file, $navigationController)
    {
        $split = explode("/", $file);
        $ativeController = $split[0];

        if ($ativeController == $navigationController) {
            return true;
        }

        return false;
    }


}
