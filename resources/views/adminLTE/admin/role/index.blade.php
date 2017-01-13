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
            top module
            <small>roles</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">top module</a></li>
            <li class="active">roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">roles列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>created_at</th>
                                <th>description</th>
                                <th>display_name</th>
                                <th>id</th>
                                <th>name</th>
                                <th>updated_at</th>
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

@endsection
@section('js')    <script src="/asset/datatable/js/jquery.dataTables.js"></script>
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
        var editor; // use a global for the submit and return data rendering in the examples
        var table;

        $(function () {
            editor = new $.fn.dataTable.Editor( {
                ajax: {
                    create: {
                        type: 'POST',
                        url:  '/admin/role',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    },
                    edit: {
                        type: 'PUT',
                        url:  '/admin/role/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    },
                    remove: {
                        type: 'DELETE',
                        url:  '/admin/role/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    }
                },
                table: "#moduleTable",
                idSrc:  'id',
                fields: [
                            { 'label':  'description', 'name': 'description', },
                { 'label':  'display_name', 'name': 'display_name', },
                            { 'label':  'name', 'name': 'name', },
                                    ]
            } );

            table = $("#moduleTable").DataTable({
                dom: "Bfrtip",
                language: zhCN,
                processing: true,
                serverSide: true,
                select: true,
                paging: true,
                ajax: $.fn.dataTable.pipeline({
                    url: '/admin/role/pagination',
                    pages: 5
                }),
                columns: [
                        {  'data': 'created_at' },
                        {  'data': 'description' },
                        {  'data': 'display_name' },
                        {  'data': 'id' },
                        {  'data': 'name' },
                        {  'data': 'updated_at' },
                        ],
                buttons: [
                    { extend: "create", text: '新增', editor: editor },
                    { extend: "edit", text: '编辑',  editor: editor },
                    { extend: "remove", text: '删除', editor: editor }
                ]
            });

        });

    </script>
@endsection