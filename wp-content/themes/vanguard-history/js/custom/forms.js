jQuery(document).ready(function($){

  // customize -200 http error message when server rejects large file upload
  // from https://usefulangle.com/post/356/javascript-detect-element-added-to-dom
  const observer = new MutationObserver(function(mutations_list) {
  	mutations_list.forEach(function(mutation) {
  		mutation.addedNodes.forEach(function(added_node) {
        if (added_node.outerText.indexOf('Error: -200') >= 0 ){
          // works but may be brittle if there is additional nesting in the added element
          $(added_node).append("<p> We're having a hard time with the filesize here, but we would love to receive this file. <strong>Please email us</strong> at <a href=mailto:'history@scvanguard.org'>history@scvanguard.org</a>, and we can arrange another way for you to upload it.</p>");
        }
  		});
  	});
  });

  observer.observe(document.querySelector("#gform_multifile_messages_1_1"), { subtree: false, childList: true });
});
