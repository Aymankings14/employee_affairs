<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('index')}}" class="brand-link">

        <span class="brand-text font-weight-light">الصفحة الرئيسية</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('employee.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            بيانات الموظفين
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('leave.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-id-card"></i>
                        <p>
                            طلب تحديد إجازة
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('approval.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-pencil-alt"></i>
                        <p>
                            طلب إستئذان
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('license.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-clipboard-list"></i>
                        <p>
                            طلب رخصة صغيرة
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('medical.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-clinic-medical"></i>
                        <p>
                            التقرير الطبي
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('interruption.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-window-close"></i>
                        <p>
                            إنقطاع عن العمل
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('punishment.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            لائحة الجزاء
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('report.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-chart-pie"></i>
                        <p>
                            التقارير
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
