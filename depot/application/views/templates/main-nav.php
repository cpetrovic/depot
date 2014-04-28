<ul>
	<li><a href="<?= site_url() ?>">artists</a>
		<ul>
			<? foreach ($artists as $artist) 
			{ 
				$name = url_title($artist);
				?> <li><a href="<?=site_url($name) ?>"> <?=$artist ?> </a></li><?
			} ?>
		</ul>
	</li>
	<li><a href="<?= site_url('about') ?>">about</a></li>
	<li><a href="<?= site_url('upcoming') ?>">upcoming</a></li>
	<li><a href="<?= site_url('contact') ?>">contact</a></li>
	<li><a href="<?= site_url('cart') ?>">cart</a></li>
</ul>

<ul>
<li><a href="<?= site_url('account') ?>">account</a></li>
</ul>