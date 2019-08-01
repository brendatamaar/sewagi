<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class ClientReview extends Model
{
    protected $dataTables;
    protected $guarded = ['created_at', 'updated_at'];

    public function createNew($data)
    {
        $newData = [
            'name'   => $data['name'],
            'message'   => $data['message'],
            'role'   => $data['role'],
            'picture'   => $data['picture'],
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
        $reviews = $this->query();
        
        return $this->dataTables->of($reviews)
            ->addColumn('action', function ($review) {
                return '<a href="'. route('client-review.edit', ['id' => $review->id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-xs btn-danger deleteWorker" data-url="'.route('client-review.destroy', ['id' => $review->id]).'"><i class="fa fa-trash"></i></button>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public static function getAll() 
    {
        return Self::all();
    }
}
