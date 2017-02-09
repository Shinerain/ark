@extends('admin.layout.simple')
@section('styles')
    <link rel="stylesheet" href="/assets/plugins/bootstrap-validator/css/bootstrapValidator.min.css" />
@endsection
@section("content")
    <div style="margin: 5px;">
        <form class="form-horizontal" id="generateForm" method="post" action="#">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{$id}}">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">数据库表</label>
                <div class="col-sm-10">
                    <select class="form-control" id="tableName" name="tableName">
                        <option value="">--select--</option>
                        @forelse($tables as $table)
                            <option value="{{$table->name}}">{{$table->name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">实体名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="modelName" placeholder="实体名" name="modelName">
                </div>
            </div>
            <div class="form-group">
                <label for="icon" class="col-sm-2 control-label">代码模板</label>
                <div class="col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="templates[]" value="base" checked="checked" /> 基础实体
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="templates[]" value="datatables" checked="checked" /> 管理后台(Datatables)
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="templates[]" value="api" /> 标准接口(rest api)
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2  col-sm-10">
                    <button type="submit" class="btn btn-primary">确定生成</button></div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="/assets/plugins/bootstrap-validator/js/bootstrapValidator.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#generateForm')
                .bootstrapValidator({
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        "tableName": {
                            validators: {
                                notEmpty: {
                                    message: '请选择数据库表'
                                }
                            }
                        },
                        "templates[]": {
                            validators: {
                                notEmpty: {
                                    message: '请选择代码模板'
                                }
                            }
                        }
                    }
                 })
                .on('success.form.bv', function (e) {
                    // Prevent form submission
                    e.preventDefault();
                    // Get the form instance
                    var $form = $(e.target);
                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');
                    // Use Ajax to submit form data
                    //layer.msg('submitHandler');
                    $.post($form.attr('action'), $form.serialize(), function (result) {
                        if (result['code'] == 200) {
                            // You can reload the current location
                            layer.msg('代码生成成功！');
                            //parent.location.reload();
                        } else {
                            layer.msg('代码生成失败！');
                        }
                    }, 'json');
                });
        });
    </script>
@endsection