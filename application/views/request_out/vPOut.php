<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Request Out</h2>
            <p class="navbar-right"><a href="<?php echo site_url('requestout/add') ?>" class="btn btn-primary">New Request Out</a></p>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo $this->session->flashdata('msg');?>
            <table id="table-request-out" class="table table-hover table-bordered" style="width: 100%">
              <thead>
                <tr>
                  <th width="10px">No</th>
                  <th>Document No</th>
                  <th>Product</th>
                  <th>Institute</th>
                  <th>Date</th>
                  <th width="10px">Qty</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>File</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
