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
        <span class="text-darky right box-color">تقرير الرخص </span>
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
        @foreach($licences as $licence)
            <tr>
                <td>{{$licence->name}}</td>
                <td>{{$licence->job_title}}</td>
                <td>{{$licence->department}}</td>
                <td>{{$licence->management}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div style="margin-bottom: 40px"></div>
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
    <div>
    </div>
</div>
</body>

</html>
