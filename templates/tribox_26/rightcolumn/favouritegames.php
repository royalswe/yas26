<div class="navh3">
  <div align="center">Favorite Games
  </div>
</div>
<div id="favs">
<?php 
if(isset($_SESSION["user"])) { 
	?><div class="links1"><?php
	$user = $_SESSION["user"]; 
	$userid = $_SESSION["userid"];
	$query = yasDB_select("SELECT * FROM favourite WHERE userid= '$userid' limit 5",false);
	while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
		$games = yasDB_select("SELECT * FROM games WHERE id = '{$row['gameid']}'",false);
		$game = $games->fetch_array(MYSQLI_ASSOC);
		$gameurl = $game['file'];
		$gameurl = str_replace(" ", "-", $gameurl);
	    $gameurl = str_replace("'", "_", $gameurl);
	    $gameurl = str_replace('"', "_", $gameurl);
		$gameurl = str_replace('/', "_", $gameurl);
		$gameurl = str_replace("\\", "_", $gameurl);
		$gameurl = rawurlencode($gameurl);
		if ($setting['seo']=='yes') {
			echo'<a href="' . $setting['siteurl'] . 'game/' . $game['id'] . '/' . $gameurl . '.html' . '">' . $game['title'] . '</a>';
        }
		else {
			echo'<a href="' . $setting['siteurl'] . 'index.php?act=game&id=' . $game['id'] . '">' . $game['title'] . '</a>';
    	}
    }
	if ($query->num_rows == 0) {
			echo '<div>There are no games in your Favorites.';
	}
	else {
		if ($setting['seo']=='yes') {
			echo'<div><center><a href="' . $setting['siteurl'] . 'favourites.html">More</a></center>';
		}
		else {
			echo'<div><center><a href="' . $setting['siteurl'] . 'index.php?act=favourites">More</a></center>';
		}
	}
	echo '</div></div></div>';
	$query->close();
}
else {
	echo '</div>Log in to view your saved games list.';
}
?>
