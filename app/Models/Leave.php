<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable =['type','duration','notice_number','required_duration','from_date','start_date','employee_id'];
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
