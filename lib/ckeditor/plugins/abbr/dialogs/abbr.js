/**
 * Copyright (c) 2014-2016, CKSource - Frederico Knabben. All rights reserved.
 * Licensed under the terms of the MIT License (see LICENSE.md).
 *
 * The abbr plugin dialog window definition.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Our dialog definition.
CKEDITOR.dialog.add( 'abbrDialog', function( editor ) {
	return {

		// Basic properties of the dialog window: title, minimum size.
		title: 'Abbreviation Window',
		minWidth: 400,
		minHeight: 200,

		// Dialog window content definition.
		contents: [
			{
				// Definition of the Basic Settings dialog tab (page).
				id: 'tab-basic',
				label: 'Basic Settings',

				// The tab content.
				elements: [
					{
						// Text input field for the abbreviation text.
						type: 'text',
						id: 'projector',
						label: 'Projector',

						// Validation checking whether the field is not empty.
						validate: CKEDITOR.dialog.validate.notEmpty( "Projector field cannot be empty." ),

						// Called by the main setupContent method call on dialog initialization.
						setup: function( element ) {
							this.setValue( element.getAttribute( "projector" ) );
						},

						// Called by the main commitContent method call on dialog confirmation.
						commit: function( element ) {
							element.setAttribute( "projector", this.getValue() );
						}
					},
					{
						// Text input field for the abbreviation text.
						type: 'select',
						items: [ [ 'Basketball' ], [ 'Baseball' ], [ 'Hockey' ], [ 'Football' ] ],
						id: 'nodeA',
						label: 'Node A',

						// Validation checking whether the field is not empty.
						validate: CKEDITOR.dialog.validate.notEmpty( "Node A field cannot be empty." ),

						// Called by the main setupContent method call on dialog initialization.
						setup: function( element ) {
							this.setValue( element.getAttribute( "nodeA" ) );
						},

						// Called by the main commitContent method call on dialog confirmation.
						commit: function( element ) {
							element.setAttribute( "nodeA", this.getValue() );
						}
					},
					{
						// Text input field for the abbreviation text.
						type: 'text',
						id: 'nodeB',
						label: 'Node B',

						// Validation checking whether the field is not empty.
						validate: CKEDITOR.dialog.validate.notEmpty( "Node B field cannot be empty." ),

						// Called by the main setupContent method call on dialog initialization.
						setup: function( element ) {
							this.setValue( element.getAttribute( "nodeB" ) );
						},

						// Called by the main commitContent method call on dialog confirmation.
						commit: function( element ) {
							element.setAttribute( "nodeB", this.getValue() );
						}
					},
					{
						// Text input field for the abbreviation text.
						type: 'text',
						id: 'emotion',
						label: 'positve/negative',

						// Validation checking whether the field is not empty.
						validate: CKEDITOR.dialog.validate.notEmpty( "positve/negative field cannot be empty." ),

						// Called by the main setupContent method call on dialog initialization.
						setup: function( element ) {
							this.setValue( element.getAttribute( "emotion" ) );
						},

						// Called by the main commitContent method call on dialog confirmation.
						commit: function( element ) {
							element.setAttribute( "emotion", this.getValue() );
						}
					}
				]
			}
		],

		// Invoked when the dialog is loaded.
		onShow: function() {

			// Get the selection from the editor.
			var selection = editor.getSelection();
			console.log('selection is:');
			console.log(editor.getSelectedHtml());

			// Get the element at the start of the selection.
			var element = selection.getStartElement();

			// Get the <abbr> element closest to the selection, if it exists.
			if ( element )
				element = element.getAscendant( 'abbr', true );

			// Create a new <abbr> element if it does not exist.
			if ( !element || element.getName() != 'abbr' ) {
				element = editor.document.createElement( 'abbr' );

				// Flag the insertion mode for later use.
				this.insertMode = true;
			}
			else
				this.insertMode = false;

			// Store the reference to the <abbr> element in an internal property, for later use.
			this.element = element;

			// Invoke the setup methods of all dialog window elements, so they can load the element attributes.
			if ( !this.insertMode )
				this.setupContent( this.element );
		},

		// This method is invoked once a user clicks the OK button, confirming the dialog.
		onOk: function() {

			// The context of this function is the dialog object itself.
			// http://docs.ckeditor.com/#!/api/CKEDITOR.dialog
			var dialog = this;

			// Create a new <abbr> element.
			var abbr = this.element;

			// Invoke the commit methods of all dialog window elements, so the <abbr> element gets modified.
			this.commitContent( abbr );

			// Finally, if in insert mode, insert the element into the editor at the caret position.
			if ( this.insertMode ) {

var fragment = editor.getSelection().getRanges()[0].extractContents()
// var container = CKEDITOR.dom.element.createFromHtml("<abbr/>", editor.document)
fragment.appendTo(abbr)
editor.insertElement(abbr)


				// editor.applyStyle( new CKEDITOR.style({
				// 	Element : 'abbr',
				// 	Attributes : { 
				// 		class : 'Myclass' 
				// 	}, Styles : {
				// 	 color : '#ff0000',
				// 	 'font-family' : 'Courier' 
				// 	}} 
				// 	));
			//	editor.insertElement( abbr );
			}
		}
	};
});
