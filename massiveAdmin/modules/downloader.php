<style>
	@import url("<?php global $SITEURL;
					echo $SITEURL . 'plugins/massiveAdmin/css/downloader.css'; ?>");
</style>

<link rel="stylesheet" href="<?php global $SITEURL; echo $SITEURL; ?>plugins/massiveAdmin/css/w3.css">
<style> .wrapper a:link, .wrapper .w3-bar-item a:visited {text-decoration: none;}.w3-input{height:25px;width:98%;margin-bottom:30px}</style>
  
<div class="w3-parent w3-container"><!-- Start Plug -->

	<h3 xstyle="margin-bottom:0;">Plugin Downloader</h3>
	<p><a href="https://getsimple-ce.ovh/ce-plugins/" target="_blank"><?php echo i18n_r('massiveAdmin/DOWNLOADERBASED'); ?> <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle" width="1.2em" height="1.2em" viewBox="0 0 32 32"><g fill="black"><path d="M27.527 4.318c-3.09-3.09-8.12-3.09-11.21 0l-4 4c-.227.23-.437.47-.63.72a9.1 9.1 0 0 1 3.84-.131c.258.045.515.102.77.17l.009.062l2.421-2.421a4.52 4.52 0 0 1 6.4 0c1.76 1.77 1.77 4.64 0 6.4l-4 4c-.76.76-1.73 1.17-2.72 1.28c-1.31.14-2.68-.27-3.68-1.28a4.493 4.493 0 0 1-1.24-2.417a3.253 3.253 0 0 0-1.886.91l-1.086 1.087a7.858 7.858 0 0 0 1.812 2.82a7.859 7.859 0 0 0 4.21 2.19a7.99 7.99 0 0 0 7-2.2l4-4c3.08-3.07 3.08-8.1-.01-11.19"/><path d="M19.528 23.538c.233-.237.449-.485.646-.742a9.254 9.254 0 0 1-3.851.143h-.001a9.123 9.123 0 0 1-.83-.186l-2.375 2.375a4.52 4.52 0 0 1-6.4 0a4.52 4.52 0 0 1 0-6.4l4-4c.76-.76 1.73-1.17 2.72-1.28c1.31-.14 2.68.27 3.68 1.28a4.493 4.493 0 0 1 1.242 2.416a3.254 3.254 0 0 0 1.885-.91l1.086-1.087a7.856 7.856 0 0 0-1.812-2.82a7.859 7.859 0 0 0-4.21-2.19a7.88 7.88 0 0 0-4.61.56c-.86.38-1.67.92-2.38 1.63l-4 4c-3.09 3.09-3.09 8.12 0 11.21c3.09 3.09 8.12 3.09 11.21 0z"/></g></svg></a></p>

	<hr>

	<input type="text" class="w3-input w3-border w3-round searchce" placeholder="🔎 <?php echo i18n_r('massiveAdmin/SEARCHPLUGIN'); ?> ">
	<?php
	global $GSADMIN;

	$db = file_get_contents('https://getsimplecms-ce-plugins.github.io/db.json');
	$jsondb = json_decode($db);

	global $SITEURL;

	echo '
	<ul class="db-list">';

	foreach ($jsondb as $key => $value) {
		echo '
		<li>
			<b class="title">' . $value->name . '</b>
			<p class="info">' . $value->info . '</p>
			<hr>
			<p class="version"><b>Version:</b> ' . $value->version . '</p>
			<p class="author">' . $value->author . '</p>
			<form action="#" method="POST">
				<input type="hidden" name="url" value="' . $value->url . '">
				<input type="submit" name="download" class="download" value="' . i18n_r('massiveAdmin/DOWNLOAD') . '">
			</form>
		</li>
		';
	}

	echo '
	</ul>'; ?>

	<?php
	if (isset($_POST['download'])) {
		global $MA;
		$MA->downloadPlugin();
	};
	?>

	<script>
		document.querySelector('.searchce').addEventListener('keyup', (e) => {
			document.querySelectorAll('.db-list li').forEach(
				x => {
					x.style.display = "none";
				}
			);

			document.querySelectorAll('.db-list li').forEach(c => {
				if (c.querySelector('.title').innerHTML.toLowerCase().indexOf(document.querySelector('.searchce').value.toLowerCase()) > -1) {
					c.style.display = "block";
				}
			})
		});
	</script>