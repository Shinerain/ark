@extends('admin.layout.collapsed-sidebar')

@section('styles')
    @include('admin.layout.datatable-css')
    <link type="text/css" href="/assets/plugins/bootstrap-treeview/bootstrap-treeview.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" />
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
            <div class="col-xs-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">模块树</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" id="btnAddChild"><i class="fa fa-file"></i>新增子模块</a></li>
                                    <li><a href="#" id="btnAddSame"><i class="fa fa-file"></i>新增同级模块</a></li>
                                    {{--<li><a href="#" id="btnEdit"><i class="fa fa-pencil"></i>编辑</a></li>--}}
                                    <li><a href="#" id="btnRemove"><i class="fa fa-remove"></i>删除</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" id="btnOpen"><i class="fa fa-folder-open"></i>展开</a></li>
                                    <li><a href="#" id="btnCollapse"><i class="fa fa-folder"></i>折叠</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" >
                        <div id="moduleTree"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-xs-8">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">模块详情</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal" id="detailForm" method="post" action="{{route('sys-module.store')}}">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name" placeholder="名称" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">图标</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" id="icon" name="icon">
                                        <option value="">--select--</option>
                                        @forelse($icons as $icon)
                                            <option value="{{$icon->value}}" data-content="<span class='{{$icon->value}}'></span>"></option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_page" class="col-sm-2 control-label">是否功能页</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" id="is_page" name="is_page">
                                        <option value="">--select--</option>
                                        <option value="1">是</option>
                                        <option value="0">否</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-2 control-label">链接</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="url" placeholder="链接" name="url" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="sort" placeholder="排序" name="sort" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="desc" placeholder="描述" name="desc">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">模块源代码列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="moduleTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>名称</th>
                                <th>描述</th>
                                <th>路径</th>
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
    <script type="text/javascript" src="/assets/plugins/bootstrap-treeview/bootstrap-treeview.min.js"></script>
    <script src="/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/assets/plugins/bootstrap-select/i18n/defaults-zh_CN.min.js"></script>
    <script type="text/javascript">
        $('.selectpicker').selectpicker();

    </script>
    <script type="text/javascript">
        $(function () {
            var treeData = {!! json_encode($modules) !!};
            seajs.use('admin/sys_module', function (app) {
                app.index($, 'moduleTree', treeData);
            })
        })
    </script>
@endsection