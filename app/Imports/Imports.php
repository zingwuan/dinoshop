<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps = false;
    protected $fillable = ['discount_name','discount_code','discount_times','discount_number','discount_condition'];
    protected $primaryKey = 'discount_id';
    protected $table = 'tbl_discount';

}
