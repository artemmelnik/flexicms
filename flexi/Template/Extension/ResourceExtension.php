<?php
namespace Flexi\Template\Extension;

use Modules\Frontend\Classes\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class ResourceExtension
 * @package Flexi\Template\Extension
 */
class ResourceExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigResourceExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        $functions   = [];
        $functions[] = new Twig_SimpleFunction('resources', array($this, 'getResources'));
        $functions[] = new Twig_SimpleFunction('next_resource_by_id', array($this, 'getNextById'));
        $functions[] = new Twig_SimpleFunction('prev_resource_by_id', array($this, 'getPrevById'));

        return $functions;
    }

    public function getPrevById(int $resourceId)
    {
        $resourceModel = new \Modules\Frontend\Model\Resource;

        return $resourceModel->getPrevResource($resourceId);
    }

    public function getNextById(int $resourceId)
    {
        $resourceModel = new \Modules\Frontend\Model\Resource;

        return $resourceModel->getNextResource($resourceId);
    }

    /**
     * @param int $typeId
     * @param array $params
     * @return array|\Flexi\Orm\Query
     */
    public function getResources(int $typeId, array $params = [])
    {
        $resourceModel = new \Modules\Frontend\Model\Resource;

        return $resourceModel->getResources($typeId, $params);
    }
}
