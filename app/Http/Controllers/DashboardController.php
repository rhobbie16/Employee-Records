<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Stats cards
        $totalEmployees    = DB::table('employees')->count();
        $activeEmployees   = DB::table('employees')->where('status', 'active')->count();
        $inactiveEmployees = DB::table('employees')->where('status', 'inactive')->count();
        $totalDepartments  = DB::table('departments')->count();
        $systemUsers       = DB::table('users')->count();

        // Bar chart
        $deptData   = DB::table('departments')
                        ->leftJoin('employees', 'departments.id', '=', 'employees.department_id')
                        ->selectRaw('departments.name, COUNT(employees.id) as count')
                        ->groupBy('departments.id', 'departments.name')
                        ->get();

        $deptLabels = $deptData->pluck('name');
        $deptCounts = $deptData->pluck('count');

        // Line chart
        $monthLabels  = collect();
        $monthlyHires = collect();

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels->push($date->format('M Y'));
            $monthlyHires->push(
                DB::table('employees')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            );
        }

        return view('dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'totalDepartments',
            'systemUsers',
            'deptLabels',
            'deptCounts',
            'monthLabels',
            'monthlyHires',
        ));
    }
}