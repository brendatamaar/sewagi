<?php

namespace App\Models;

trait MainModel
{
    /**
     * Update Row by ID
     * @param  integer $id
     * @param  array  $data
     * @return Object
     */
    public function updateById($id, $data = [], $log = false)
    {
        $model = $this->findOrFail($id);
        $model->update($data);
        return $model;
    }

    /**
     * Delete Row by ID
     * @param  Int $id
     * @return Boolean
     */
    public function deleteById($id, $log = false)
    {
        $model = $this->find($id);
        return $model->delete();
    }

    /**
     * Find By Column
     * @param  string $key
     * @param  string $value
     * @return Object
     */
    public function findByColumn($key, $value)
    {
        return $this->where($key, $value)->first();
    }

}
