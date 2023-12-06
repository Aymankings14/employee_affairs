<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\License;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//          $employees = Employee::find(5);
//          return $employees->total_approvals;
        $employees = Employee::select('id', 'name')->get();
        return view('license', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required',
            'type' => 'required',
            'reason' => 'required',
            'time' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $license = new License();
        $license->employee_id = $data['employee_id'];
        $license->type = $data['type'];
        $license->reason = $data['reason'];
        $license->time = $data['time'];
        $license->from_date = Carbon::parse($data['from_date'])->format('Y-m-d H:i');
        $license->to_date = Carbon::parse($data['to_date'])->format('Y-m-d H:i');

        if ($license->save()) {
            Alert::success('نجاح', 'تم إضافة الرخصة '.$license->from_date);
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
