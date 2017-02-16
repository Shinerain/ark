/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    var editorCN = require('i18n');
    exports.index = function ($, tableId) {
        var editor = new $.fn.dataTable.Editor({
            ajax: {
                create: {
                    type: 'POST',
                    url: '/admin/sys-table',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                edit: {
                    type: 'PUT',
                    url: '/admin/sys-table/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                remove: {
                    type: 'DELETE',
                    url: '/admin/sys-table/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                }
            },
            i18n: editorCN,
            table: "#" + tableId,
            idSrc: 'id',
            fields: [
                { 'label':  '名称', 'name': 'name', },
                { 'label':  '实体名称', 'name': 'model_name', },
                { 'label':  '描述', 'name': 'desc', },
                { 'label':  '引擎', 'name': 'engine', 'type':'select', 'options':[{'label':'InnoDB', 'value':'InnoDB'},{'label':'MyISAM', 'value':'MyISAM'}]},
            ]
        });

        var table = $("#" + tableId).DataTable({
            dom: "Bfrtip",
            language: zhCN,
            processing: true,
            serverSide: true,
            select: true,
            paging: true,
            rowId: "id",
            ajax: '/admin/sys-table/pagination',
            columns: [
                {  'data': 'status' },
                {  'data': 'id' },
                {  'data': 'name' },
                {  'data': 'model_name' },
                {  'data': 'desc' },
                {  'data': 'engine' },
                {  'data': 'created_at' },
                {  'data': 'updated_at' },
                {  'data': 'id', 'render': function (data, type, row) {
                    var html =  '<a class="btn btn-default" href="/admin/sys-table/'+data+'/columns">设定字段</a>&nbsp;&nbsp;&nbsp;';
                    if(row['status'] == 0){
                        html += '<button class="btn btn-primary buildtable" data-table-id="'+data+'" >生成数据表</button>';
                    }else{
                        html += '<button class="btn btn-primary rebuildtable" data-table-id="'+data+'" >重新生成数据表</button>';
                    }
                    return html;
                } },
            ],
            columnDefs:[{
                targets:[0],
                visible: false,
                searchable: false
            }],
            buttons: [
                // { text: '新增', action: function () { }  },
                // { text: '编辑', className: 'edit', enabled: false },
                // { text: '删除', className: 'delete', enabled: false },
                {extend: "create", text: '新增<i class="fa fa-fw fa-plus"></i>', editor: editor},
                {extend: "edit", text: '编辑<i class="fa fa-fw fa-pencil"></i>', editor: editor},
                {extend: "remove", text: '删除<i class="fa fa-fw fa-trash"></i>', editor: editor},
                {extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                {extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                //{extend: 'colvis', text: '列显示'}
            ]
        });

        // table.on( 'select', checkBtn).on( 'deselect', checkBtn);
        //
        // function checkBtn(e, dt, type, indexes) {
        //     var count = table.rows( { selected: true } ).count();
        //     table.buttons( ['.edit', '.delete'] ).enable(count > 0);
        // }
        table.on('draw', function () {
            //alert( 'Table redrawn' );
            bindEvt();
        });
        bindEvt();


        function bindEvt(id) {
            $('.buildtable').on("click", function () {
                var id = $(this).attr('data-table-id');
                var url = '/admin/sys-table/' + id + '/build';
                layer.confirm('确定生成?', {
                    buttons: ['确定', '取消']
                }, function () {
                    $.post(url, {_token: $('meta[name="_token"]').attr('content')}, function (res) {
                        if (res) {
                            layer.msg('生成成功!');
                        }
                    });
                });
            });

            $('.rebuildtable').on("click", function () {
                var id = $(this).attr('data-table-id');
                var url = '/admin/sys-table/' + id + '/rebuild';
                layer.confirm('确定重新生成?', {
                    buttons: ['确定', '取消']
                }, function () {
                    $.post(url, {_token: $('meta[name="_token"]').attr('content')}, function (res) {
                        if (res) {
                            layer.msg('重新生成成功!');
                        }
                    });
                });
            });
        }

    }

});