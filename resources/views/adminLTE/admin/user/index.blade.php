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
            <small>users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">top module</a></li>
            <li class="active">users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">users列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>created_at</th>
                                <th>email</th>
                                <th>id</th>
                                <th>name</th>
                                <th>password</th>
                                <th>remember_token</th>
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
                        url:  '/admin/user',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    },
                    edit: {
                        type: 'PUT',
                        url:  '/admin/user/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    },
                    remove: {
                        type: 'DELETE',
                        url:  '/admin/user/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    }
                },
                table: "#moduleTable",
                idSrc:  'id',
                fields: [
                            { 'label':  'email', 'name': 'email', },
                            { 'label':  'name', 'name': 'name', },
                { 'label':  'password', 'name': 'password', },
                { 'label':  'remember_token', 'name': 'remember_token', },
                                    ]
            } );
            editor.on('postCreate', function (e, json, data) {
                reload();
            });
            editor.on('postEdit', function (e, json, data) {
                reload();
            });
            editor.on('postRemove', function (e, json, data) {
                reload();
            });

            function reload() {
                setTimeout(function () {
                    table.clearPipeline().draw();
                }, 100);
            }

            table = $("#moduleTable").DataTable({
                dom: "Bfrtip",
                language: zhCN,
                processing: true,
                serverSide: true,
                select: true,
                paging: true,
                ajax: $.fn.dataTable.pipeline({
                    url: '/admin/user/pagination',
                    pages: 5
                }),
                columns: [
                        {  'data': 'created_at' },
                        {  'data': 'email' },
                        {  'data': 'id' },
                        {  'data': 'name' },
                        {  'data': 'password' },
                        {  'data': 'remember_token' },
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