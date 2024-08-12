<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sections;
class Products extends Model
{
    use HasFactory;
    //id Product_name description section_id created_at updated_at
    // protected $guarded = [];
    protected $fillable = ['Product_name', 'description', 'section_id'];

    public function section()
    {
        return $this->belongsTo(sections::class, 'section_id');
    }
    //section (1)=======> (N)Products
}
