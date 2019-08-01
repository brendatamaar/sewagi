<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class WorkingField extends Model
{
    protected $dataTables;

    protected $fillable = [
        'name',
        'id_name',
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
        $fields = $this->query();
        
        return $this->dataTables->of($fields)
            ->addColumn('action', function ($fields) {
                return '<a href="'. route('working-field.edit', ['id' => $fields->id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-xs btn-danger deleteWorkingField" data-url="'.route('working-field.destroy', ['id' => $fields->id]).'"><i class="fa fa-trash"></i></button>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function getAll()
    {
        return Cache::remember('working_field.all', 60, function () {
            return Self::getLocale();
        });
    }

    private static function getLocale()
    {
        return Self::select('id', (session('locale')=='id' ? 'id_name as name' : 'name'))->get();
    }
}