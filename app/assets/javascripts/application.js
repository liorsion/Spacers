// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// or vendor/assets/javascripts of plugins, if any, can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file.
//
// Read Sprockets README (https://github.com/sstephenson/sprockets#sprockets-directives) for details
// about supported directives.
//
//= require jquery
//= require turbolinks
//= require jquery.turbolinks
//= require jquery_ujs
//= require bootstrap
//= require_tree .



function display_network_error(jqXHR, textStatus, errorThrown) {
	if (jqXHR.status == 422) {
		error_string = "";
		for (errorIdx in jqXHR.responseJSON.errors) {
			for (errorField in jqXHR.responseJSON.errors[errorIdx]) {
				error_string += errorField + ": " + jqXHR.responseJSON.errors[errorIdx][errorField][0];	
			}
			
		}
		alert(error_string);
	} else {
		alert(textStatus + ": " + errorThrown);
	}
}

$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});

