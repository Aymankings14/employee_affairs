<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'work_id_number',
        'civil_id_number',
        'job_title',
        'phone',
        'department',
        'management',
        'appointment_date'
    ];
    public function approval(){
        return $this->hasMany(Approval::class,'employee_id','id');
    }
    public function leave(){
        return $this->hasMany(Leave::class,'employee_id','id');
    }
    public function punishment(){
        return $this->hasMany(Punishment::class,'employee_id','id');
    }
    public function medical(){
        return $this->hasMany(Medical::class,'employee_id','id');
    }
    public function licence(){
        return $this->hasMany(License::class,'employee_id','id');
    }
//    Count Of field
    public function getTotalApprovalsAttribute(){
        return $this->hasMany(Approval::class)->where('employee_id',$this->id)->count();
    }
    public function getTotalMedicalsAttribute(){
        return $this->hasMany(Medical::class)->where('employee_id',$this->id)->count();
    }
    public function getTotalAbsencesAttribute(){
        return $this->hasMany(Punishment::class)->where('employee_id',$this->id)->where('type','absence')->count();
    }
    public function getTotalDelaysAttribute(){
        return $this->hasMany(Punishment::class)->where('employee_id',$this->id)->where('type','delay')->count();
    }
}
