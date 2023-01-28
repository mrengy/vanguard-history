jQuery(document).ready(function($){

  // fix for 1px by 1px images https://github.com/mrengy/vanguard-history/issues/37
  
  $('img.attachment-60x60').attr('width', 60).attr('height',60);
  $('img.mla_media_thumbnail').attr('width', 64).attr('height',64);
});
