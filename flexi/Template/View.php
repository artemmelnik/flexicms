<?php
namespace Flexi\Template;

use Flexi;
use Flexi\Routing\ResponderInterface;
use Flexi\Routing\Router;
use Twig_Environment;
use Twig_Function;
use Twig_Loader_Filesystem;

/**
 * Class View
 * @package Flexi\Template
 */
class View implements ResponderInterface
{
    /**
     * @var string The view file.
     */
    protected $file = '';

    /**
     * @var array The view data.
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $pathTemplates = '';

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->pathTemplates = $this->pathTemplates();

        //$_SERVER['DOCUMENT_ROOT'] . '/content/themes/default'
        $loader = new Twig_Loader_Filesystem($this->pathTemplates);
        $this->twig = new Twig_Environment($loader);

        $functions[] = new Twig_Function('__', function ($key, $data = []) {
            echo Flexi\Localization\I18n::instance()->get($key, $data);
        });

        $functions[] = new Twig_Function('asset', function ($file) {
            echo Asset::get($file);
        });

        $functions[] = new Twig_Function('get_setting', function ($key, $section = 'general') {
            return \Setting::value($key, $section);
        });

        $functions[] = new Twig_Function('uniqid', function () {
            return uniqid();
        });

        foreach ($functions as $function) {
            $this->twig->addFunction($function);
        }
    }

    /**
     * Returns the view data.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    public static function pathTemplates(): string
    {
        return Router::module()->viewPath;
    }

    /**
     * {@inheritdoc}
     */
    public function respond()
    {
        // Get the module action instance.
        //$instance = Router::module()->instance();

        echo $this->render();
    }

    /**
     * Render the view.
     *
     * @return string
     */
    public function render(): string
    {
        $template = $this->twig->load($this->file . '.twig');

        return $template->render($this->data);
    }

    /**
     * Instantiates the view.
     *
     * @param  string  $file
     * @param  array   $data
     * @return \Flexi\Template\View
     */
    public static function make(string $file, array $data = []): View
    {
        // Instantiate class.
        $name        = get_called_class();
        $class       = new $name;
        $class->file = $file;
        $class->data = $data;

        // Return new object.
        return $class;
    }
}
