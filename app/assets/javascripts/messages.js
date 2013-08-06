// Place all the behaviors and hooks related to the matching controller here.
// All this logic will automatically be available in application.js.
$(document).on("click", ".open-ReadMessage", function () {
	var race_id = $(this).data('race')
	var runnerName = $(this).data('name');
  var knowledge_index = $(this).data('knowledge');
  var speed_index = $(this).data('speed');
  var message = $(this).text();
  $('#message_id').val($(this).data('message-id'));
	$.get("/api/races/"+race_id+"/levels", 
		function(data, success) {
		  $("#sender_name").text( runnerName );
		  $("#sender_message").text( message );
		  $("#sender_speed").text( data["speed_levels"][speed_index] );
		  $("#sender_knowledge").text( data["knowledge_levels"][knowledge_index] );
		})
});


$(document).on("click", "#approveMessage", function() {
	message_id = $("#message_id").val();
	$.post('/api/messages/' + message_id + "/approve", 
					{
						
					}, 
					function(data, url, jqXHR) {
						if (data["success"]) {
						} else {
							alert(data["message"]);
						}
					}
					).fail(function(jqXHR, textStatus, errorThrown) {
						display_network_error(jqXHR);
					})

})

$(document).on("click", "#rejectMessage", function() {
	message_id = $("#message_id").val();
	$.post('/api/messages/' + message_id + "/reject", 
					{
						
					}, 
					function(data, url, jqXHR) {
						if (data["success"]) {
						} else {
							alert(data["message"]);
						}
					}
					).fail(function(jqXHR, textStatus, errorThrown) {
						display_network_error(jqXHR);
					})

})