<?php echo $data['header'];?>

<h1>UPDATE YOUR STATUS - RETRIEVE YOUR UPDATES</h1>
<hr/>
<h2>News</h2>
<h4><?php echo $data['title'];?></h4>
<div id ="statusUpdate">
<?php
foreach($data['content'] as $d) {
    echo "<p>" . $d . "</p>";
}
?>
</div>
<p><?php echo$data['form'];?></p>
<div class="btnLogOut">
    <a href="<?php echo BASE_HTTP; ?>/logout">Logout</a>
</div>
<?php echo $data['footer'];?>
