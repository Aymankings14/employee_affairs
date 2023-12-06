<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Punishment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PunishmentController extends Controller
{
    public function index(){
        $employees = Employee::select('id','name')->get();
        $types= [
            'absence' => 'الغياب',
            'delay'=>'التأخير',
            'negligence_at_work'=>'الإهمال بالعمل',
            'leaving_during_work'=>'الخروج أثناء العمل'
        ];
        return view('punishment',compact('employees','types'));
    }
    public function store(Request $request){
        $data =$request->validate([
            'employee_id'=> 'required',
            'type'=>'required|in:absence,delay,negligence_at_work,leaving_during_work',
            'judge'=>'required',
            'date'=>'required|date',
            'time'=>'required|date_format:H:i',
        ]);
//        $data['type'] = str_replace('_',' ',$data['type']);
        $punishment =new Punishment();
        $punishment->employee_id = $data['employee_id'];
        $punishment->type = $data['type'];
        $punishment->judge = $data['judge'];
        $punishment->date = $data['date'];
        $punishment->time = $data['time'];

        if($punishment->save()) {
            Alert::success('نجاح', 'تم إضافة اللائحة');
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }
}
