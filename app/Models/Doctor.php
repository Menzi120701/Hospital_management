<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function patients()
    {
        return $this->belongsToMany(Patient::class,"table_doctor_patients");
    }

}
