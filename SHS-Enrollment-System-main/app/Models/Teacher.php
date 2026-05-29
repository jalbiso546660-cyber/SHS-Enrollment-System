<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'TeacherID';
    public $timestamps = false;
    
    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Contact_Number',
        'Address',
        'DOB',
        'Gender',
        'Subject_Specialization',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'TeacherID', 'TeacherID');
    }
}