<?php echo "@extends('admin.layout.collapsed-sidebar')"; ?>

<?php echo  "@section('styles')" ; ?>

    <?php echo  "@include('admin.layout.datatable-css')" ; ?>

<?php echo  "@endsection" ; ?>


<?php echo  "@section('content')" ; ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$module->father->name or 'top module'}}
            <small>{{$module->name}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{{$module->father->name or 'top module'}}</a></li>
            <li class="active">{{$module->name}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$table->desc}}列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                @forelse($columns as $col)
                <th>{{$col->display}}</th>
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

    <?php echo "@include('admin.layout.datatable-js')"  ; ?>

    <script type="text/javascript">
        $(function () {
            seajs.use('admin/{{snake_case($model)}}.js', function (app) {
                app.index($, 'moduleTable');
            });
        });
    </script>

<?php echo "@endsection"  ; ?>