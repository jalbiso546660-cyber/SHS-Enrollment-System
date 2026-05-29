<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'student_registration';
    protected $primaryKey = 'RegistrationID';

    protected $fillable = [
        'RegistrationID',
        'FirstName',
        'MiddleName',
        'LastName',
        'DOB',
        'Gender',
        'Address',
        'ContactNo',
        'Email',
        'GradeLevel',
        'Form138',
        'Strand',
        'FatherFullName',
        'MotherFullName',
        'FatherContactNo',
        'MotherContactNo',
        'application_date',
        'approved_date',
        'rejected_date',
        'current_status'
    ];

    public static function validateFields($data)
    {
        foreach (self::$fillable as $field) {
            if (empty($data[$field])) {
                return "Please fill up all fields";
            }
        }
        return null;
    }


    public $timestamps = false;

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'RegistrationID');
    }
    
}
