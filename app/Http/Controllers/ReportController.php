<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(){

        $employees = Employee::select('id','name')->get();
        $types= [
            'all' => 'جميع التقارير',
            'leave' => 'إجازة',
            'approval'=>'إستئذان',
            'licence'=>'رخصة',
            'delay'=>'تأخير',
            'medical'=>'التقرير الطبي',
            'punishment'=>'لائحة الجزاء',
        ];
        return view('report',compact('employees','types'));
    }
    public function store(Request $request){
        Carbon::setLocale('ar');
        $dayName = Carbon::parse(now())->translatedFormat('l Y-m-d');
        if($request->type == 'all'){
            $leaves= Employee::where('id',$request->employee_id)->with(['leave'=> function($q) use($request){
                $q->whereBetween('from_date',[$request->from_date,$request->to_date]);
            }])->get();
            $approvals= Employee::where('id',$request->employee_id)->with(['approval'=> function($q) use($request){
                $q->whereBetween('date',[$request->from_date,$request->to_date]);
            }])->get();
            $licences= Employee::where('id',$request->employee_id)->with(['licence'=> function($q) use($request){
                $q->whereBetween('from_date',[$request->from_date,$request->to_date])
                    ->orWhereBetween('to_date',[$request->from_date,$request->to_date]);
            }])->get();
            $delays= Employee::where('id',$request->employee_id)->with(['punishment'=> function($q) use($request){
                $q->where('type','delay')->whereBetween('date',[$request->from_date,$request->to_date]);
            }])->get();
            $punishments= Employee::where('id',$request->employee_id)->with('punishment')->get();
            $medicals= Employee::where('id',$request->employee_id)->with(['medical'=> function($q) use($request){
                $q->whereBetween('from_date',[$request->from_date,$request->to_date])
                    ->orWhereBetween('to_date',[$request->from_date,$request->to_date]);
            }])->get();
            $html = view('all_print',compact(['punishments','dayName','delays','leaves','approvals','licences','medicals']))->toArabicHTML();
            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$punishments[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }
        elseif ($request->type == 'leave'){
            $leaves= Employee::where('id',$request->employee_id)->with(['leave'=> function($q) use($request){
                $q->whereBetween('from_date',[$request->from_date,$request->to_date]);
            }])->get();
            $html = view('print',compact('leaves','dayName'))->toArabicHTML();

            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$leaves[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }
        elseif ($request->type == 'approval')
        {
            $approvals= Employee::where('id',$request->employee_id)->with(['approval'=> function($q) use($request){
                $q->whereBetween('date',[$request->from_date,$request->to_date]);
            }])->get();
             $html = view('approval_print',compact('approvals','dayName'))->toArabicHTML();

            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$approvals[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }
        elseif ($request->type == 'licence')
        {
            $licences= Employee::where('id',$request->employee_id)->with(['licence'=> function($q) use($request){
                $q->whereBetween('from_date',[$request->from_date,$request->to_date])
                    ->orWhereBetween('to_date',[$request->from_date,$request->to_date]);
            }])->get();
             $html = view('licence_print',compact('licences','dayName'))->toArabicHTML();

            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$licences[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }
        elseif ($request->type == 'delay')
        {
            $delays= Employee::where('id',$request->employee_id)->with(['punishment'=> function($q) use($request){
                $q->where('type','delay')->whereBetween('date',[$request->from_date,$request->to_date]);
            }])->get();

            $html = view('delay_print',compact('delays','dayName'))->toArabicHTML();

            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$delays[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }
        elseif ($request->type == 'medical')
        {
             $medicals= Employee::where('id',$request->employee_id)->with(['medical'=> function($q) use($request){
                $q->whereBetween('from_date',[$request->from_date,$request->to_date])
                    ->orWhereBetween('to_date',[$request->from_date,$request->to_date]);
            }])->get();
             $html = view('medical_print',compact('medicals','dayName'))->toArabicHTML();

            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$medicals[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }
        elseif ($request->type == 'punishment')
        {
            $punishments= Employee::where('id',$request->employee_id)->with('punishment')->get();
             $html = view('punishment_print',compact('punishments','dayName'))->toArabicHTML();

            $pdf = PDF::loadHTML($html)->output();

            $headers = array(
                "Content-type" => "application/pdf",
            );
            return response()->streamDownload(
                fn () => print($pdf),
                "Employee-".str_replace(' ','-',$punishments[0]['name'])."-report-".date("Y-m-d").".pdf", // the name of the file/stream
                $headers
            );
        }

    }
}
