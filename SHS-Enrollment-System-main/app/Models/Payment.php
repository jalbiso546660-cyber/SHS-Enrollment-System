<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'PaymentID';

    protected $fillable = [
        'RegistrationID',
        'Payment_Method',
        'Amount',
        'Reference_Number',
        'receipt',
        'Payment_Date',
        'Status',

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

    public function Payment()
    {
        return $this->belongsTo(Payment::class, 'PaymentID');
    }

    public function student()
    {
        return $this->belongsTo(StudentRegistration::class, 'RegistrationID', 'RegistrationID');
    }

    public function registration()
    {
        return $this->belongsTo(StudentRegistration::class, 'RegistrationID', 'RegistrationID');
    }


}
