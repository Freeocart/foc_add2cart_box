
<?php echo $header; ?>
<?php if (isset($column_left)) { echo $column_left; } ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <div class="pull-right">
          <button type="submit" form="foc_add2cart_box_form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
          <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="<?php echo $button_cancel; ?>"><i class="fa fa-reply"></i></a></div>
        </div>

        <h1><?php echo $heading_title; ?></h1>

        <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) : ?>
          <li><a href="<?php echo $breadcrumb["href"]; ?>"><?php echo $breadcrumb["text"]; ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
  </div>

  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form id="foc_add2cart_box_form" class="form form-horizontal" action="<?php $action; ?>" method="POST">

          <ul class="nav nav-tabs">
            <?php foreach ($languages as $language) : ?>
            <li <?php if ($language['language_id'] == $language_id) : ?>class="active"<?php endif; ?>>
              <a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            </li>
            <?php endforeach; ?>
            <li>
              <a href="#tab-info" data-toggle="tab">
                <i class="fa fa-info-circle"></i> <?php echo $labels['foc_add2cart_box_info_tab_name']; ?>
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <?php foreach ($languages as $language) : ?>
            <div class="tab-pane <?php if ($language['language_id'] == $language_id) : ?>active<?php endif; ?>" id="language<?php echo $language['language_id']; ?>">
              <div class="form-group">
                <label class="control-label col-sm-2"><?php echo $labels['foc_add2cart_box_title']; ?></label>
                <div class="col-sm-10">
                  <input name="foc_add2cart_box[<?php echo $language['language_id']; ?>][foc_add2cart_box_title]" type="text" class="form-control" value="<?php echo $fa2cb_settings[$language['language_id']]['foc_add2cart_box_title']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2">
                  <span data-toggle="tooltip" title="<?php echo $tooltips['foc_add2cart_box_content']; ?>"><?php echo $labels['foc_add2cart_box_content']; ?></span></label>
                <div class="col-sm-10">
                  <textarea name="foc_add2cart_box[<?php echo $language['language_id']; ?>][foc_add2cart_box_content]" rows="3" class="form-control summernote"><?php echo $fa2cb_settings[$language['language_id']]['foc_add2cart_box_content']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2"><?php echo $labels['foc_add2cart_box_continue_label']; ?></label>
                <div class="col-sm-10">
                  <input name="foc_add2cart_box[<?php echo $language['language_id']; ?>][foc_add2cart_box_continue_label]" type="text" class="form-control" value="<?php echo $fa2cb_settings[$language['language_id']]['foc_add2cart_box_continue_label']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2"><?php echo $labels['foc_add2cart_box_continue_css_class']; ?></label>
                <div class="col-sm-10">
                  <input name="foc_add2cart_box[<?php echo $language['language_id']; ?>][foc_add2cart_box_continue_css_class]" type="text" class="form-control" value="<?php echo $fa2cb_settings[$language['language_id']]['foc_add2cart_box_continue_css_class']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2"><?php echo $labels['foc_add2cart_box_autoclose_time']; ?></label>
                <div class="col-sm-10">
                  <input name="foc_add2cart_box[<?php echo $language['language_id']; ?>][foc_add2cart_box_autoclose_time]" type="text" class="form-control" value="<?php echo $fa2cb_settings[$language['language_id']]['foc_add2cart_box_autoclose_time']; ?>">
                </div>
              </div>
            </div>
            <?php endforeach; ?>

            <div id="tab-info" class="tab-pane">
              <h3><?php echo $labels['foc_add2cart_box_info_tab_title']; ?></h3>
              <hr>
              <div>
                <?php echo $labels['foc_add2cart_box_info_tab_content']; ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>


<?php echo $footer; ?>
