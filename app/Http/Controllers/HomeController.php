<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $paymentTotal = Payment::sum('amount');
        
        return view('dashboard', compact('studentCount', 'teacherCount', 'paymentTotal'));
    }
}
