jQuery(document).ready(function ($) {
	//*** start show / hide year story content button
	var story = $("#story");
	var story_button_action = $("#show-hide-full-story .button-action");
	var button_action_default_text = story_button_action.html();

	$("#show-hide-full-story").click(function () {
		//check hidden / visible state of story content
		var hidden = story.attr("hidden");

		// if story is hidden to start
		if (typeof hidden !== "undefined" && hidden !== false) {
			story.removeAttr("hidden");
			story_button_action.html("Hide");
		}

		// if story is visible to start
		else {
			story.attr("hidden", "hidden");
			story_button_action.html(button_action_default_text);
		}
	});
	//*** end show / hide year story content button

	//*** start show all media button
	const media_container = $("#media-container");
	const year = media_container.data("year");
	const ensemble = media_container.data("ensemble");
	const show_all_media_button = $("#show-all-media");
	const media_button_action = $("#show-all-media .button-action");
	const media_button_action_default_text = media_button_action.html();
	const media_button_action_alternate_text = "Less";
	$("#show-all-media").click(function (e) {
		const isExpanded = media_container.hasClass("expanded");
		const hasFetched = media_container.hasClass("fetched");

		if (!hasFetched) {
			// Media has not been expanded, request the rest of the media
			$(this).hide();
			show_all_media_button.addClass("loading");
			$.ajax({
				url: my_ajax_object.ajax_url, // passed in functions.php > wp_localize_script
				data: {
					action: "vanguard_history_all_media_for_year_story", // This is our PHP function below
					year: year,
					ensemble: ensemble,
				},
				success: function (data) {
					// This outputs the result of the ajax request (The Callback)
					media_container.append(data);
					media_button_action.html(media_button_action_alternate_text);
					media_container.addClass("expanded fetched");
					show_all_media_button.removeClass("loading");
				},
				error: function (error) {
					console.error(
						"Error accessing " + my_ajax_object.ajax_url,
						error.responseText
					);
					show_all_media_button.removeClass("loading");
					media_button_action.html(media_button_action_default_text);
				},
			});
			$(this).show();
			return;
		}

		if (isExpanded) {
			// Collapse media section
			media_button_action.html(media_button_action_default_text);
			media_container.removeClass("expanded");
		} else {
			media_button_action.html(media_button_action_alternate_text);
			media_container.addClass("expanded");
		}
	});
	//*** end show all media button
});
