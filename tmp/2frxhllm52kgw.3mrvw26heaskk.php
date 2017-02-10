	<div class="fullwidth">

		<!-- <h3>Pantalla: <?php echo $title; ?></h3> -->
		<!-- <button onclick="timedImages()">Iniciar</button>
		<button onclick="timedImagesStop()">Detener</button> -->
		<img class="proyeccion-footer" src="ui/images/fotos_footer.png" alt="">

		<div class="grid">
		  <?php $ctr=0; foreach (($images?:array()) as $image): $ctr++; ?>
			<div class="grid-item"><img src="<?php echo trim($image['url']); ?>" alt=""></div>
			<?php endforeach; ?>
		</div>

		
		<script>
		$( document ).ready(function() {
			var $grid =  $('.grid').masonry({
			  // options
			  itemSelector: '.grid-item',
			  columnWidth: 200,
			  // percentPosition: true,
  				gutter: 5,
  				fitWidth: true,
  				transitionDuration: '0'
			});
			$grid.imagesLoaded().progress( function() {
			  $grid.masonry('layout');
			});
		    // console.log( "ready!" );
		    $(function () {
	            $("html, body").animate({
			    scrollTop: $('html, body').get(0).scrollHeight
			}, 18000);
			});
		});
			
		</script>
		
	</div>
	
