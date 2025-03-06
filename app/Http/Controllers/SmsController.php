<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SmsHelper;
use App\Models\Student;

class SmsController extends Controller
{
    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:sms_add' => ['sendSmsToStudent', 'smsForm'],
        ];
    }

    public function sendSmsToStudent(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',  // Validate phone number as a string (it can have multiple numbers separated by commas)
            'message' => 'required|string|max:160',
        ]);

        $phoneNumbers = explode(',', $request->input('phone_number'));  // Separate the phone numbers by comma
        $message = $request->input('message') . "\n\nTalimul Islam School and Madrasha";

        // Loop through each phone number and send SMS
        foreach ($phoneNumbers as $phoneNumber) {
            $phoneNumber = trim($phoneNumber);  // Remove any extra spaces
            if (preg_match('/^\d{11}$/', $phoneNumber)) {  // Check if the phone number is valid (11 digits)
                $response = SmsHelper::sendSms($phoneNumber, $message);

                // Check if 'status' exists in the response array
                if (isset($response['status']) && $response['status'] != 'success') {
                    return redirect()->back()->with('error', 'Failed to send SMS.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid phone number: ' . $phoneNumber);
            }
        }

        return redirect()->back()->with('success', 'SMS sent successfully!');
    }



    public function smsForm()
    {
        return view('admin.sms.view');
    }

    public function getStudentPhoneNumbers()
    {
        $phoneNumbers = Student::pluck('mobile')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    }

    public function getTeacherPhoneNumbers()
    {
        $phoneNumbers = Teacher::pluck('phone_number')->toArray();
        return response()->json(['success' => true, 'phone_numbers' => $phoneNumbers]);
    }

    public function getAllPhoneNumbers()
    {
        $studentNumbers = Student::pluck('mobile')->toArray();
        $teacherNumbers = Teacher::pluck('phone_number')->toArray();
        $allNumbers = array_unique(array_merge($studentNumbers, $teacherNumbers));

        return response()->json(['success' => true, 'phone_numbers' => $allNumbers]);
    }


}
