@extends('admin.layout.simple')
@section('styles')
    <link rel="stylesheet" href="/assets/plugins/bootstrap-validator/css/bootstrapValidator.min.css" />
@endsection
@section("content")
    <div style="margin: 5px;">
        <form class="form-horizontal" id="generateForm" method="post" action="#">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">数据库表</label>
                <div class="col-sm-10">
                    <select class="form-control" id="tablename" name="tablename">
                        <option value="">--select--</option>
                        @forelse($tables as $table)
                            <option value="{{$table->name}}">{{$table->name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2  col-sm-10">
                    <button type="submit" class="btn btn-primary">确定加载</button></div>
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
                        "tablename": {
                            validators: {
                                notEmpty: {
                                    message: '请选择数据库表'
                                }
                            }
                        },
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
                        if (result['error']) {
                            layer.msg('加载失败！' + result['error']);
                            // You can reload the current location
                        } else {
                            layer.msg('加载成功！');
                            parent.location.reload();
                        }
                    }, 'json');
                });
        });
    </script>
@endsection