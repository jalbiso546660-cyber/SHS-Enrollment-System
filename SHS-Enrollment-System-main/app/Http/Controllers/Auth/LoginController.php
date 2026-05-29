<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    protected function authenticated($user)
    {
        if ($user->role === 'Cashier') {
            return redirect()->route('students_payment.Payment_list');
        }
        
        elseif ($user->role === 'Registrar') {
            return redirect()->route('students_registration.index');
        }
        
        elseif ($user->role === 'Operator') {
            return redirect()->route('room.index', 'students.index','room.index','schedule.index','subject.index','teacher.index','section.index');
        }

        return redirect('/dashboard'); 
    }
}