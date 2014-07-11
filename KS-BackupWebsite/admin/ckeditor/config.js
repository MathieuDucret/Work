/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.contentsCss = '/css/ckeditor_css.php';
	config.toolbar = 'Full';
	config.entities = false;
	config.toolbar_Full =
	[
		['Source','-','Save','NewPage','Preview','-','Templates'],
		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		'/',
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor'],
		['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
		'/',
		['Styles','Format'],
		['Maximize', 'ShowBlocks','-']
	];
	
	config.toolbar_Basic =
	[
		['Bold', 'Italic','Underline', '-', 'NumberedList', 'BulletedList', '-'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		['HorizontalRule','SpecialChar','PageBreak'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	];
	config.enterMode = CKEDITOR.ENTER_BR; 
	config.contentsCss = '/css/ckeditor_css.php';

};

