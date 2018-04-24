<?php
namespace Modules\Frontend\Classes;

use Modules\Frontend\Model;

/**
 * Class Resource
 * @package Modules\Frontend\Classes
 */
class Resource
{
    /**
     * @var Model\Resource
     */
    protected $resourceModel;

    /**
     * @var int
     */
    protected $resourceTypeId;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Resource constructor.
     * @param int $resourceTypeId
     */
    public function __construct(int $resourceTypeId)
    {
        $this->resourceTypeId = $resourceTypeId;
        $this->resourceModel = new Model\Resource();
    }

    /**
     * @param int $categoryId
     * @return $this
     */
    public function category(int $categoryId)
    {
        $this->params['categories'][] = $categoryId;

        return $this;
    }

    /**
     * @return array|\Flexi\Orm\Query
     */
    public function get()
    {
        return $this
            ->resourceModel
            ->getResources($this->resourceTypeId, $this->params);
    }
}
