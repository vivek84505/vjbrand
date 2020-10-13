<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 content pad-lr-5" id="content">
	<span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="padding: 5px 12px; border-radius:4px;" onclick="open_sidebar();">
	<i class="fa fa-bars"></i>
	</span>
	<div id="intro" class="hidden-sm hidden-xs">
		<ol class="breadcrumb breadcrumb-custom">
			<li>
			<a href="<?=base_url()?>"> <i class="fa fa-home"></i>
			</a>
			</li>
            <li class="active">
                <a href="<?php echo base_url(); ?>home/blog_category/<?php echo $blog_detail->blog_category_id; ?>/0">
                    <?php echo $this->Crud_model->get_type_name_by_id('blog_category', $blog_detail->blog_category_id); ?>
                </a>
            </li>
            <?php
            if ($blog_detail->blog_sub_category_id !== '0') {
                ?>
                <li class="active">
                    <a href="<?php echo base_url(); ?>home/blog_category/<?php echo $blog_detail->blog_category_id; ?>/<?php echo $blog_detail->blog_sub_category_id; ?>">
                        <?php echo $this->Crud_model->get_type_name_by_id('blog_sub_category', $blog_detail->blog_sub_category_id); ?>
                    </a>
                </li>
                <?php
            }
            ?>
		</ol>
	</div>
	<div class="content" id="result" style="display: block;">
		<div class="box_shadow mar-lr-0">
			<article class="post-wrap">
                <div class="post-media">
                    <div class="owl-carousel img-carousel">
                    	<?php
                            $images = json_decode($blog_detail->img_features, true);
                            if (empty($images)) {
                        	?>
                        		<div class="item">
                        			<span>
                        				<a href="#" data-gal="prettyPhoto">
                                            <!-- <img class="img-responsive" src="<?=base_url()?>uploads/blog_image/default.jpg" alt="" style="height: 100%"/> -->
                                            <div class="item-image cursorPointer" style=" height: 420px; background-image: url(<?=base_url()?>uploads/blog_image/default.jpg)"></div>
                                        </a>
                        			</span>
                        		</div>
                        	<?php
                            } else {
	                            foreach ($images as $image) {
	                                // $image['img'];
	                                ?>
	                                	<div class="item">
	                                		<span onClick="image_modal('<?=base_url()?>uploads/blog_image/<?=$image['img']?>')">
	                                			<a href="#" data-gal="prettyPhoto">
                                                    <!-- <img class="img-responsive" src="<?=base_url()?>uploads/blog_image/<?=$image['img']?>" alt="" style="height: 100%"/> -->
                                                    <div class="item-image cursorPointer" style=" height: 420px; background-image: url(<?=base_url()?>uploads/blog_image/<?=$image['img']?>)"></div>
                                                </a>
	                                		</span>
	                                	</div>
	                                <?php
	                            }
	                        }
                    	?>
                    </div>
                </div>
                <div class="post-header">
                    <h2 class="post-title"><?=$blog_detail->title?></h2>
                    <div class="post-meta">
						<?php
						if($blog_detail->blog_uploader_type == 'admin') { ?>
							<a href="#"> <i class="fa fa-user"></i><?php echo translate('admin'); ?></a>
							<span class="divider">|</span>
						<?php } else { ?>
							<a href="<?php echo $this->Crud_model->bloggers_link($blog_detail->blog_uploader_id);?>"> <i class="fa fa-user"></i> <?=$this->Crud_model->get_type_name_by_id('user', $blog_detail->blog_uploader_id,'firstname').' '.$this->Crud_model->get_type_name_by_id('user', $blog_detail->blog_uploader_id,'lastname');?> </a>
							<span class="divider">|</span>
						<?php }?>
						<a href="#"> <i class="fa fa-clock-o"></i> <?=date("F j, Y",$blog_detail->date);?> </a>
						<span class="divider">|</span>
						<a href="#"><i class="fa fa-eye"></i> <?=$blog_detail->view_count.' '.translate('views')?> </a>
					</div>
                </div>
                <div class="post-body">
                    <div class="post-excerpt">
                        <p><?=$blog_detail->summary?></p>
                        <p><?=$blog_detail->description?></p>
                    </div>
                </div>
                <div class="post-body social_share">
                	<div id="share"></div>
                </div>
                <!-- PAGE -->
                <section class="page-section no-padding-bottom box_shadow mar-lr-0 comments">
                    <?php if ($comment_type == 'disqus') { ?>
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = '<?php echo $discus_id; ?>';

                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function () {
                                var dsq = document.createElement('script');
                                dsq.type = 'text/javascript';
                                dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = '<?php echo $discus_id; ?>';

                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function () {
                                var s = document.createElement('script');
                                s.async = true;
                                s.type = 'text/javascript';
                                s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
                            }());
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                        <?php
	                    } else if ($comment_type == 'facebook') {
	                        ?>

	                        <div id="fb-root"></div>
	                        <script>(function (d, s, id) {
	                                var js, fjs = d.getElementsByTagName(s)[0];
	                                if (d.getElementById(id))
	                                    return;
	                                js = d.createElement(s);
	                                js.id = id;
	                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=<?php echo $fb_id; ?>";
	                                fjs.parentNode.insertBefore(js, fjs);
	                            }(document, 'script', 'facebook-jssdk'));</script>
	                        <div class="fb-comments" data-href="<?php echo $this->Crud_model->blog_link($blog_detail->blog_id); ?>" data-numposts="5"></div>

	                        <?php
	                    }
	                ?>
	            </section>
	            <!-- /PAGE -->
            </article>
		</div>
	</div>
</div>
