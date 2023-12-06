<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable =['date','day','from_hour','to_hour','employee_id'];
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
