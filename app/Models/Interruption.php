<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interruption extends Model
{
    use HasFactory;
    protected $fillable=['date','employee_id'];
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
