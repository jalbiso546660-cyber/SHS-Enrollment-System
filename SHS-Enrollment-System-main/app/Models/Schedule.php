<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $primaryKey = 'ScheduleID';
    public $timestamps = false;

    protected $fillable = [
        'SubjectID',
        'TeacherID',
        'SectionID',
        'RoomID',
        'Day',
        'Start_Time',
        'End_Time'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SubjectID', 'SubjectID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'TeacherID', 'TeacherID');
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