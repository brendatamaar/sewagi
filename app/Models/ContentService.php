<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class ContentService extends Model
{
    protected $dataTables;
    protected $fillable = [
        'id_name',
        'en_name',
        'id_description',
        'en_description'
    ];
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->dataTables = new DataTables;
    }
    
    public function ajaxDatatables()
    {
        $services = $this->query();
        
        return $this->dataTables->of($services)
            ->addColumn('action', function ($services) {
                return '<a href="'. route('content-service.edit', ['id' => $services->id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-xs btn-danger deleteService" data-url="'.route('content-service.destroy', ['id' => $services->id]).'"><i class="fa fa-trash"></i></button>';
            })
            ->addIndexColumn()
            ->make(true);
    }
}
