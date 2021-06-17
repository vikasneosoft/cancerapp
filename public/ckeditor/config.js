/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */


CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:  
    // config.language = 'fr';  
    // config.uiColor = '#AADC6E';  
    // config.filebrowserBrowseUrl = '/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files';
    // config.filebrowserImageBrowseUrl = '/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images';
    // config.filebrowserFlashBrowseUrl = '/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash';
    // config.filebrowserUploadUrl = '/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files';
    // config.filebrowserImageUploadUrl = '/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images';
    // config.filebrowserFlashUploadUrl = '/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash';

    config.filebrowserUploadMethod = 'form',
    config.filebrowserBrowseUrl = '/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '/public/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';

    config.filebrowserUploadUrl = '/public/ckeditor/kcfinder/upload.php?opener=TESTckeditor&type=files';
    config.filebrowserImageUploadUrl = '/public/ckeditor/kcfinder/upload.php?opener=REstckeditor&type=images';


};
