function gup( name ) {
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( window.location.href );
	if( results == null )
		return "";
	else
		return results[1];
}

// http://stepansuvorov.com/blog/2014/04/jquery-put-and-delete/
jQuery.each( [ "put", "delete" ], function( i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {
		if ( jQuery.isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		return jQuery.ajax({
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		});
	};
});

function alertInjector(type, heading, contentHtml) {
	var toEnterAlertBox = $('<div class="alert pe-content-left-alert" style="">');
	toEnterAlertBox.addClass('alert-' + type);
	var h4Content = heading;
	if(type == 'success') {
		h4Content = '<i class="icon fa fa-check"></i>' + heading;
	}
	toEnterAlertBox.append('<h4>' + h4Content + '</h4>')
	toEnterAlertBox.append(contentHtml);

	//Auto fade out the alert
	toEnterAlertBox.fadeTo(2000, 500, function(){
    	toEnterAlertBox.fadeTo(2000, 0, function(){
    		toEnterAlertBox.remove();
    	});
	});

	$('body').append(toEnterAlertBox);
}

function throwErrorOnField(fieldID, messageContent) {
	var formGroup = $('#' + fieldID).closest('.form-group');
	formGroup.addClass('has-error');
	formGroup.append('<span class="help-block help-block-pe">' + messageContent + '</span>');
}

