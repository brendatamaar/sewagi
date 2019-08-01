<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class ConfigurationCategory extends Model
{
    protected $dataTables;

    protected $guarded = ['created_at', 'updated_at'];
    protected $fillable = [
        'name'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dataTables = new DataTables;
    }
    public function ajaxDatatables()
    {
        $configCategories = $this->query();
        
        return $this->dataTables->of($configCategories)
            ->addColumn('action', function ($configCategory) {
                return '<a href="'. route('configuration-category.edit', ['id' => $configCategory->id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-xs btn-danger deleteConfigCategory" data-url="'.route('configuration-category.destroy', ['id' => $configCategory->id]).'"><i class="fa fa-trash"></i></button>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public static function getAll() 
    {
        return Self::all();
    }
}
