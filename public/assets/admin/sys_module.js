/**
 * Created by john on 2017-01-16.
 */
define(function(require, exports, module) {
    var zhCN = require('datatableZh');

    exports.index = function ($, treeId, treeData, tableId) {
        var curNodeData;
        var tree = $('#' + treeId).treeview({
            data: treeData,
            onNodeSelected: function (event, data) {
                // Your logic goes here
                bindForm(data.item);
                curNodeData = data;
                console.log(curNodeData);
                table.column(1).search(data['data-id']).draw();
            }
        });

        function bindForm(item) {
            for (var k in item) {
                //alert(item[k]);
                $('#' + k).val(item[k]);
            }
            $('#icon').selectpicker('val', item['icon']);
            $('#is_page').selectpicker('val', item['is_page']);
        }

        //tree btn
        $('#btnAddChild').click(function () {
            if (!curNodeData) {
                layer.alert('请先选择节点!');
                return;
            }
            $('#detailForm')[0].reset();
            $('#id').val(0);
            $('#pid').val(curNodeData['data-id']);
        });

        $('#btnAddSame').click(function () {
            if (!curNodeData) {
                layer.alert('请先选择节点!');
                return;
            }
            $('#detailForm')[0].reset();
            $('#id').val(0);
            $('#pid').val(curNodeData['item']['pid']);
        });


        $('#btnRemove').click(function () {
            if (!curNodeData) {
                layer.alert('请先选择节点!');
                return;
            }
            layer.confirm('确定删除?', {
                title: '提示',
                buttons: ['确定', '取消'],
            }, function () {
                $.post('/admin/sys-module/' + curNodeData['data-id'], {
                    _method: 'delete',
                    _token: $('meta[name="_token"]').attr('content')
                }, function (res) {
                    layer.msg('成功!');
                    window.location.reload(true);
                })
            }, function () {
                layer.close();
            });
        });

        $('#btnOpen').click(function () {
            $('#' + treeId).treeview('expandAll');
        });

        $('#btnCollapse').click(function () {
            $('#' + treeId).treeview('collapseAll');
        });

        $('#btnGenerateCode').click(function () {
            //$node = $('#tree').treeview('getSelected');
            var url = '/admin/sys-module/gen-code?id=' + curNodeData['data-id'];
            layer.open({
                title: '生成模块代码',
                area: ['600px', '400px'],
                type: 2,
                closeBtn: 1,
                maxmin: 1,
                content: url
            })
        })

        var table = $("#" + tableId).DataTable({
            dom: "Bfrtip",
            language: zhCN,
            processing: true,
            serverSide: true,
            select: true,
            paging: true,
            rowId: "id",
            ajax: '/admin/sys-module-file/pagination',
            columns: [
                {'data': 'id'},
                {'data': 'sys_module_id'},
                {'data': 'name'},
                {'data': 'desc'},
                {'data': 'path'},
                {'data': 'created_at'},
                {'data': 'updated_at'},
            ],
            columnDefs: [
                {targets: 1, visible: false}
            ],
            buttons: [
                { text: '编辑', className: 'edit', enabled: false, action: function (e, dt, node, config) {

                } },
                { text: '删除', className: 'delete', enabled: false, action: function (e, dt, node, config) {
                    var item = table.rows( { selected: true } ).data();
                    console.log(item);
                    if(item){
                        var url = '/admin/sys-module-file/' + item[0]['id'];
                        $.post(url, {
                            _method: 'delete',
                            _token: $('meta[name="_token"]').attr('content')
                        }, function (res) {
                            console.log(res);
                            layer.msg('删除成功!');
                            dt.ajax.reload();
                        })
                    }
                } },
            ]
        });

        table.on( 'select', checkBtn).on( 'deselect', checkBtn);

        function checkBtn(e, dt, type, indexes) {
            var count = table.rows( { selected: true } ).count();
            table.buttons( ['.edit', '.delete'] ).enable(count > 0);
        }

        //form
        $('#detailForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {},
                    }
                },
                icon: {
                    validators: {
                        notEmpty: {},
                    }
                },
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function (result) {
                if(result)
                {
                    layer.msg('保存成功!');
                    window.location.reload(true);
                }
            }, 'json');
        });

    }
    

});