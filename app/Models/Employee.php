<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function approval(): HasMany
    {
        return $this->hasMany(Approval::class,'employee_id','id');
    }
    public function leave() :HasMany
    {
        return $this->hasMany(Leave::class,'employee_id','id');
    }
    public function punishment() : HasMany
    {
        return $this->hasMany(Punishment::class,'employee_id','id');
    }
    public function medical() : HasMany
    {
        return $this->hasMany(Medical::class,'employee_id','id');
    }
    public function licence(): HasMany
    {
        return $this->hasMany(License::class,'employee_id','id');
    }
//    Count Of field
    public function getTotalApprovalsAttribute(): int
    {
        return $this->hasMany(Approval::class)->where('employee_id',$this->id)->count();
    }
    public function getTotalMedicalsAttribute(): int
    {
        return $this->hasMany(Medical::class)->where('employee_id',$this->id)->count();
    }
    public function getTotalAbsencesAttribute(): int
    {
        return $this->hasMany(Punishment::class)->where('employee_id',$this->id)->where('type','absence')->count();
    }
    public function getTotalDelaysAttribute(): int
    {
        return $this->hasMany(Punishment::class)->where('employee_id',$this->id)->where('type','delay')->count();
    }
}
