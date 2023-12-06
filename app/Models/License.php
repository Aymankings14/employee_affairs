<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $fillable=['type','reason','time','from_date','to_date','employee_id'];
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
