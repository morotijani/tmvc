<h1>Home page view</h1>

<?php

	// creating pagination
	$page = new \Core\Pager;
	$page->ul_styles = "list-style: none; display: flex; margin: 10px;";
	$page->li_styles = "padding: 10px 5px; border: solid thin #000;";
	$page->display();

?>