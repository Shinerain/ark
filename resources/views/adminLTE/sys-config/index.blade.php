@extends('layout.collapsed-sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            系统管理
            <small>配置管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">配置管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">配置管理</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>配置项</th>
                                <th>说明</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>清理缓存</td>
                                    <td>清理系统缓存【cache:clear】</td>
                                    <td>开启</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info"><i class="fa fa-refresh"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>系统crontab</td>
                                    <td>crontab 任务(* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1)</td>
                                    <td>开启</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info"><i class="fa fa-refresh"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>系统crontab</td>
                                    <td>crontab 任务</td>
                                    <td>开启</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info"><i class="fa fa-refresh"></i></button>
                                        </div>
                                    </td>
                                </tr>
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