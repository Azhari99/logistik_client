<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icondash"><i class="fa fa-caret-square-o-down"></i></div>
          <div class="total"><?= rupiah($budget_inst) ?></div>
          <h3>Jumlah Anggaran</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icondash"><i class="fa fa-caret-square-o-up"></i></div>
          <div class="total"><?= $productin.' Product' ?></div>
          <h3>Product In</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icondash"><i class="fa fa-caret-square-o-down"></i></div>
          <div class="total"><?= $requestout.' Not Completed' ?></div>
          <h3>Jumlah Pengajuan</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icondash"><i class="fa fa-list"></i></div>
          <div class="total"><?= rupiah($remain) ?></div>
          <h3>Sisa Anggaran</h3>
        </div>
      </div>
    </div>
  </div>
</div>