<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    protected $primaryKey = 'SectionID';
    public $timestamps = false;

    protected $fillable = [
        'Section_Name',
        'description',
        'StrandID',
        'Grade_Level'
    ];

    public function strand()
    {
        return $this->belongsTo(Strand::class, 'StrandID', 'StrandID');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'SectionID', 'SectionID');
    }

    public function students()
    {
        return $this->hasMany(students::class, 'SectionID', 'SectionID')->with('registration');
    }

    
}