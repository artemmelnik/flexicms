<?php
namespace Flexi\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class FileExtension
 * @package Flexi\Template\Extension
 */
class FileExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigFileExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('file', array($this, 'getFileLink')),
            new Twig_SimpleFunction('file_object', array($this, 'getFile')),
        ];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getFileLink(int $id)
    {
        $fileModel = new \Modules\Frontend\Model\File;
        $file = $fileModel->getFileById($id);

        if ($file === null) {
            return '';
        }

        return $file->link;
    }

    /**
     * @param int $id
     * @return array|null|string
     */
    public function getFile(int $id)
    {
        $fileModel = new \Modules\Frontend\Model\File;
        $file = $fileModel->getFileById((int) $id);

        if ($file === null) {
            return '';
        }

        return $file;
    }
}
