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
  const media_container = $('#media-container');
  const year = media_container.data('year');
  const ensemble = media_container.data('ensemble');
  $('#show-all-media').click(function(e){
    $.ajax({
          url: my_ajax_object.ajax_url, // passed in functions.php > wp_localize_script
          data: {
              'action':'vanguard_history_all_media_for_year_story', // This is our PHP function below
              'year' : year,
              'ensemble' : ensemble
          },
          success: function(data) {
            // This outputs the result of the ajax request (The Callback)
            media_container.append(data);
            $(e.target).remove();
          },
          error: function(errorThrown) {
              console.log(errorThrown);
          }
      });

  })
  //*** end show all media button
});
