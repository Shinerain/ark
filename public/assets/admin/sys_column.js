/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    var editorCN = require('i18n');
    exports.index = function ($, tableId, id, dicCategories) {
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
                        {'label': 'binary', 'value': 'binary'},
                        ]
                },
                { 'label':  '长度', 'name': 'length', def: 255},
                { 'label':  '小数', 'name': 'decimal_scale', def: 0},
                { 'label':  '可空', 'name': 'is_nullable', 'type': "radio", 'options': [{'label': 'Yes', 'value': '1'},{'label': 'No', 'value': '0'}], def: 1 },
                { 'label':  '自增', 'name': 'is_autoincrement', 'type': "radio", 'options': [{'label': 'Yes', 'value': '1'},{'label': 'No', 'value': '0'}], def: 0},
                { 'label':  '键', 'name': 'key_type', 'type': 'select', 'options': [{'label': 'primary', 'value': 'primary'},{'label': 'unique', 'value': 'unique'},{'label': 'none', 'value': ''}]},
                { 'label':  '默认值', 'name': 'default_value', },
                { 'label':  '排序', 'name': 'sort', def: 0},
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
                { 'label':  '验证规则', 'name': 'ctrl_valid_rule', },
                { 'label':  '数据源', 'name': 'ctrl_data_source', 'type': 'select', 'options': dicCategories },
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
                {  'data': 'is_nullable', 'render': function (data) {
                    return data == 1 ? '是':'否';
                } },
                {  'data': 'key_type' },
                {  'data': 'sort' },
                {  'data': 'created_at' },
                {  'data': 'updated_at' },
                {  'data': 'display' },
                {  'data': 'length' },
                {  'data': 'decimal_scale' },
                {  'data': 'is_autoincrement' },
                {  'data': 'default_value' },
                {  'data': 'ctrl_type' },
                {  'data': 'ctrl_valid_rule' },
                {  'data': 'ctrl_data_source' },
            ],
            "columnDefs": [
                {
                    "targets": [ 0,10,11,12,13,14,15,16,17 ],
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
                { text: '生成数据表', action: function () { }  },
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