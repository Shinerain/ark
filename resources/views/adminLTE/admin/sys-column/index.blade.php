@extends('admin.layout.collapsed-sidebar')

@section('styles')
    @include('admin.layout.datatable-css')
    <style type="text/css">
        #customForm {
            display: flex;
            flex-flow: row wrap;
        }

        #customForm fieldset {
            flex: 1;
            border: 1px solid #aaa;
            margin: 0.5em;
        }

        #customForm fieldset legend {
            padding: 3px 20px;
            border: 1px solid #aaa;
            font-weight: bold;
        }

        #customForm fieldset.basic {
            flex: 2 100%;
        }

        #customForm fieldset.basic legend {
            background: #bfffbf;
        }

        #customForm fieldset.type legend {
            background: #ffffbf;
        }

        #customForm fieldset.other legend {
            background: #ffbfbf;
        }

        #customForm div.DTE_Field {
            padding: 3px;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            系统管理
            <small>数据表字段管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">系统管理</a></li>
            <li class="active">数据表字段管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">数据表【{{$table->name}}】字段列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="customFormDiv" style="display: none;">
                        <div id="customForm">
                            <fieldset class="basic">
                                <legend>基本</legend>
                                <editor-field name="sys_table_id"></editor-field>
                                <editor-field name="name"></editor-field>
                                <editor-field name="display"></editor-field>
                                <editor-field name="comment"></editor-field>
                                <editor-field name="is_nullable"></editor-field>
                                <editor-field name="is_autoincrement"></editor-field>
                                <editor-field name="key_type"></editor-field>
                            </fieldset>
                            <fieldset class="type">
                                <legend>类型</legend>
                                <editor-field name="data_type"></editor-field>
                                <editor-field name="length"></editor-field>
                                <editor-field name="decimal_scale"></editor-field>
                                <editor-field name="default_value"></editor-field>
                            </fieldset>
                            <fieldset class="other">
                                <legend>其他</legend>
                                <editor-field name="ctrl_type"></editor-field>
                                <editor-field name="ctrl_data_source"></editor-field>
                                <editor-field name="ctrl_valid_rule"></editor-field>
                                <editor-field name="sort"></editor-field>
                            </fieldset>
                        </div>
                        </div>
                        <table id="columnTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>sys_table_id</th>
                                <th>行号</th>
                                <th>名称</th>
                                <th>描述</th>
                                <th>数据类型</th>
                                <th>是否可空</th>
                                <th>键</th>
                                <th>排序</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                            </tr>
                            </thead>
                            <tbody>
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
    @include('admin.layout.datatable-js')
    <script type="text/javascript">
        $(function () {
            dicCategories = {!! json_encode($categories) !!}
            seajs.use('admin/sys_column.js', function (app) {
                app.index($, 'columnTable', '{{$table->id}}', dicCategories);
            });
        });
    </script>

@endsection