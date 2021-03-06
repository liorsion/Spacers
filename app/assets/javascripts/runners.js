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
						knowledge: $('#knowledge').val(),
						race_id: race_id
					}, 
					function(data, message, success) {
						if (data["success"]) {
							alert("Message sent, thank you!");
							$('#myModal').modal('hide');
						} else {
							alert(data["message"]);
						}
					}
					).fail(function(jqXHR, textStatus, errorThrown) {
						display_network_error(jqXHR, textStatus, errorThrown);
						$('#myModal').modal('hide');
					})

});

$(document).on("click", "#joinRace", function() {
	$.post('/api/races/' + race_id + '/participations', 
		{
			runner_type: $('#runner_type').val(),
			knowledge: $('#join_knowledge').val(),
			speed: $('#join_speed').val()
		}, 
		function(data, message, success) {
			if (data["success"]) {
				alert("Race joined, thank you!");
				$('#myModal').modal('hide');
			} else {
				alert(data["message"]);
			}
		}
		).fail(function(jqXHR, textStatus, errorThrown) {
			display_network_error(jqXHR, textStatus, errorThrown);
			$('#joinRaceModal').modal('hide');
			
		})

})
