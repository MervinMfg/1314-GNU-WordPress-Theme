<?php
if(isset($_GET['s'])){
	$getVar = $_GET['s'];
}else{
	$getVar = '';
}
?>
<form action="<?php bloginfo('url'); ?>" id="searchform" method="get">
    <div>
        <input type="search" id="s" name="s" value="<?php echo $getVar; ?>" />
        <input type="submit" value="Search" id="searchsubmit" />
    </div>
</form>