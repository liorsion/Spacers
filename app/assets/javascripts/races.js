// Place all the behaviors and hooks related to the matching controller here.
// All this logic will automatically be available in application.js.
$(document).on("click", ".open-addRace", function () {
	
});

$(document).on("click", "#createRace", function () {
	var data = $("#newRaceForm").serialize();
	$.post('/api/races/', 
					data,
					function(data, url, jqXHR) {
						if (data["success"]) {
							alert("Race Created, thank you");
							$('#myModal').modal('hide');
						} else {
							alert(data["message"]);
						}
					}
				).fail(function(jqXHR, textStatus, errorThrown) {
						display_network_error(jqXHR, textStatus, errorThrown);
					})

})