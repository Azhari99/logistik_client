<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard </a></li>
      <li><a><i class="fa fa-recycle"></i> Transaction <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo site_url('productin') ?>">Product In</a></li>
          <!-- <li><a href="<?php echo site_url('productout') ?>">Product Out</a></li> -->
        </ul>
      </li>
      <li><a><i class="fa fa-list"></i> Request Product <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <!-- <li><a href="<?php echo site_url('requestin') ?>">Request In</a></li> -->
          <!-- <li><a href="<?php echo site_url('productout') ?>">Request Out</a></li> -->
          <li><a href="<?php echo site_url('requestout') ?>">Request Out</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-file"></i> Report <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="form.html">Product In</a></li>
          <li><a href="form.html">Product Out</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-laptop"></i> Master Data <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo site_url('product') ?>">Product</a></li>
          <li><a href="<?php echo site_url('type') ?>">Type Logistics</a></li>
          <li><a href="<?php echo site_url('category') ?>">Category</a></li>
          <li><a href="<?php echo site_url('institute') ?>">Institute</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-users"></i> Master Data <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo site_url('users') ?>">User</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>