<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'RoomID';
    public $timestamps = false; 


    protected $fillable = [
        'Room_Number',
        'Building',
        'Floor',
        'Room_Type',
        'StrandID',
        'Grade_Level',
        'Capacity',
        'is_available'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'RoomID', 'RoomID');
    }

    public function strand()
    {
        return $this->belongsTo(Strand::class, 'StrandID', 'StrandID');
    }

    public function students()
    {
        return $this->hasMany(students::class, 'RoomID', 'RoomID');
    }

}