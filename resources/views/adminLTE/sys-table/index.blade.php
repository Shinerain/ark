@extends('layout.collapsed-sidebar')

@section('styles')
    <link rel="stylesheet" href="/asset/AdminLTE-2.3.7/plugins/datatables/dataTables.bootstrap.css" />
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            系统管理
            <small>数据库表管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">数据库表管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">数据库表列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="margin">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i> 新增</button>
                            </div>
                        </div>

                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>行号</th>
                                <th>名称</th>
                                <th>描述</th>
                                <th>图标</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1; ?>
                            @forelse($tables as $m)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->desc}}</td>
                                    <td><span class="{{$m->icon}}"></span></td>
                                    <td>{{$m->created_at}}</td>
                                    <td>{{$m->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn bg-purple"><i class="fa fa-navicon"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-close"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                            @endforelse
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
    <script src="/asset/AdminLTE-2.3.7/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/asset/AdminLTE-2.3.7/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/asset/AdminLTE-2.3.7/dist/js/demo.js"></script>
    <script type="text/javascript">
        $("#table").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>
@endsection