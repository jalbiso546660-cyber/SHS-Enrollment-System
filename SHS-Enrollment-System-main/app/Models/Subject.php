<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'SubjectID';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'StrandID',
        'Semester',
        'School_Year',
        'Grade_Level',
        'description'
    ];

    public function strand()
    {
        return $this->belongsTo(Strand::class, 'StrandID', 'StrandID');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'SubjectID');
    }
}