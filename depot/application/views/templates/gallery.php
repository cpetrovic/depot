<div class="main-content">
	<div class="slider">
		<div class="flexslider">
			<ul class="slides">
				<? foreach ($images as $image) { ?>
					
						<li><a href="<?= site_url($artist_name .'/'. $port_name .'/'. $image['imageID']) ?>"><img src="<?= $image['pathto'] ?>" /></a></li>
					
				<? } ?>
			 </ul>
		</div>
	</div>
</div>

<!-- jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

  <!-- FlexSlider -->
  <script defer src="/js/jquery.flexslider.js"></script>

  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  
  <!-- Syntax Highlighter -->
    <script type="text/javascript" src="/js/shCore.js"></script>
    <script type="text/javascript" src="/js/shBrushXml.js"></script>
    <script type="text/javascript" src="/js/shBrushJScript.js"></script>
  
    <!-- Optional FlexSlider Additions -->
    <script src="/js/jquery.easing.js"></script>
    <script src="/js/jquery.mousewheel.js"></script>
    <script defer src="/js/demo.js"></script>
