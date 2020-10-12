<ol class="breadcrumb breadcrumb-custom">
    <li>
        <a href="<?php echo base_url(); ?>">
            <i class="fa fa-home"></i>
        </a>
    </li>
    <?php
        if($blog_category == '0'){
    ?>
        <li class="active">
            <span>
                <?php echo translate('all_blog'); ?>
            </span>
        </li>
    <?php
		}elseif($blog_sub_category == '0'){
    ?>
        <li class="active">
            <span>
                <?php echo $this->Crud_model->get_type_name_by_id('blog_category',$blog_category); ?>
            </span>
        </li>
    <?php
        }else{
    ?>
        <li>
            <a href="<?php echo base_url(); ?>home/category_blog/<?php echo $blog_category;?>/0">
                <?php echo $this->Crud_model->get_type_name_by_id('blog_category',$blog_category); ?>
            </a>
        </li>
        <li class="active">
            <span>
                <?php echo $this->Crud_model->get_type_name_by_id('blog_sub_category',$blog_sub_category); ?>
            </span>
        </li>
    <?php
        }
    ?>
</ol>