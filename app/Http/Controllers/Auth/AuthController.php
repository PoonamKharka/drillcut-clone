<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{

    /**
     * Display logi form of admin
     *
     * @return \Illuminate\Http\Response
     */
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    /**
     * for logging in
     *
     * @return \Illuminate\Http\Request
     */
    public function postLogin(Request $request)
    {
        try {
            $credentials = [
                'username' => $request->username,
                'password' =>  $request->password
            ];

            if( Auth::attempt($credentials)) {
                return redirect('admin-dashboard')->with('success', 'Login Successfully!');;
            } 
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * after successful login redirect to admin dashboard page
     */
    public function showDashboard() 
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Start from the first day of the current month
        $startDate = Carbon::create($currentYear, $currentMonth, 1);

        // Get the last day of the current month
        $endDate = $startDate->copy()->endOfMonth();

        // Initialize an array to store the dates
        $labels = [];

        // Loop through the month, adding 3 days each time
        while ($startDate->lte($endDate)) {
            $labels[] = $startDate->format('M d');
            $startDate->addDays(3);
        }

        // Sample data for the chart, replace with your actual data
        $data = array_fill(0, count($labels), rand(10, 100)); // Example data for illustration

        //return view('chart', compact('labels', 'data')); 
        return view('admin.dashboard', compact('labels', 'data'));
    }

    /**
     * This function is for logout
    */    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
