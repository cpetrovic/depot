<div class="main-content cf">
	<div class="about">
		<?  foreach($artistsarray as $artist)
		{
			?><h2>
			<?
				echo $artist['fullname'];
			?>
			</h2>
			
			<p>
			<?
				echo $artist['bio'];
			?>
			</p>
			<hr />
			<?
		}
		?>
	</div>
</div>