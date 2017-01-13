@extends('layout.collapsed-sidebar')

@section('styles')
    {{--<link rel="stylesheet" href="/asset/datatable/css/jquery.dataTables.min.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/css/dataTables.bootstrap.css" />
    {{--<link rel="stylesheet" href="/asset/datatable/extensions/Buttons/css/buttons.dataTables.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/extensions/Buttons/css/buttons.bootstrap.css" />
    {{--<link rel="stylesheet" href="/asset/datatable/extensions/Select/css/select.dataTables.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/extensions/Select/css/select.bootstrap.css" />
    {{--<link rel="stylesheet" href="/asset/datatable/extensions/Editor/css/editor.dataTables.css" />--}}
    <link rel="stylesheet" href="/asset/datatable/extensions/Editor/css/editor.bootstrap.css" />

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
    <script src="/asset/datatable/js/jquery.dataTables.js"></script>
    <script src="/asset/datatable/js/dataTables.bootstrap.js"></script>
    <script src="/asset/datatable/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="/asset/datatable/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
    <script src="/asset/datatable/extensions/Select/js/dataTables.select.min.js"></script>
    <script src="/asset/datatable/js/pipeline.js"></script>
    <script src="/asset/datatable/js/zh_CN.js"></script>
    <script src="/asset/AdminLTE-2.3.7/dist/js/demo.js"></script>
    <script type="text/javascript">
        var editor; // use a global for the submit and return data rendering in the examples
        var table;

        $(function () {

            function reload() {
                //editor.close();
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
                    { extend: "create", text:"create", action: function () {
                        alert(1);
                    } },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                ],
                initComplete: function(settings) {
                    //alert(1);
//                    var _$this = this;
//                    var searchHTML = '<label><span>搜索:</span> <input type="search" placeholder="请输入搜索内容" aria-controls="datatable1"></label>';
//                    //快捷操作的HTML DOM
//                    $(_$this.selector + '_wrapper .dataTables_filter').append(searchHTML);
//
//                    //重写搜索事件
//                    $(_$this.selector + '_wrapper .dataTables_filter input').bind('keyup',
//                        function(e) {
//                            if (e.keyCode == 13 || (e.keyCode == 8 && (this.value.length == 0))) {
//                                _$this.api().search(this.value).draw();
//                            }
//                        });
                }
            });


        });

    </script>
@endsection