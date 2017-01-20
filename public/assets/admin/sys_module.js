/**
 * Created by john on 2017-01-16.
 */
define(function(require, exports, module) {

    exports.index = function ($, treeId, treeData) {
        $('#' + treeId).treeview({
            data: treeData
        });

    }


})