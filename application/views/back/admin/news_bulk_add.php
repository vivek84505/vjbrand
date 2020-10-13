<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('news_bulk_add'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="" style="border:1px solid #ebebeb; border-radius:4px;">

                        <?php if($this->session->flashdata('success') != null ){ ?>
            				<div class="alert alert-success" id="success_alert" style="display: block">
            					<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
            					<?php echo $this->session->flashdata('success'); ?>
            				</div>
            			<?php } ?>
            			<?php if($this->session->flashdata('error') != null ){ ?>
            				<div class="alert alert-danger" id="danger" style="display: block">
            					<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
            					<?php echo $this->session->flashdata('error'); ?>
            				</div>
            			<?php } ?>

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('instructions'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <ol>
                                <li>
                                    <?php echo translate('Download the skeleton file and fill it with data.'); ?>
                                </li>
                                <li>
                                    <?php echo translate('You can download the example file to understand how the data must be filled'); ?>
                                </li>
                                <li>
                                    <?php echo translate('Once you have downloaded and filled the skeleton file , upload it in the form below and
                                    submit.'); ?>
                                </li>
                                <li>
                                    <code>* <?php echo translate('Do not upload more than 50 news at a time .'); ?></code>
                                </li>
                                <li>
                                    <?php echo translate('News should be uploaded successfully.'); ?>
                                </li>
                            </ol>
                            <div class="form-group">
                                <a class="btn btn-sm btn-primary btn-dark" target="_blank" download
                                   href="<?php echo base_url() . "uploads/bulk_skeletons/news.xlsx" ?>"><?php echo translate('Download news bulk add skeleton file'); ?></a>
                                <a class="btn btn-sm btn-primary" target="_blank" download
                                   href="<?php echo base_url() . "uploads/bulk_skeletons/news_example.xlsx" ?>"><?php echo translate('Download news bulk add example file'); ?></a>
                            </div>
                            <hr>
                        </div>

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('more_instructions'); ?></h3>
                        </div>

                        <div class="panel-body">
                            <ol>
                                <li>News Category, Sub category, Speciality and Reporter should be in <code>numerical ids</code>.Click the <code>respected modals/pop-ups</code> to see the related ids</li>
                                <li>Tags are comma separated.If you have tags like "business" and "stock" write <code>business,stock</code>.</li>
                                <li>Image Urls are comma separated.If you have many image urls write like this: <code>http://imagescource/image001.jpg,http://anotherimagescource/image005.jpg</code></li>
                                <li>To publish automatically, fill the "published" column with <code>published</code></li>
                                <li>News should be uploaded successfully.</li>
                            </ol>
                            <br>
                            <div class="form-group">
                                <button data-target="#categoryIdList" type="button" class="btn btn-primary" data-toggle="modal"><?php echo translate("category_id_list") ?></button>
                                <button data-target="#subCategoryIdList" type="button" class="btn btn-primary" data-toggle="modal"><?php echo translate("sub_category_id_list") ?></button>
                                <button data-target="#newsSpecialityIdList" type="button" class="btn btn-primary" data-toggle="modal"><?php echo translate("news_speciality_id_list") ?></button>
                                <button data-target="#newsReporterIdList" type="button" class="btn btn-primary" data-toggle="modal"><?php echo translate("news_reporter_id_list") ?></button>
                            </div>
                            <hr>
                        </div>

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('upload_your_news'); ?></h3>
                        </div>

                        <div class="panel-body">
                            <?php
                                echo form_open(base_url() . 'admin/news_bulk_add/do_add', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>

            					<div class="form-group">
            						<label class="col-sm-2 control-label" for="fname"><b><?= translate('upload_file')?> <span class="text-danger">*</span></b></label>
            						<div class="col-sm-5">
            							<input type="file" name="bulk_news_file" ondragover="" class="form-control" required>
            						</div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-success btn-labeled fa fa-upload" type="submit"><?php echo translate("Upload News") ?></button>
                                    </div>
            					</div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!--Panel body-->
        </div>
    </div>
</div>

<!-- news category IDS -->
<div class="modal fade" id="categoryIdList" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo translate('news_category_ids'); ?></h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered table-responsive dataTable">
              <tr>
                  <th><?php echo translate('news_category_ID'); ?></th>
                  <th><?php echo translate('news_category_name'); ?></th>
              </tr>
              <?php
                $categories = $this->db->get('news_category')->result_array();
                foreach ($categories as $category) { ?>
                    <tr>
                        <td><?php echo $category['news_category_id']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                    </tr>
                <?php }
              ?>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- News Sub Category Ids -->
<div class="modal fade bd-example-modal-lg" id="subCategoryIdList" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo translate('news_sub_category_ids'); ?></h4>
      </div>
      <div class="modal-body" style="overflow:scroll; max-height:400px;">
          <table class="table table-bordered table-responsive dataTable">
              <tr>
                  <th><?php echo translate('news_sub_category_ID'); ?></th>
                  <th><?php echo translate('news_sub_category_name'); ?></th>
                  <th><?php echo translate('news_category_name').'-'.translate('id'); ?></th>
              </tr>
              <?php
                $sub_categories = $this->db->get('news_sub_category')->result_array();
                foreach ($sub_categories as $sub_category) { ?>
                    <tr>

                        <td><?php echo $sub_category['news_sub_category_id']; ?></td>
                        <td><?php echo $sub_category['name']; ?></td>
                        <td><?php echo $this->db->get_where('news_category',array('news_category_id' => $sub_category['parent_category_id']))->row()->name.' - '.$sub_category['parent_category_id']; ?></td>
                    </tr>
                <?php }
              ?>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo translate('close'); ?></button>
      </div>
    </div>
  </div>
</div>

<!-- news Speciality Ids -->
<div class="modal fade" id="newsSpecialityIdList" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo translate('news_speciality_ids'); ?></h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered table-responsive dataTable">
              <tr>
                  <th><?php echo translate('news_speciality_ID'); ?></th>
                  <th><?php echo translate('news_speciality_name'); ?></th>
              </tr>
              <?php
                $news_specialities = $this->db->get('news_speciality')->result_array();
                foreach ($news_specialities as $news_speciality) { ?>
                    <tr>
                        <td><?php echo $news_speciality['news_speciality_id']; ?></td>
                        <td><?php echo $news_speciality['name']; ?></td>
                    </tr>
                <?php }
              ?>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo translate('close'); ?></button>
      </div>
    </div>
  </div>
</div>

<!-- news reporter IDS -->
<div class="modal fade" id="newsReporterIdList" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo translate('news_reporter_ids'); ?></h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered table-responsive dataTable">
              <tr>
                  <th><?php echo translate('news_reporter_ID'); ?></th>
                  <th><?php echo translate('news_reporter_name'); ?></th>
              </tr>
              <?php
                $news_reporters = $this->db->get('news_reporter')->result_array();
                foreach ($news_reporters as $news_reporter) { ?>
                    <tr>
                        <td><?php echo $news_reporter['news_reporter_id']; ?></td>
                        <td><?php echo $news_reporter['name']; ?></td>
                    </tr>
                <?php }
              ?>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    var base_url = '<?php echo base_url(); ?>';
    var user_type = 'admin';
    var module = 'news_bulk_add';
    var list_cont_func = '';
    var dlt_cont_func = '';
</script>
