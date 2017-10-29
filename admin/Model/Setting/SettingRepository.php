<?php

namespace Admin\Model\Setting;

use Engine\Model;


class SettingRepository extends Model
{
    const SECTION_GENERAL = 'general';

    /**
     * @return object
     */
    public function getSettings()
    {
        $sql = $this->queryBuilder
             ->select()
             ->from('setting')
             ->where('section', self::SECTION_GENERAL)
             ->orderBy('id', 'ASC')
             ->sql();
        $values = $this->queryBuilder->getValues();

        return $this->db->query($sql, $values);
    }

    /**
     * @param string $keyField
     * @return null|string
     */
    public function getSettingValue($keyField)
    {
        $sql = $this->queryBuilder
             ->select('value')
             ->from('setting')
             ->where('key_field', $keyField)
             ->sql();
        $values = $this->queryBuilder->getValues();

        $query = $this->db->query($sql, $values);

        return isset($query[0]) ? $query[0]->value : null;
    }

    public function update(array $params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $sql = $this->queryBuilder
                     ->update('setting')
                     ->set(['value' => $value])
                     ->where('key_field', $key)
                     ->sql();
                $values = $this->queryBuilder->getValues();
                
                $this->db->execute($sql, $values);
            }
        }
    }

    /**
     * @param string $theme
     */
    public function updateActiveTheme($theme)
    {
        $sql = $this->queryBuilder
             ->update('setting')
             ->set(['value' => $theme])
             ->where('key_field', 'active_theme')
             ->sql();
        $values = $this->queryBuilder->getValues();
        
        $this->db->execute($sql, $values);
    }
}
