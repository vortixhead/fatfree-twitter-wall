	<div class="fullwidth">

		<h3>Pantalla: <?php echo $title; ?></h3>
		<button onclick="timedImages()">Iniciar</button>
		<button onclick="timedImagesStop()">Detener</button>


		<?php $ctr=0; foreach (($images?:array()) as $image): $ctr++; ?>
		    <div class="taq-img-container">
		    <img src="<?php echo $BASE.'/ui/images/'.trim($image); ?>" alt="<?php echo $title; ?>" id="<?php echo 'taq-'.trim($ctr); ?>" class="taq-img">
		    </div>
		<?php endforeach; ?>

		
	</div>
	<script>
		// esconder desde la segunda en adelante segun ID
		for (var i = 2; i <= 5; i++) {
			$('#taq-'+i).hide();
		}

		// Intervalos
		var timeout1 = 2000;
		var timeout2 = 4000;
		var timeout3 = 6000;
		var timeout4 = 8000;
		var timeout5 = 10000;
		
		function timedImages() {
		    timeout1 = setTimeout(myTimeout1, 2000) 
		    timeout2 = setTimeout(myTimeout2, 4000) 
		    timeout3 = setTimeout(myTimeout3, 6000)
		    timeout4 = setTimeout(myTimeout4, 8000) 
		    timeout5 = setTimeout(myTimeout5, 10000)  
		}
		function myTimeout1() {
		    $('#taq-1').fadeOut();
		    $('#taq-2').fadeIn();
		}
		function myTimeout2() {
		   $('#taq-2').fadeOut();
		    $('#taq-3').fadeIn();
		}
		function myTimeout3() {
		    $('#taq-3').fadeOut();
		    $('#taq-4').fadeIn();
		}
		function myTimeout4() {
		    $('#taq-4').fadeOut();
		    $('#taq-5').fadeIn();
		}
		function myTimeout5() {
		    $('#taq-5').fadeOut();
		    $('#taq-1').fadeIn();
		}

		function timedImagesStop() {
		   for (var i = 2; i <= 5; i++) {
		   		$('#taq-'+i).stop();
				$('#taq-'+i).hide();
			}
			$('#taq-1').show();

			clearTimeout(timeout1);
			clearTimeout(timeout2);
			clearTimeout(timeout3);
			clearTimeout(timeout4);
			clearTimeout(timeout5);
		}


	</script>
