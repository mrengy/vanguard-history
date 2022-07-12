jQuery(document).ready(function($){

  // customize -200 http error message when server rejects large file upload
  // from https://usefulangle.com/post/356/javascript-detect-element-added-to-dom
  const observer = new MutationObserver(function(mutations_list) {
  	mutations_list.forEach(function(mutation) {
  		mutation.addedNodes.forEach(function(added_node) {
        console.log(added_node);
        if (added_node.outerText.indexOf('Failed') >= 0 ){
          console.log('failed');
          $(added_node).append("<p> Unfortunately, this form can't accept individual files over 256 MB, but we would love to receive this file. <strong>Please email us</strong> at <a href=mailto:'history@scvanguard.org'>history@scvanguard.org</a>, and we can arrange another way for you to upload it.</p>");
        }
        // works but may be brittle if there is additional nesting in the added element
  		});
  	});
  });

  observer.observe(document.querySelector("#gform_multifile_messages_1_1"), { subtree: false, childList: true });
});
