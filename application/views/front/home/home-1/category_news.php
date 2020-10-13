<?php
	$categories = $home_cat_data['categories'];
	$style = $home_cat_data['style'];
	if($style == 4){
		$data['cats'] = $categories;
		echo $this->Html_model->category_box($style,$data); 
	}
	elseif($style == 1){
		$i=0;
		foreach($categories as $row){
			$data['category'] = $row;
			if($i % 2 == 0){
				echo $this->Html_model->category_box('2',$data); 
			}else{
				echo $this->Html_model->category_box('3',$data);
			}
			$i++;
		}
	}else{
		foreach($categories as $row){
			$data['category'] = $row;
			echo $this->Html_model->category_box($style,$data); 
		}
	}
?>