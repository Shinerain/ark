/**
 * Created by john on 2017-01-16.
 */
define(function(require, exports, module) {
    var zhCN = require('datatableZh');

    exports.index = function ($, treeId, treeData, tableId) {
        var curNodeData;
        var tree = $('#' + treeId).treeview({
            data: treeData,
            onNodeSelected: function(event, data) {
                // Your logic goes here
                bindForm(data.item);
                curNodeData = data;
                console.log(curNodeData);
                table.column(1).search(data['data-id']).draw();
            }
        });

        function bindForm(item) {
            for(var k in item){
                //alert(item[k]);
                $('#' + k).val(item[k]);
            }
            $('#icon').selectpicker('val', item['icon']);
            $('#is_page').selectpicker('val', item['is_page']);
        }

        //tree btn
        $('#btnAddChild').click(function () {
            $('#detailForm')[0].reset();
        });

        $('#btnAddSame').click(function () {
            $('#detailForm')[0].reset();
        });


        $('#btnRemove').click(function () {
            layer.confirm('确定删除?',{
                title: '提示',
                buttons:['确定', '取消']
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
                closeBtn:1,
                maxmin:1,
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
                {  'data': 'id' },
                {  'data': 'sys_module_id' },
                {  'data': 'name' },
                {  'data': 'desc' },
                {  'data': 'path' },
                {  'data': 'created_at' },
                {  'data': 'updated_at' },
            ],
            columnDefs: [
                { targets: 1, visible: false }
            ],
            buttons: [
                // { text: '新增', action: function () { }  },
                // { text: '编辑', className: 'edit', enabled: false },
                // { text: '删除', className: 'delete', enabled: false },
                // {extend: "create", text: '新增<i class="fa fa-fw fa-plus"></i>', editor: editor},
                // {extend: "edit", text: '编辑<i class="fa fa-fw fa-pencil"></i>', editor: editor},
                // {extend: "remove", text: '删除<i class="fa fa-fw fa-trash"></i>', editor: editor},
                {extend: 'excel', text: '导出Excel<i class="fa fa-fw fa-file-excel-o"></i>'},
                {extend: 'print', text: '打印<i class="fa fa-fw fa-print"></i>'},
                //{extend: 'colvis', text: '列显示'}
            ]
        });


    }

    

})