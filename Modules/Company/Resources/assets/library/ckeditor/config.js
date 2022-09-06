/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    config.format_tags = 'div;p;h2;h3;h4;h5;h6;pre;address';
    config.filebrowserBrowseUrl = location.origin + '/admin_static/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = location.origin + '/admin_static/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = location.origin + '/admin_static/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadMethod = 'form';
    config.filebrowserUploadUrl = location.origin + '/admin/news/post/ajax/update-image';
    // config.filebrowserUploadUrl = location.origin +'/admin_static/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    // config.filebrowserImageUploadUrl = location.origin +'/admin_static/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    // config.filebrowserFlashUploadUrl = location.origin +'/admin_static/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    config.extraPlugins = 'lineheight,texttransform,contents,forms';
    config.fontSize_defaultLabel = '14';
};
