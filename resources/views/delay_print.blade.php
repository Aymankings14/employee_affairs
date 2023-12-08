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
        <span class="text-darky right">تقرير التأخيرات </span>
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
        @foreach($delays as $delay)
            <tr>
                <td>{{$delay->name}}</td>
                <td>{{$delay->job_title}}</td>
                <td>{{$delay->department}}</td>
                <td>{{$delay->management}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div style="margin-bottom: 40px"></div>
    <table lang="ar">
        <thead>
        <th>التاريخ</th>
        <th>الساعة</th>
        </thead>
        <tbody>
        @foreach($delays as $licence)
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
    <div>
    </div>
</div>
</body>

</html>
