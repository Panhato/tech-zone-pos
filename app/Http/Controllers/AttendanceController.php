<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
public function index()
{
    // ១. ទាញយកវត្តមានថ្ងៃនេះមកបង្ហាញ
    $attendances = Attendance::with('employee')
                    ->whereDate('date', \Carbon\Carbon::today())
                    ->latest()
                    ->get();
    
    // ២. ទាញយកតែទិន្នន័យបុគ្គលិកដែលត្រូវនឹងគណនីកំពុង Login ប៉ុណ្ណោះ
    $employees = Employee::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
    
    return view('admin.attendances.index', compact('attendances', 'employees'));
}

    public function store(Request $request)
    {
        // ១. ស្វែងរកព័ត៌មានបុគ្គលិកដែលត្រូវនឹងគណនីកំពុង Login (Link តាម user_id)
        $employee = Employee::where('user_id', Auth::id())->first();

        // ២. ឆែកមើលថា តើគណនី User នេះបានភ្ជាប់ជាមួយព័ត៌មានបុគ្គលិកហើយឬនៅ?
        if (!$employee) {
            return back()->with('error', 'គណនីនេះមិនទាន់បានភ្ជាប់ជាមួយព័ត៌មានបុគ្គលិកទេ! សូមទាក់ទង Admin ធំ។');
        }

        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();

        // ៣. ឆែកមើលថាតើបុគ្គលិកនេះបាន Check-in ថ្ងៃនេះហើយឬនៅ
        $attendance = Attendance::where('employee_id', $employee->id)
                                ->whereDate('date', $today)
                                ->first();

        if (!$attendance) {
            // បើមិនទាន់មានទិន្នន័យ គឺបង្កើតការ Check-in
            Attendance::create([
                'employee_id' => $employee->id,
                'date' => $today,
                'check_in' => $now,
                'status' => 'present'
            ]);
            return back()->with('success', 'ចុះវត្តមានចូល (Check-in) ជោគជ័យ!');
        } else {
            // បើមានហើយ គឺធ្វើការ Update Check-out
            $attendance->update(['check_out' => $now]);
            return back()->with('success', 'ចុះវត្តមានចេញ (Check-out) ជោគជ័យ!');
        }
    }
}