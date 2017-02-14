/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    var editorCN = require('i18n');
    exports.index = function ($, tableId, id) {
        var editor = new $.fn.dataTable.Editor({
            ajax: {
                create: {
                    type: 'POST',
                    url: '/admin/sys-column',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                edit: {
                    type: 'PUT',
                    url: '/admin/sys-column/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                },
                remove: {
                    type: 'DELETE',
                    url: '/admin/sys-column/_id_',
                    data: {_token: $('meta[name="_token"]').attr('content')},
                }
            },
            i18n: editorCN,
            table: "#" + tableId,
            template: '#customForm',
            idSrc: 'id',
            fields: [
                { 'label':  'sys_table_id', 'name': 'sys_table_id', def: id, 'type': 'hidden'},
                { 'label':  '名称', 'name': 'name', },
                { 'label':  '显示名称', 'name': 'display', },
                { 'label':  '注释', 'name': 'comment', },
                { 'label':  '字段类型',
                    'name': 'data_type',
                    'type': 'select',
                    'options': [
                        {'label': 'string', 'value': 'string'},
                        {'label': 'text', 'value': 'text'},
                        {'label': 'char', 'value': 'char'},
                        {'label': 'timestamp', 'value': 'timestamp'},
                        {'label': 'decimal', 'value': 'decimal'},
                        {'label': 'integer', 'value': 'integer'},
                        ]
                },
                { 'label':  '长度', 'name': 'length', },
                { 'label':  '小数', 'name': 'decimal_scale', },
                { 'label':  '可空', 'name': 'is_nullable', 'type': "radio", 'options': [{'label': 'Yes', 'value': '1'},{'label': 'No', 'value': '0'}], def: 1 },
                { 'label':  '自增', 'name': 'is_autoincrement', 'type': "radio", 'options': [{'label': 'Yes', 'value': '1'},{'label': 'No', 'value': '0'}], def: 0},
                { 'label':  '键', 'name': 'key_type', 'type': 'select', 'options': [{'label': 'primary', 'value': 'primary'},{'label': 'unique', 'value': 'unique'},{'label': 'none', 'value': ''}]},
                { 'label':  '默认值', 'name': 'default_value', },
                { 'label':  '排序', 'name': 'sort', },
                {   'label':  '控件类型',
                    'name': 'ctrl_type',
                    'type': 'select',
                    'options': [
                        {'label': 'text', 'value': 'text'},
                        {'label': 'date', 'value': 'date'},
                        {'label': 'datetime', 'value': 'datetime'},
                        {'label': 'hidden', 'value': 'hidden'},
                        {'label': 'password', 'value': 'password'},
                        {'label': 'radio', 'value': 'radio'},
                        {'label': 'readonly', 'value': 'readonly'},
                        {'label': 'select', 'value': 'select'},
                        {'label': 'textarea', 'value': 'textarea'},
                        {'label': 'upload', 'value': 'upload'},
                        {'label': 'uploadMany', 'value': 'uploadMany'},
                        ]
                },
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
            ajax: '/admin/sys-table/'+id+'/columns/pagination',
            columns: [
                {  'data': 'sys_table_id' },
                {  'data': 'id' },
                {  'data': 'name' },
                {  'data': 'comment' },
                {  'data': 'data_type' },
                {  'data': 'is_nullable' },
                {  'data': 'created_at' },
                {  'data': 'updated_at' },
            ],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                },
            ],
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

    }

});