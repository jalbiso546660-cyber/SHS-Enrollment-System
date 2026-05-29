<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Payment;
use App\Models\Strand;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\PaymentApproved;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    //para sa email nga ma send sa student after ma approve ang registration
    public function index()
    {
        
            $registration = Registration::where('current_status', 'Approved')
                ->latest('approved_date')
                ->firstOrFail();

            Mail::to($registration->Email)
                ->send(new TestMail($registration));
    }

    //para sa email nga ma send sa student after ma approve ang payment
    public function PaymentApproved($id)
    {
        try {
            $payment = Payment::with('registration')->findOrFail($id);
            $registration = $payment->registration;

            // Get strand and section
            $strand = Strand::where('Strand_Name', $registration->Strand)->firstOrFail();
            $section = Section::where('StrandID', $strand->StrandID)
                ->where('Grade_Level', $registration->GradeLevel)
                ->firstOrFail();

            // Get room
            $room = Room::where('StrandID', $strand->StrandID)
                ->where('Grade_Level', $registration->GradeLevel)
                ->where('is_available', true)
                ->inRandomOrder()
                ->firstOrFail();

            // Get subjects
            $subjects = Subject::where('StrandID', $strand->StrandID)
                ->where('Grade_Level', $registration->GradeLevel)
                ->get();

            // Send email with all required parameters
            Mail::to($registration->Email)
                ->send(new PaymentApproved(
                    $payment, 
                    $registration, 
                    $section, 
                    $strand, 
                    $room, 
                    $subjects
                ));

            Log::info('Payment approval email sent', [
                'payment_id' => $payment->PaymentID,
                'email' => $registration->Email,
                'strand' => $strand->Strand_Name,
                'section' => $section->Section_Name,
                'room' => $room->Room_Number,
                'subjects_count' => $subjects->count()
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to send payment approval email', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}

