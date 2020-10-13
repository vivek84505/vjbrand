<?php 	
	foreach ($reporter_description as $row) {
	    $img = json_decode($row['image'], true);
	    foreach ($img as $rows) {
	        $main = $rows['img'];
	    }
        if (file_exists('uploads/news_reporter_image/' . $main)) {
    		$image = base_url().'uploads/news_reporter_image/'.$main;
        } else {
        	$image = base_url().'uploads/others/default_image.png';
        }
        $description = $row['name'].', '.$row['designation'].' : '.$row['about'];
	}
?>