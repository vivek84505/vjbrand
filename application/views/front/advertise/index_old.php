<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <!-- CONTENT -->
                <div class="col-md-12 content pad-lr-5" id="content">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            <span>
                                <?php echo translate('apply_for_advertisement'); ?>
                            </span>
                        </li>
                    </ol>
                    <div class="col-md-12 pad-lr-10 mar-t-15">
                        <div class="box_shadow wishlist">
                            <div class="information-title">
                                <?php echo translate('available_space'); ?> [ <span><?php echo translate('this_positions_are_available_for_advertise'); ?></span> ]
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo translate('page_name'); ?></th>
                                        <th><?php echo translate('choose_position'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($pages as $row1) {
                                            if ($this->Crud_model->check_page_ad_availability('available', $row1['ad_page_id'])) {
                                                ?>
                                                <tr>
                                                    <td style="width:50%;"><?php echo $row1['name']; ?></td>
                                                    <td>
                                                        <ul>
                                                            <?php
                                                            $available = $this->db->get_where('advertisement', array('page_id' => $row1['ad_page_id'], 'status' => 'ok', 'availability' => 'available'))->result_array();
                                                            foreach ($available as $pos) {
                                                                ?>
                                                                <li>
                                                                    <div class="radio">
                                                                        <input type="radio" name="ad_type" class="radio_ad" value="<?php echo $pos['type']; ?>" id="<?php echo $pos['type']; ?>"/>
                                                                        <label for="<?php echo $pos['type']; ?>"><?php echo $pos['position']; ?></label>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 content pad-lr-10 mar-t-15">
                        <div class="box_shadow wishlist">
                            <div class="information-title">
                                <?php echo translate('occupied_space'); ?> [ <span><?php echo translate('this_positions_are_available_for_booking_request'); ?></span> ]
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo translate('page_name'); ?></th>
                                        <th><?php echo translate('choose_position'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($pages as $row1) {
                                            if ($this->Crud_model->check_page_ad_availability('booked', $row1['ad_page_id'])) {
                                                ?>
                                                <tr>
                                                    <td style="width:50%;"><?php echo $row1['name']; ?></td>
                                                    <td>
                                                        <ul>
                                                            <?php
                                                            $available = $this->db->get_where('advertisement', array('page_id' => $row1['ad_page_id'], 'status' => 'ok', 'availability' => 'booked'))->result_array();
                                                            foreach ($available as $pos) {
                                                                ?>
                                                                <li>
                                                                    <div class="radio">
                                                                        <input type="radio" class="radio_ad" name="ad_type" value="<?php echo $pos['type']; ?>" id="<?php echo $pos['type']; ?>"/>
                                                                        <label for="<?php echo $pos['type']; ?>"><?php echo $pos['position']; ?></label>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <span class="button-custom-btn-1 pull-right custom-btn-1-round-l letter-spacing-none custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('apply_for_advertise'); ?>">		
                        <span class="apply"><?php echo translate('apply_for_advertise'); ?></span>
                    </span>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA-->
<style>
    .information-title span{
        text-transform: capitalize;
        color: #232323;
        background: #efefef;
    }
    tbody tr{
        transition: all 0.6s ease;
    }
    tbody tr.active{
        background: #f9f9f9;
        transition: all 0.6s ease;
    }
    .radio{
        transition: all 0.6s ease;
    }
    .radio.active label{
        color:#555555;
        transition: all 0.6s ease;
    }
</style>
<script>
    $('.radio_ad').on('click', function (e) {
        $('tbody tr').removeClass('active');
        $('.radio').removeClass('active');
        $(this).closest('tr').addClass('active');
        $(this).closest('.radio').addClass('active');
    });
    $('.apply').on('click', function (e) {
        e = e || window.event;
        e = e.target || e.srcElement;
        var state = check_login_stat('state');
        var selected = $('input[type=radio]:checked').val();
        state.success(function (data) {
            if (data == 'hypass') {
                if (selected != null) {
                    location.replace('<?php echo base_url(); ?>home/profile/ad/' + selected);
                } else {
                    notify('<?php echo translate('choose_a_position_and_click_again'); ?>', 'warning', 'bottom', 'right');
                }
            } else {
                signin('quick');
            }
        });
    });
</script>
