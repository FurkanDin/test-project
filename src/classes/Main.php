<?php

require_once 'home.php';

class Main
{
    public $router;

    public function __construct()
    {
        global $lang, $smarty;

        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'tr';

        if (isset($_GET['lang']) && !empty($_GET['lang'])) {
            $lang = $_GET['lang'];
            $_SESSION['lang'] = $lang;
        }


        require_once __DIR__ . "/../languages/{$lang}.php";

        $smarty = new Smarty\Smarty();
        $this->router = new \Bramus\Router\Router();

        $smarty->setTemplateDir('src/templates');
        $smarty->setCompileDir('/tmp');

        $smarty->assign('LANG', $lang);
        $smarty->assign('langs', ['tr' => 'Türkçe', 'en' => 'English']);
    }

    public function run()
    {
        global $smarty;

        // Capture errors to be displayed
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
        $smarty->assign('errors', $errors);

        $this->router->get('/', function () {
            $home = new Home();
            $home->index();
        });

        $this->router->run();
        $smarty->display('index.html');
    }
}
