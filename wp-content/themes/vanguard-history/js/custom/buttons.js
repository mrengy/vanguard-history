jQuery(document).ready(function($){

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

});
