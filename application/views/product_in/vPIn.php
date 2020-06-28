<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product In</h2>
            <p class="navbar-right"><a class="btn btn-primary" onclick="reloadProductIn()"><i class="fa fa-refresh"> Refresh</i></a></p>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo $this->session->flashdata('msg'); ?>
            <table id="table-product-in" class="table table-hover table-bordered" style="width: 100%">
              <thead>
                <tr>
                  <th width="10px">No</th>
                  <th>Document No</th>
                  <th>Product</th>
                  <th>Institute</th>
                  <th width="10px">Qty</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>File</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>