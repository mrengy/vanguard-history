jQuery(document).ready(function($){
  //*** start show / hide year story content button
  var story = $("#story");
  var button_action = $("#show-hide-full-story .button-action");
  var button_action_default_text = button_action.html();

  $("#show-hide-full-story").click(function(){
    //check hidden / visible state of story content
    var hidden = story.attr('hidden');

    // if story is hidden to start
    if(typeof hidden !== 'undefined' && hidden !== false) {
      story.removeAttr('hidden');
      button_action.html("Hide");
    }

    // if story is visible to start
    else{
      console.log('clicked hide');
      story.attr('hidden', 'hidden');
      button_action.html(button_action_default_text);
    }
  });
  //*** end show / hide year story content button

  //*** start show all media button
  var fruit = 'banana';
  $('#show-all-media').click(function(){
    $.ajax({
          type: "GET",
          dataType: "json",
          url: my_ajax_object.ajax_url, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
          data: JSON.stringify({
              'action':'vanguard_history_all_media_for_year_story', // This is our PHP function below
              'fruit' : fruit // This is the variable we are sending via AJAX
          }),
          success: function(data) {
      // This outputs the result of the ajax request (The Callback)
              $('#media-container').append(data);
          },
          error: function(errorThrown) {
              console.log(errorThrown);
          }
      });


    /*
    $.get(my_ajax_obj.ajax_url, {      //POST request
			//_ajax_nonce: my_ajax_obj.nonce, //nonce
			action: 'vanguard_history_all_media_for_year_story',         //action
			fruit: fruit               //data
			}, function(data) {            //callback
				//this2.remove(); //remove current button
				$('#media-container').append(data);       //insert server response
			}
		);
    */
  })
  //*** end show all media button
});
