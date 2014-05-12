<?php

require_once 'class.zomatoapi.php';
	//&lon=
$objZomatoApi = new ZomatoApi('7749b19667964b87a3efc739e254ada2','https://api.zomato.com/v1/','xml');
$data = $objZomatoApi->getRestaurantsByCuisine(1,'testing');
if($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
else
{
	$error = $objZomatoApi->getError();
	echo '<pre>';
	print_r($error);
	echo '</pre>';
}




?>