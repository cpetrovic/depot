<ul class="portfolio">
	<li><a href="#">bio</a></li>
	<li><a href="#">c/v</a></li>
	<li>portfolios
		<ul>
			
			<? foreach ($ports as $port) 
			{ 
				?><li><a href="<?= site_url(url_title($artist_info['fullname']).'/'.$port['name']) ?>"><?=$port['name']?></a></li><?
			} ?>
		</ul>
		
	</li>
</ul>



<h2><?=$title?></h2>