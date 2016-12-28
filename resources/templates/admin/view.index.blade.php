{!! "@extends('layout.collapsed-sidebar')" !!}

{!! "@section('styles')" !!}
    {{--<link rel="stylesheet" href="/asset/datatable/css/jquery.dataTables.min.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/css/dataTables.bootstrap.css" />
    {{--<link rel="stylesheet" href="/asset/datatable/extensions/Buttons/css/buttons.dataTables.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/extensions/Buttons/css/buttons.bootstrap.css" />
    {{--<link rel="stylesheet" href="/asset/datatable/extensions/Select/css/select.dataTables.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/extensions/Select/css/select.bootstrap.css" />
    {{--<link rel="stylesheet" href="/asset/datatable/extensions/Editor/css/editor.dataTables.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/extensions/Editor/css/editor.bootstrap.css" />

{!! "@endsection" !!}

{!! "@section('content')" !!}
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

{!! "@endsection" !!}

{!! "@section('js')" !!}
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
        var editor; // use a global for the submit and return data rendering in the examples
        var table;

        $(function () {
            editor = new $.fn.dataTable.Editor( {
                ajax: {
                    type: 'POST',
                    url: "/admin/sys-module/action",
                    data: { _token: $('meta[name="_token"]').attr('content') }
                },
                table: "#moduleTable",
                idSrc:  'id',
                fields: [ {
                    label: "id:",
                    name: "id"
                }, {
                    label: "name:",
                    name: "name"
                }, {
                    label: "desc:",
                    name: "desc"
                }, {
                    label: "icon:",
                    name: "icon"
                }, {
                    label: "sort:",
                    name: "sort"
                }, {
                    label: "created_at date:",
                    name: "created_at",
                    type: "datetime"
                }, {
                    label: "updated_at date:",
                    name: "updated_at",
                    type: "datetime"
                },
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
                    url: '/admin/sys-module/pagination',
                    pages: 5
                }),
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
                    { extend: "create", editor: editor },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                ]
            });

            $('#moduleTable tbody').on( 'click', '.edit', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url='/admin/sys-module/'+data['id']+'/edit';
                window.location.href=url;
            } );

            $('#moduleTable tbody').on( 'click', '.remove', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var p = {
                    _token: $('meta[name="_token"]').attr('content'),
                    _method: 'DELETE'
                };
                layer.confirm('are you sure ?' , { btn: ['yes', 'no'] }, function () {
                    //alert( data['id'] +" remove " );
                    $.post('/admin/sys-module/'+ data['id'], p, function (re) {
                        layer.msg('delete success!');
                    });
                }, function () {
                    layer.close();
                });
            });

        });

    </script>
{!! "@endsection" !!}