<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Backend\Model;

use Flexi\Orm\Model;

/**
 * Class CategoryDescription
 * @package Modules\Backend\Model
 */
class CategoryDescription extends Model
{
    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected static $table = 'category_description';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'category_id' => 'categoryId',
            'language'    => 'language',
            'name'        => 'name',
            'description' => 'description'
        ];
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return CategoryDescription
     */
    public function setCategoryId(int $categoryId): CategoryDescription
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return CategoryDescription
     */
    public function setLanguage(string $language): CategoryDescription
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CategoryDescription
     */
    public function setName(string $name): CategoryDescription
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CategoryDescription
     */
    public function setDescription(string $description): CategoryDescription
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param array $params
     * @return bool
     */
    public static function add(array $params)
    {
        $categoryDescription = new CategoryDescription();
        $categoryDescription
            ->setCategoryId($params['category_id'])
            ->setLanguage($params['language'])
            ->setName($params['name'])
            ->setDescription($params['description']);

        return $categoryDescription->save();
    }

    /**
     * @param array $params
     * @return \Flexi\Orm\Query
     */
    public static function update(array $params)
    {
        return \Query::table(static::$table)
            ->update([
                'name' => $params['name'],
                'description' => $params['description']
            ])
            ->where('category_id', '=', $params['category_id'])
            ->where('language', '=', $params['language'])
            ->run('update');
    }
}
