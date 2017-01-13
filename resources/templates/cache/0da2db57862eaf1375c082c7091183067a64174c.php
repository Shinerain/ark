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

    <link rel="stylesheet" href="/asset/datatable/css/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="/asset/datatable/extensions/Buttons/css/buttons.bootstrap.css" />
    <link rel="stylesheet" href="/asset/datatable/extensions/Select/css/select.bootstrap.css" />
    <link rel="stylesheet" href="/asset/datatable/extensions/Editor/css/editor.bootstrap.css" />
<?php echo  "@endsection" ; ?>

<?php echo  "@section('content')" ; ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo e(isset($topModule) ? $topModule : 'top module'); ?>

            <small><?php echo e($table); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><?php echo e(isset($topModule) ? $topModule : 'top module'); ?></a></li>
            <li class="active"><?php echo e($table); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e($table); ?>列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                <?php $__empty_1 = true; $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
                <th><?php echo e($col->name); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
                <?php endif; ?>
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
                    create: {
                        type: 'POST',
                        url:  '/admin/<?php echo e(snake_case($model,'-')); ?>',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    },
                    edit: {
                        type: 'PUT',
                        url:  '/admin/<?php echo e(snake_case($model,'-')); ?>/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    },
                    remove: {
                        type: 'DELETE',
                        url:  '/admin/<?php echo e(snake_case($model,'-')); ?>/_id_',
                        data: { _token: $('meta[name="_token"]').attr('content') }
                    }
                },
                table: "#moduleTable",
                idSrc:  'id',
                fields: [
            <?php $__empty_1 = true; $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
<?php if(!exclude($col)): ?>
    { 'label':  '<?php echo e($col->display); ?>', 'name': '<?php echo e($col->name); ?>',<?=showEditorType($col)?> },
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
            <?php endif; ?>
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
                    url: '/admin/<?php echo e(snake_case($model,'-')); ?>/pagination',
                    pages: 5
                }),
                columns: [
            <?php $__empty_1 = true; $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
            {  'data': '<?php echo e($col->name); ?>' },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
            <?php endif; ?>
            ],
                buttons: [
                    { extend: "create", text: '新增', editor: editor },
                    { extend: "edit", text: '编辑',  editor: editor },
                    { extend: "remove", text: '删除', editor: editor }
                ]
            });

        });

    </script>
<?php echo "@endsection"  ; ?>