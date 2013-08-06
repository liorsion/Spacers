// Place all the behaviors and hooks related to the matching controller here.
// All this logic will automatically be available in application.js.

$(document).on("click", ".open-SendMessage", function () {
	var runnerId = $(this).data('id');
  var runner = $(this).data('runner');
  $("#runner_id").val( runnerId );
  if (runner) { 
  	$("#pacer_or_runner").text("pacer");
  } else {
  	$("#pacer_or_runner").text("runner");
  }
});

$(document).on("click", "#sendMessage", function() {
	$.post('/api/message/', 
					{
						receiver_id: $('#runner_id').val(), 
						message: $('#message').val(), 
						speed: $('#speed').val(),
						knowledge: $('#knowledge').val()
					}, 
					function(url, data, success) {
						alert('success');
					}
					).fail(function(jqXHR, textStatus, errorThrown) {
						display_network_error(jqXHR);
					})

});

$(document).on("click", "#joinRace", function() {
	$.post('/api/races/' + race_id + '/participations', 
		{
			runner_type: $('#runner_type').val(),
			knowledge: $('#knowledge').val(),
			speed: $('#speed').val()
		}, 
		function(data, url, success) {
			if (data["success"]) {
			} else {
				alert(data["message"]);
			}
		}
		).fail(function(jqXHR, textStatus, errorThrown) {
			display_network_error(jqXHR);
		})

})
