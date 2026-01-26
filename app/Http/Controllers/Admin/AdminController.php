<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // ===== Statistik umum =====
        $userCount = User::where('role', 'siswa')->count();
        $adminCount = User::where('role', 'admin')->count();
        $materialCount = Material::count();
        $coursesCount = Course::count();

        // ===== Grafik Payment Paid per bulan =====
        $payments = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'paid')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('total', 'month')
            ->toArray();

        // ===== Grafik Jumlah Siswa Baru per bulan =====
        $students = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('role', 'siswa')
            ->whereYear('created_at', date('Y'))
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('total', 'month')
            ->toArray();

        // ===== Grafik Pending vs Paid Payment =====
        $paidCount = Payment::where('status','paid')->count();
        $pendingCount = Payment::where('status','pending')->count();

        // ===== Jumlah Siswa per Course =====
        $studentsPerCourse = Course::withCount(['users as siswa_count' => function($query){
            $query->where('role','siswa');
        }])->get();

        $courseLabels = $studentsPerCourse->pluck('name');        // nama course
        $courseData   = $studentsPerCourse->pluck('siswa_count'); // jumlah siswa

        // ===== Array bulan 1-12 =====
        $labels = [];
        $paymentData = [];
        $studentData = [];
        for($i=1; $i<=12; $i++){
            $labels[] = Carbon::create()->month($i)->format('F');
            $paymentData[] = $payments[$i] ?? 0;
            $studentData[] = $students[$i] ?? 0;
        }

        return view('admin.dashboard', compact(
            'userCount', 'adminCount', 'materialCount', 'coursesCount',
            'labels', 'paymentData', 'studentData',
            'paidCount', 'pendingCount',
            'courseLabels', 'courseData'
        ));
    }
}
