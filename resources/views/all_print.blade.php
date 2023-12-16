<!DOCTYPE html>
<html dir="rtl">

<head>
{{--    <title> </title>--}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: DejaVu Sans !important;
        }

        body {
            font-size: 16px;
            font-family: 'DejaVu Sans', 'Roboto', 'Montserrat', 'Open Sans', sans-serif;
            padding: 10px;
            margin: 10px;

            color: #777;
        }


        body {
            color: #777;
            text-align: right;
        }

        body h3 {
            color: #000;
        }

        body h3 {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .box-color{
            color: #fff;
            background: #00302e;
            display: inline-block;
            padding: 12px;
        }

        body a {
            color: #06f;
        }
        span.right {
            float: right;
        }

        span.left {
            float: left;
        }

        .fix {
            clear: both;
        }

        span.text-darky {
            font-size: 21px;
            margin-bottom: 22px;
            margin-top: 40px;
        }

        @page {
            size: a4;
            margin: 0;
            padding: 0;
        }

        .invoice-box table {
            direction: rtl;
            width: 100%;
            text-align: right;
            border: 1px solid;
            font-family: 'DejaVu Sans', 'Roboto', 'Montserrat', 'Open Sans', sans-serif;
        }


        .table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            text-align:center;
        }
        th {
            padding:10px;
            background-color: #092e2e;
            color:#fff;
            font-weight:normal;
            font-size:16px;
        }
        td {
            background-color: #dadbdc;
            color:#000
        }
    </style>
</head>

<body>
<div class="row">
    <div class="column">
        <span class="text-darky right box-color">جميع التقارير</span>
        <span class="text-darky left box-color">تاريخ إستخراج التقرير : {{$dayName}} </span>
        <div class="fix"></div>
    </div>
