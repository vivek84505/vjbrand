<?php 	
	foreach ($page_items as $row) {
		$description = '';
		$parts = json_decode($row['parts'],true);
		foreach ($parts as $lk) {
			if($lk['type'] == 'content'){
				$description .= $lk['content'].' ';
			}
		}
		$description 	= str_replace('justify;"=""', '', $description);
		$description 	= str_replace('[removed]=""', '', $description);
		$description 	= str_replace('&nbsp;', ' ', $description);
		$description 	= str_replace('"',"'",strip_tags($description));
		$description 	= limit_chars($description,100);
        $keywords 		= $keywords.','.$row['tag'];
	}
?>