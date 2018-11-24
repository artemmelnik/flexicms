<?php
namespace Modules\Frontend\Classes;

use Modules\Frontend\Model;

/**
 * Class Resources
 * @package Modules\Frontend\Classes
 */
class Resources
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
        $this->params['resource_type_id'] = $resourceTypeId;
        $this->resourceModel = new Model\Resource();
    }

    /**
     * @param int $number
     * @return $this
     */
    public function limit(int $number)
    {
        $this->params['limit'] = $number;

        return $this;
    }

    public function orderBy($field, $order = 'desc')
    {
        $this->params['order_by'] = [
            'field' => $field,
            'order' => $order
        ];

        return $this;
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
     * @param string|null $categories
     * @return $this
     */
    public function inCategory($categories)
    {
        if ($categories !== null && $categories !== '') {
            $this->params['in_categories'] = $categories;
        }

        return $this;
    }

    /**
     * @param int $number
     * @return array
     */
    public function get($number = 0)
    {
        $resources = [];

        $result = $this
            ->resourceModel
            ->getResourcesByParams($this->params);

        if (!empty($result) && $result !== null) {
            $count = 0;
            foreach ($result as $item) {
                if ($number !== 0 && $count >= $number) {
                    break;
                }

                $resources[] = new Resource($item);

                $count++;
            }
        }

        return $resources;
    }
}