</div>
<div class="invoice-box">
    <table lang="ar">
        <thead>
        <th>إسم الموظف</th>
        <th>الوظيفة </th>
        <th>القسم </th>
        <th>الإدارة</th>
        </thead>
        <tbody>
        @foreach($punishments as $punishment)
            <tr>
                <td>{{$punishment->name}}</td>
                <td>{{$punishment->job_title}}</td>
                <td>{{$punishment->department}}</td>
                <td>{{$punishment->management}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div style="margin-bottom: 40px"></div>
    <h3 class="box-color">لائحة الإجازات</h3>
    <table lang="ar">
        <thead>
        <th>النوع </th>
        <th>المدة </th>
        <th>المدة المطلوبة</th>
        <th>تاريخ بدء الإجازة</th>
        <th>تاريخ إنتهاء الإجازة</th>
        </thead>
        <tbody>
        @foreach($leaves as $leave)
            @foreach($leave->leave as $l)
                <tr>
                    <td>{{$l->type}}</td>
                    <td>{{$l->duration}}</td>
                    <td>{{$l->required_duration}}</td>
                    <td>{{$l->start_date}}</td>
                    <td>{{$l->from_date}}</td>
                </tr>
            @endforeach
        @endforeach

        </tbody>
        <tfoot>
        <td>{{$leaves[0]->leave->count()}}</td>
        <td colspan="4">إجمالي الإجازات</td>
        </tfoot>
    </table>
    <div style="margin-bottom: 40px"></div>
    <h3 class="box-color">تقارير الجزاء</h3>
    <table lang="ar">
        <thead>
        <th>النوع</th>
        <th>الحكم</th>
        <th>التاريخ</th>
        <th>الساعة</th>
        <th>اليوم</th>
        </thead>
        <tbody>
        @foreach($punishments as $punishment)
                @foreach($punishment->punishment as $item)
                    @php
                        \Carbon\Carbon::setLocale('ar');
                        $dayName =\Carbon\Carbon::parse($item->date)->translatedFormat('l');
                            $type = $item->type;
                            $message = "";

                            switch ($type) {
                                case 'absence':
                                    $message = 'غياب';
                                    break;
                                case 'delay':
                                    $message = 'تأخير';
                                    break;
                                case 'negligence_at_work':
                                    $message = 'الإهمال بالعمل';
                                    break;
                                case 'leaving_during_work':
                                    $message = 'الخروج أثناء العمل';
                                    break;
                                default:
                                    $message = 'غير معروف النوع راجع المبرمج لحل المشكلة';
                                     }
                    @endphp
                    <tr>
                    <td>{{$message }}</td>
                    <td>{{$item->judge}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->time}}</td>
                    <td>{{$dayName}}</td>
                    </tr>
                @endforeach
        @endforeach

        </tbody>
        <tfoot>
        <td>{{$punishments[0]->punishment->count()}}</td>
        <td colspan="4">إجمالي لوائح الجزاء</td>
        </tfoot>
    </table>
    <div style="margin-bottom: 40px"></div>
    <h3 class="box-color">تقارير الإستئذانات</h3>
    <table lang="ar">
        <thead>
        <th>التاريخ </th>
        <th>اليوم </th>
        <th>من الساعة</th>
        <th>حتى الساعة</th>
        </thead>
        <tbody>
        @foreach($approvals as $approval)
            @foreach($approval->approval as $item)
                <tr>
                    <td>{{$item->date}}</td>
                    <td>{{$item->day}}</td>
                    <td>{{$item->from_hour}}</td>
                    <td>{{$item->to_hour}}</td>
                </tr>
            @endforeach
        @endforeach

        </tbody>
        <tfoot>
        <td>{{$approvals[0]->approval->count()}}</td>
        <td colspan="3">إجمالي الاستئذانات</td>
        </tfoot>
    </table>
    <div style="margin-bottom: 40px"></div>
    <h3 class="box-color">تقارير الرخص</h3>
    <table lang="ar">
        <thead>
        <th>نوع الرخصة </th>
        <th>السبب </th>
        <th>مدتها</th>
        <th>من الساعة</th>
        <th>حتى الساعة</th>
        </thead>
        <tbody>
        @foreach($licences as $licence)
            @foreach($licence->licence as $item)
                <tr>
                    <td>{{$item->type}}</td>
                    <td>{{$item->reason}}</td>
                    <td>{{$item->time}}</td>
                    <td>{{$item->from_date}}</td>
                    <td>{{$item->to_date}}</td>
                </tr>
            @endforeach
        @endforeach

        </tbody>
        <tfoot>
        <td>{{$licences[0]->licence->count()}}</td>
        <td colspan="4">إجمالي الرخص</td>
        </tfoot>
    </table>
    <div style="margin-bottom: 40px"></div>
    <h3 class="box-color">تقرير التأخيرات</h3>
    <table lang="ar">
        <thead>
        <th>التاريخ</th>
        <th>الساعة</th>
        </thead>
        <tbody>
        @foreach($delays as $delay)
            @foreach($delay->punishment as $item)
                <tr>
                    <td>{{$item->date}}</td>
                    <td>{{$item->time}}</td>
                </tr>
            @endforeach
        @endforeach

        </tbody>
        <tfoot>
        <td>{{$delays[0]->punishment->count()}}</td>
        <td colspan="1">إجمالي التأخيرات</td>
        </tfoot>
    </table>
    <div style="margin-bottom: 40px"></div>
    <h3 class="box-color">التقرير الطبي</h3>
    <table lang="ar">
        <thead>
        <th>السبب</th>
        <th>المدة</th>
        <th>تاريخ البداية</th>
        <th>تاريخ الإنتهاء</th>
        <th>تاريخ بداية العمل</th>
        </thead>
        <tbody>
        @foreach($medicals as $medical)
            @foreach($medical->medical as $item)
                <tr>
                    <td>{{$item->reason}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->from_date}}</td>
                    <td>{{$item->to_date}}</td>
                    <td>{{$item->start_work}}</td>
                </tr>
            @endforeach
        @endforeach

        </tbody>
        <tfoot>
        <td>{{$medicals[0]->medical->count()}}</td>
        <td colspan="4">إجمالي التقارير الطبية</td>
        </tfoot>
    </table>
</div>
</body>

</html>
