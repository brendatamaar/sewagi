<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class ActiveWorker extends Model
{
    protected $dataTables;
    protected $fillable = [
        'place_name',
        'place_id',
        'province',
        'city',
        'district',
        'postcode',
        'latitude',
        'longitude',
        'created_at',
        'updated_at'
    ];
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dataTables = new DataTables;
    }
    
    public function ajaxDatatables()
    {
        $workers = $this->query();
        
        return $this->dataTables->of($workers)
            ->addColumn('action', function ($workers) {
                return '<a href="'. route('active-worker.edit', ['id' => $workers->id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-xs btn-danger deleteWorker" data-url="'.route('active-worker.destroy', ['id' => $workers->id]).'"><i class="fa fa-trash"></i></button>';
            })
            ->addIndexColumn()
            ->make(true);
    }
}
