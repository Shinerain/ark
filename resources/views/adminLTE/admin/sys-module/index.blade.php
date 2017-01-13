@extends('admin.layout.collapsed-sidebar')

@section('styles')
    @include('admin.layout.datatable-css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            系统管理
            <small>模块管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">模块管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">模块列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>名称</th>
                                    <th>描述</th>
                                    <th>图标</th>
                                    <th>排序</th>
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

@endsection

@section('js')
    @include('admin.layout.datatable-js')
    <script type="text/javascript">
        var editor; // use a global for the submit and return data rendering in the examples
        var table;

        $(function () {
            var editor = new $.fn.dataTable.Editor({
                ajax: {
                    create: {
                        type: 'POST',
                        url: '/admin/sys-module',
                        data: {_token: $('meta[name="_token"]').attr('content')},
                    },
                    edit: {
                        type: 'PUT',
                        url: '/admin/sys-module/_id_',
                        data: {_token: $('meta[name="_token"]').attr('content')},
                    },
                    remove: {
                        type: 'DELETE',
                        url: '/admin/sys-module/_id_',
                        data: {_token: $('meta[name="_token"]').attr('content')},
                    }
                },
                table: "#moduleTable",
                idSrc: 'id',
                fields: [
                    {'label': 'name', 'name': 'name',},
                    {'label': 'display_name', 'name': 'display_name',},
                    {'label': 'description', 'name': 'description',},
                    {'label': 'icon', 'name': 'icon',},
                ]
            });

            table = $("#moduleTable").DataTable({
                dom: "Bfrtip",
                language: zhCN,
                processing: true,
                serverSide: true,
                select: true,
                paging: true,
                ajax: '/admin/sys-module/pagination',
                columns: [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "desc" },
                    { "data": "icon" },
                    { "data": "sort" },
                    { "data": "created_at" },
                    { "data": "updated_at" },
                ],
                buttons: [
                    { extend: "create", text:"create", action: function () {
                        alert(1);
                    } },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                ],
            });


        });

    </script>
@endsection