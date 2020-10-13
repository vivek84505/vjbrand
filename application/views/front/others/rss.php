<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>
<rss version="2.0">
<channel>
 <title><?php echo $this->Crud_model->get_settings_value('general_settings','system_title');?></title>
 <description><?php echo $this->Crud_model->get_settings_value('general_settings','meta_description');?></description>
 <link><?= base_url(); ?></link>
 <ttl><?= $news_num; ?></ttl>

<?php
    if (!empty($all_news)) {
    	foreach ($all_news as $row) {
    		$img_features = json_decode($row['img_features'],true);
	 	?>
			<item>
				<image>
					&lt;img width="680" height="510" src="<?=base_url()?>uploads/news_image/<?=$img_features[0]['img'];?>" alt="" sizes="(max-width: 680px) 100vw, 680px" /&gt;&amp;nbsp;
				</image>
				<title><?= htmlspecialchars($row['title']); ?></title>
				<description>
					<?= htmlspecialchars(strip_tags($row['description'])); ?>
				</description>
				<link><?= $this->Crud_model->news_link($row['news_id']); ?></link>
				<guid isPermaLink="false"><?= $this->Crud_model->news_link($row['news_id']); ?></guid>
				<pubDate><?php echo date("Y-m-d",$row['date']);?></pubDate>
			</item>
<?php
		}
	}
?>

</channel>
</rss>
