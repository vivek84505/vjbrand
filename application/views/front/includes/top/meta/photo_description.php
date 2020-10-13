<?php 	
	foreach ($photo_description as $row) {
		$image = $this->Crud_model->file_view('photo',$row['photo_id'],'','','no','src','multi','one');
        $description = $row['description'];
	}
?>