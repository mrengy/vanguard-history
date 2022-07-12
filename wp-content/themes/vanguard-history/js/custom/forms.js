jQuery(document).ready(function($){

  // customize -200 http error message when server rejects large file upload
  // from https://usefulangle.com/post/356/javascript-detect-element-added-to-dom
  const observer = new MutationObserver(function(mutations_list) {
  	mutations_list.forEach(function(mutation) {
  		mutation.addedNodes.forEach(function(added_node) {
  			/* if(added_node.id == 'child') {
  				console.log('#child has been added');
  				observer.disconnect();
  			}
        */
        console.log(added_node);
        /* if (added_node:contains("Failed").length > 0){
          console.log('failed');
        }
        // failing with SyntaxError: missing ) after condition
        */
        /*
        if ( $(added_node:contains('Failed')).length > 0 ){
          console.log('failed');
        }
        // failing with Uncaught SyntaxError: missing ) after argument list
        */
        /*
        if (added_node.li.outerText:contains('Failed').length > 0 ){
          console.log('failed');
        }
        // failing with Uncaught SyntaxError: missing ) after condition
        */
        /*
        if (added_node.outerText == 'Banquet-Video-1992.mp4 - Failed to move uploaded file.'){
          console.log('failed');
        }
        // works but too specific
        */
        if (added_node.outerText.indexOf('Failed') >= 0 ){
          console.log('failed');
        }
        // works but may be brittle if there is additional nesting in the added element
  		});
  	});
  });

  observer.observe(document.querySelector("#gform_multifile_messages_1_1"), { subtree: false, childList: true });
});
