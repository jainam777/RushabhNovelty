<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <!-- <img src="../images/no-image.jpg" class="img-circle" alt="User Image"> -->
        <i class="fa fa-user-circle-o fa-2x" style="color:white;" aria-hidden="true"></i>
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['name']; ?>
        </p>
        
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="site_sales.php"><i class="fa fa-money"></i> <span>Sales</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="products.php"><i class="fa fa-circle-o"></i> Product List</a></li>
          <li><a href="product_photos.php"><i class="fa fa-circle-o"></i> Product Photos</a></li>
          <li><a href="category.php"><i class="fa fa-circle-o"></i> Category</a></li>
          <li><a href="subcategory.php"><i class="fa fa-circle-o"></i> Sub-Category</a></li>
        </ul>
      </li>
      <li><a href="sales.php"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
      <li class="header">Contact Us</li>
      <li><a href="customer_msg.php"><i class="fa fa-envelope-o"></i> <span>Customer Messages</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>