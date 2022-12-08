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
  $("#show-all-media").click(function(){
    var this2 = this;
    $.get(my_ajax_obj.ajax_url, {      //POST request
			//_ajax_nonce: my_ajax_obj.nonce, //nonce
			action: "vanguard_history_all_media_for_year_story",         //action
			title: this.value               //data
			}, function(data) {            //callback
				this2.remove(); //remove current button
				$("#media-container").append(data);       //insert server response
			}
		);
  })
  //*** end show all media button
});
