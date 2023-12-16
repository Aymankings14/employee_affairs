<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Interruption;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee', compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employeeCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'job_title' => 'required|max:20',
            'work_id_number' => 'required',
            'civil_id_number' => 'required',
            'phone' => 'required',
            'appointment_date' => 'required|date',
            'department' => 'required|max:20',
            'management' => 'required|max:20',
        ], [
            'name.required' => 'برجاء إدخال إسم الموظف',
            'name.max' => 'يجب أن لا يتجاوز إسم الموظف 20 حرف',
            'job_title.required' => 'برجاء إدخال المسمى الوظيفي',
            'job_title.max' => 'يجب أن لا يتجاوز المسمى الوظيفي 20 حرف',
            'work_id_number.required' => 'برجاء إدخال رقم هوية العمل',
            'civil_id_number.required' => 'برجاء إدخال الرقم المدني',
            'appointment_date.required' => 'برجاء إختيار تاريخ التعيين',
            'appointment_date.date' => 'برجاء أن يكون تاريخ التعيين تاريخ صالحاً',
            'department.required' => 'برجاء إدخال القسم',
            'department.max' => 'يجب أن لا يتجاوز القسم 20 حرف',
            'management.required' => 'برجاء إدخال الإدارة',
            'management.max' => 'يجب أن لا تتجاوز الإدارة 20 حرف',
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->job_title = $request->job_title;
        $employee->work_id_number = $request->work_id_number;
        $employee->civil_id_number = $request->civil_id_number;
        $employee->phone = $request->phone;
        $employee->appointment_date = $request->appointment_date;
        $employee->department = $request->department;
        $employee->management = $request->management;
        if ($employee->save()) {
            Alert::success('نجاح', 'تم حفظ الموظف بنجاح');
            return back();
        }

        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Employee::findOrFail($id)->delete()) {
            Alert::success('نجاح', 'تم حذف الموظف بنجاح');
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }

    public function getEmployeeInfo($id)
    {
        $employee = Employee::find($id);
        return response()->json([
            'id' => $employee->id,
            'job_title' => $employee->job_title,
            'civil_id_number' => $employee->civil_id_number,
            'department' => $employee->department,
            'management' => $employee->management,
            'total_medicals' => $employee->total_medicals,
            'total_approvals' => $employee->total_approvals,
            'total_absences' => $employee->total_absences,
            'total_delays' => $employee->total_delays,
        ]);
    }
}
