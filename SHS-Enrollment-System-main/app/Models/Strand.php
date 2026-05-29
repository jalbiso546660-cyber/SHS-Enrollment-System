<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    protected $table = 'strands';
    protected $primaryKey = 'StrandID';
    public $timestamps = false;

    protected $fillable = [
        'Strand_Name',
        'description'
    ];

    public function students()
    {
        return $this->hasMany(students::class, 'Strand', 'Strand_Name');
    }
}