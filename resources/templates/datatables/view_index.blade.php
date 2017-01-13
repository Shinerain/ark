<?php

        function exclude($column){
        	$arr = ['id', 'created_at', 'updated_at'];
        	return in_array($column->name , $arr);
        }

        function showEditorType($column){
            if(empty($column))
                return '';

            switch ($column->name){
                case 'created_at':
                case 'updated_at':
                    return "'type':'datetime'";
            }
        }
?>


<?php echo "@extends('layout.collapsed-sidebar')"; ?>

<?php echo  "@section('styles')" ; ?>

    <link rel="stylesheet" href="/assets/plugins/datatables/css/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="/assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" />
    <link rel="stylesheet" href="/assets/plugins/datatables/extensions/Buttons/css/buttons.bootstrap.css" />
    <link rel="stylesheet" href="/assets/plugins/datatables/extensions/Select/css/select.dataTables.css" />
    <link rel="stylesheet" href="/assets/plugins/datatables/extensions/Select/css/select.bootstrap.css" />
    <link rel="stylesheet" href="/assets/plugins/datatables/extensions/Editor/css/editor.bootstrap.css" />

<?php echo  "@endsection" ; ?>


<?php echo  "@section('content')" ; ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$topModule or 'top module'}}
            <small>{{$table}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{{$topModule or 'top module'}}</a></li>
            <li class="active">{{$table}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$table}}列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                @forelse($columns as $col)
                <th>{{$col->name}}</th>
                @empty
                @endforelse
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

<?php echo "@endsection"  ; ?>

<?php echo "@section('js')"  ; ?>
    <script src="/assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="/assets/plugins/datatables/js/dataTables.bootstrap.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/jszip.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/pdfmake.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Buttons/js/vfs_fonts.js"></script>
    <script src="/assets/plugins/datatables/extensions/Select/js/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Editor/js/dataTables.editor.min.js"></script>
    <script src="/assets/plugins/datatables/extensions/Editor/js/editor.bootstrap.min.js"></script>
    <script src="/assets/plugins/datatables/js/pipeline.js"></script>
    <script src="/assets/plugins/datatables/js/zh_CN.js"></script>

    <script type="text/javascript">
        var editor; // use a global for the submit and return data rendering in the examples
        var table;

        $(function () {
            editor = new $.fn.dataTable.Editor( {
                ajax: {
                    create: {
                        type: 'POST',
                        url:  '/admin/{{snake_case($model,'-')}}',
                        data: { _token: $('meta[name="_token"]').attr('content') },
                    },
                    edit: {
                        type: 'PUT',
                        url:  '/admin/{{snake_case($model,'-')}}/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') },
                    },
                    remove: {
                        type: 'DELETE',
                        url:  '/admin/{{snake_case($model,'-')}}/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') },
                    }
                },
                table: "#moduleTable",
                idSrc:  'id',
                fields: [
            @forelse($columns as $col)
@if(!exclude($col))
    { 'label':  '{{$col->display}}', 'name': '{{$col->name}}',<?=showEditorType($col)?> },
@endif
            @empty
            @endforelse
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
                    url: '/admin/{{snake_case($model,'-')}}/pagination',
                    pages: 5
                }),
                columns: [
            @forelse($columns as $col)
            {  'data': '{{$col->name}}' },
            @empty
            @endforelse
            ],
                buttons: [
                    { extend: "create", text: '新增', editor: editor },
                    { extend: "edit", text: '编辑',  editor: editor },
                    { extend: "remove", text: '删除', editor: editor },
                    { extend: 'excel', text: '导出Excel' },
                    { extend: 'print', text: '打印' },
                ]
            });

        });

    </script>
<?php echo "@endsection"  ; ?>