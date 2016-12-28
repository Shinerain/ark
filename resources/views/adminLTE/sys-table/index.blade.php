@extends('layout.collapsed-sidebar')

@section('styles')

    <link rel="stylesheet" href="/asset/datatable/css/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="/asset/datatable/extensions/Buttons/css/buttons.bootstrap.css" />
    <link rel="stylesheet" href="/asset/datatable/extensions/Select/css/select.bootstrap.css" />
    <link rel="stylesheet" href="/asset/datatable/extensions/Editor/css/editor.bootstrap.css" />

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            系统管理
            <small>数据表管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">数据表管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">数据表列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>sys_module_id</th>
                                    <th>name</th>
                                    <th>desc</th>
                                    <th>icon</th>
                                    <th>创建时间</th>
                                    <th>修改时间</th>
                                </tr>
                            </thead>
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
    <form id="delForm" action="" method="post">
        {!! csrf_field() !!}
        {!! method_field('DELETE') !!}
    </form>
@endsection

@section('js')
    <script src="/asset/datatable/js/jquery.dataTables.js"></script>
    <script src="/asset/datatable/js/dataTables.bootstrap.js"></script>
    <script src="/asset/datatable/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="/asset/datatable/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
    <script src="/asset/datatable/extensions/Select/js/dataTables.select.min.js"></script>
    <script src="/asset/datatable/extensions/Editor/js/dataTables.editor.js"></script>
    <script src="/asset/datatable/extensions/Editor/js/editor.bootstrap.js"></script>

    <script src="/asset/datatable/js/pipeline.js"></script>
    <script src="/asset/datatable/js/zh_CN.js"></script>
    <script src="/asset/AdminLTE-2.3.7/dist/js/demo.js"></script>
    <script type="text/javascript">

        var table;
        $(function () {

            table = $("#moduleTable").DataTable({
                dom: "Bfrtip",
                language: zhCN,
                processing: true,
                serverSide: true,
                select: true,
                paging: true,
                ajax: $.fn.dataTable.pipeline({
                    url: '/admin/sys-table/pagination',
                    pages: 5
                }),
                columns: [
                    { "data": "id" },
                    { "data": "sys_module_id" },
                    { "data": "name" },
                    { "data": "desc" },
                    { "data": "icon" },
                    { "data": "created_at" },
                    { "data": "updated_at" },
                ],
                buttons: [
                    { extend: "create", text: '新增', action: function ( e, dt, node, config ) {
                         window.location.href = '{{route('sys-table.create')}}';
                    } },
                    { extend: "edit", text: '编辑', action: function ( e, dt, node, config ) {
                        var data = dt.row().data();
                        //console.info(data);
                        var id = data.id;
                        //alert(id);
                        window.location.href = '/admin/sys-table/' + id + '/edit';
                    } },
                    { extend: "remove", text: '删除', action: function ( e, dt, node, config ) {
                        var data = dt.row().data();
                        var id = data.id;
                        var url =  '/admin/sys-table/' + id;
                        $('#delForm').attr('action', url);
                        $('#delForm').submit();
                    } }
                ]
            });

        });

    </script>
@endsection