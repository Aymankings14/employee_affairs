<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Employee;
use App\Models\Medical;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MedicalController extends Controller
{
    public function index(){
        $employees = Employee::select('id','name')->get();
        return view('medical',compact('employees'));
    }
    public function store(Request $request){
        $data =$request->validate([
            'employee_id'=> 'required',
            'reason'=>'required',
            'date'=>'required',
            'from_date'=>'required|date',
            'to_date'=>'required|date',
            'start_work'=>'required|date',
        ]);
        $medical =new Medical();
        $medical->employee_id = $data['employee_id'];
        $medical->reason = $data['reason'];
        $medical->date = $data['date'];
        $medical->from_date = $data['from_date'];
        $medical->to_date = $data['to_date'];
        $medical->start_work = $data['to_date'];

        if($medical->save()) {
            Alert::success('نجاح', 'تم إضافة التقرير الطبي');
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }

    public function getHijriDay(Request $request)
    {
        Carbon::setLocale('ar');
        $selectedDate = $request->input('selectedDate');
        $dayName =Carbon::parse($selectedDate)->translatedFormat('l');
        return response()->json(['dayName' => $dayName]);
    }

}
