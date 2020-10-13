<?php 	
	foreach ($video_description as $row) {
        if ($row['type'] == 'upload') {
    		$image = base_url().$row['video_src'];
        } else {
        	$image = $row['video_src'];
        }
        $description = $row['description'];
	}
?>