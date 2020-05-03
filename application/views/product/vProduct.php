<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php echo ucfirst($this->uri->segment(1)) ?></h2>
            <p class="navbar-right"><a href="<?php echo site_url('product/add') ?>" class="btn btn-primary">New Product</a></p>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo $this->session->flashdata('msg');?>
            <table id="table-product" class="table table-hover table-bordered" style="width: 100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Code Product</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
