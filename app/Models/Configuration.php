<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class Configuration extends Model
{
    protected $dataTables;

    protected $guarded = ['created_at', 'updated_at'];
    
    public function category()
    {
        return $this->hasOne('App\Models\ConfigurationCategory', 'id', 'category_id');
    }
    public function createNew($data)
    {
        $newData = [
            'category_id'   => $data['category_id'],
            'key'   => strtolower(str_replace(' ', '_', $data['name'])),
            'value'   => $data['value'],
            'name'   => $data['name'],
        ];
        return Self::create($newData);
    }
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dataTables = new DataTables;
    }
    public function ajaxDatatables()
    {
        $configs = $this->query();
        
        return $this->dataTables->of($configs)
            ->addColumn('category_name', function ($config) {
                return $config->category->name;
            })
            ->addColumn('action', function ($config) {
                return '<a href="'. route('configuration.edit', ['id' => $config->id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-xs btn-danger deleteConfig" data-url="'.route('configuration.destroy', ['id' => $config->id]).'"><i class="fa fa-trash"></i></button>';
            })
            ->addIndexColumn()
            ->make(true);
    }
}
