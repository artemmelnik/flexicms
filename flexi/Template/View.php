<?php
namespace Flexi\Template;

use Flexi;
use Flexi\Routing\ResponderInterface;
use Flexi\Routing\Router;
use Twig_Environment;
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

        $BackendPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'modules/Backend/View/';
        $loader = new Twig_Loader_Filesystem($this->pathTemplates);
        $loader->addPath($BackendPath, 'Backend');

        $this->twig = new Twig_Environment($loader);

        $this->twig->addExtension(new Flexi\Template\Extension\AssetExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\SettingExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\ResourceExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\LocalizationExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\HelperExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\FileExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\CustomFieldExtension());
        $this->twig->addExtension(new Flexi\Template\Extension\MenuExtension());
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
