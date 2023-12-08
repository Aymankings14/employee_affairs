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
            color: #555;
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
            background-color: #03A9F4;
            color:#fff;
            font-weight:normal;
            font-size:16px;
        }
        td {
            background-color: #607D8B;
            color:#FFF
        }
    </style>
</head>

<body>
<div class="row">
    <div class="column">
        <span class="text-darky right">تقارير لائحة الجزاء</span>
        <span class="text-darky left">تاريخ إستخراج التقرير : {{$dayName}} </span>
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
    <div>
    </div>
</div>
</body>

</html>
