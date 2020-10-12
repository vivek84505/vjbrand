<ol class="breadcrumb breadcrumb-custom">
    <li>
        <a href="<?php echo base_url(); ?>">
            <i class="fa fa-home"></i>
        </a>
    </li>
    <?php
        if($news_category == '0'){
    ?>
        <li class="active">
            <span>
                <?php echo translate('all_news'); ?>
            </span>
        </li>
    <?php
		}elseif($news_sub_category == '0'){
    ?>
        <li class="active">
            <span>
                <?php echo $this->Crud_model->get_type_name_by_id('news_category',$news_category); ?>
            </span>
        </li>
    <?php
        }else{
    ?>
        <li>
            <a href="<?php echo base_url(); ?>home/news/<?php echo $news_category;?>/0">
                <?php echo $this->Crud_model->get_type_name_by_id('news_category',$news_category); ?>
            </a>
        </li>
        <li class="active">
            <span>
                <?php echo $this->Crud_model->get_type_name_by_id('news_sub_category',$news_sub_category); ?>
            </span>
        </li>
    <?php
        }
    ?>
</ol>