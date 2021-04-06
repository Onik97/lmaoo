<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/includes/autoloader.inc.php");

class Router
{
    public $getRoutes = [];
    public $postRoutes = [];

    public function get($url, $fn) { $this->getRoutes[$url] = $fn; }

    public function post($url, $fn) { $this->postRoutes[$url] = $fn; }

    public function resolve()
    {
        $url = strtok($_SERVER["REQUEST_URI"] ?? "/", '?');;
        $method = $_SERVER["REQUEST_METHOD"];

        ($method == "GET") ? $fn = $this->getRoutes[$url] ?? null : $fn = $this->postRoutes[$url] ?? null;
        $fn ? call_user_func($fn, $this) : http_response_code(404);
    }

    public function render(string $view, string $js)
    {
        ob_start(); include_once __DIR__ . "/View/$view.php"; $content = ob_get_clean();
        ob_start(); include_once __DIR__ . "/View/navbar.php"; $navbar = ob_get_clean();
        ob_start(); echo "<script type='module' src='/Script/public/$js.js'></script>"; $script = ob_get_clean();
        include_once __DIR__ . "/View/_layout.php";
    }
}
