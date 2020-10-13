<?php
	foreach ($news_description as $row) {
	    $img = json_decode($row['img_features'], true);
		$main = "";
	    foreach ($img as $rows) {
	    	if($rows['index'] == 0){
		        $main = $rows['img'];
		    }
	    }
        if (file_exists('uploads/news_image/' . $main)) {
    		$image = base_url().'uploads/news_image/'.$main;
        } else {
        	$image = base_url().'uploads/news_image/default.png';
        }
        $description = $row['summary'];
        $keywords = $keywords.','.$row['tag'];
	}
?>
