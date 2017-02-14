@extends('admin.layout.collapsed-sidebar')

@section('styles')
    @include('admin.layout.datatable-css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            系统管理
            <small>数据表字段管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">数据表字段管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">数据表【{{$table->name}}】字段列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="columnTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>sys_table_id</th>
                                <th>行号</th>
                                <th>名称</th>
                                <th>描述</th>
                                <th>数据类型</th>
                                <th>是否可空</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection

@section('js')
    @include('admin.layout.datatable-js')
    <script type="text/javascript">
        $(function () {
            seajs.use('admin/sys_column.js', function (app) {
                app.index($, 'columnTable', '{{$table->id}}');
            });
        });
    </script>

@endsection