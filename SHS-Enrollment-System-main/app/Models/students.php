<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'StudentID';
    public $timestamps = false;

    protected $fillable = [
        'RegistrationID',
        'DOB',
        'Gender',
        'Address',
        'ContactNo',
        'Email',
        'StrandID',
        'GradeLevel',
        'SectionID',
        
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'RegistrationID', 'RegistrationID');
    }

    public function strand()
    {
        return $this->belongsTo(Strand::class, 'StrandID', 'StrandID');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'SectionID', 'SectionID');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'RoomID', 'RoomID');
    }
}
