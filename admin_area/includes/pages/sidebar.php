<?php require_once('../../functions/functions.php'); ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>pages/order/index">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>pages/customer/index">
              <i class="mdi mdi-account-circle menu-icon"></i>
              <span class="menu-title">Customers</span>
            </a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-information menu-icon"></i>
              <span class="menu-title">Product Specification</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL; ?>pages/brand/index">Brands</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL; ?>pages/category/index">Categories</a></li>
              </ul>
            </div>
          </li>
          -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>pages/product/index">
              <i class="mdi mdi-basket menu-icon"></i>
              <span class="menu-title">Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>pages/order/index">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Orders</span>
            </a>
          </li>
        </ul>
      </nav>