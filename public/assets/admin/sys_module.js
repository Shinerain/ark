/**
 * Created by john on 2017-01-16.
 */
define(function(require, exports, module) {

    exports.index = function ($, treeId, treeData) {
        var tree = $('#' + treeId).treeview({
            data: treeData,
            onNodeSelected: function(event, data) {
                // Your logic goes here
                bindForm(data.item);
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
            layer.open({
                title: '生成模块代码',
                area: ['600px', '400px'],
                type: 2,
                closeBtn:1,
                maxmin:1,
                content: '/admin/sys-module/gen-code'
            })
        })

    }

    

})