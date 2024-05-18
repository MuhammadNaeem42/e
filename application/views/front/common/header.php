<?php
$user_id=$this->session->userdata('user_id');
$sitelan = $this->session->userdata('site_lang');
$currency = $this->common_model->getTableData('currency',array('status'=>'1','type'=>'digital'),'','','','','','', array('sort_order', 'ASC'))->result();
$favicon = $site_common['site_settings']->site_favicon;
$sitelogo = $site_common['site_settings']->site_logo;
$users = $this->common_model->getTableData('users',array('id'=>$user_id))->row();
$pairs = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','','', array('id', 'ASC'))->result();
$meta_description = $sitelan."_meta_description";
$meta_keywords = $sitelan."_meta_keywords";
$title = $sitelan."_title";
$slug = $this->uri->segment(1);
$slug_two = $this->uri->segment(2);
// echo $slug;
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if($meta_content): echo $meta_content->$title; else: echo 'BLACKCUBE EXCHANGE'; endif;?></title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo front_css();?>app.css" />
    <link rel="shortcut icon" href="<?php echo $favicon;?>" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo $favicon;?>" />
    <!-- Wallet Chart -->
    <link rel="stylesheet" href="<?php echo front_css();?>morris.css" />

    <!-- datepicker CSS -->
    <link rel="stylesheet" href="<?php echo front_css();?>datepicker.css" />

    <!-- datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />

    <link rel="shortcut icon" href="assets/images/favicon.png" />

  </head>
  <?php if($slug == "home" || $slug == "") { ?>
    <body class="body header-fixed jb_blue_total_page jbhbg_act">
  <?php } else { ?>
    <body class="body header-fixed jb_blue_total_page">
  <?php } ?>
    <!-- Header -->
    <div class="jb_mbl_menu">
      <div class="jb_mbl_menu_scrl">
        <a href="<?php echo base_url();?>" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-home "></i>
          <div class="jb_mbl_menu_txt">Home</div>
        </a>
        <a href="#" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-coins "></i>
          <div class="jb_mbl_menu_txt">Buy Crypto</div>
        </a>
        <a href="#" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-book-reader "></i>
          <div class="jb_mbl_menu_txt">Learn</div>
        </a>
        <a href="#" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-chart-bar "></i>
          <div class="jb_mbl_menu_txt">Trade</div>
        </a>
        <a href="<?php echo base_url();?>profile" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-users "></i>
          <div class="jb_mbl_menu_txt">Profile</div>
        </a>
        <a href="<?php echo base_url();?>cms/terms-and-conditions" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-sticky-note "></i>
          <div class="jb_mbl_menu_txt">Terms</div>
        </a>
        <a href="<?php echo base_url();?>signin" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-key "></i>
          <div class="jb_mbl_menu_txt">Sign In</div>
        </a>
        <a href="<?php echo base_url();?>register" class="jb_mbl_menu_li">
          <i class="jb_mbl_menu_i fal fa-user-plus "></i>
          <div class="jb_mbl_menu_txt">Register</div>
        </a>
      </div>
    </div>
    <div class="jb_home_bnr">
      <header id="header_main" class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="header__body d-flex justify-content-between">
                <div class="header__left">
                  <div class="logo">
                    <a class="light" href="<?php echo base_url();?>">
                    <img
                      src="<?php echo $sitelogo;?>"
                      alt=""
                      width="170"
                      height="80"
                      data-retina="<?php echo $sitelogo;?>"
                      data-width="170"
                      data-height="20" 
                      />
                    </a>
                  </div>
                  <div class="left__main">
                    <nav id="main-nav" class="main-nav">
                      <ul id="menu-primary-menu" class="menu">
                        <li class="jb_buycrypto_modal_tot_btn"> <a href="#">Buy Crypto </a></li>
                        <!-- <li> <a href="#"> P2P </a> -->
                          
                        <div class="dropdown user">
                    <button style="color:#fff;"
                      class="btn dropdown-toggle"
                      type="button"
                      id="dropdownMenuButton4"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false" >
                      P2P 
                     </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4" >
                      <a class="dropdown-item" href="">
                      <span>Create order</span></a>
                      <a class="dropdown-item" href="">
                      <span>P2P Lists</span></a>
                      <a class="dropdown-item" href="">
                      <span>My P2P orders</span></a>
                    </div>
                    </div>	
                        </li>
                        <li> <a href="<?php echo base_url();?>cms/about-us">About </a></li>
                        <li> <a href="<?php echo base_url();?>contact_us">Contact </a></li>
                      </ul>
                    </nav>
                    <!-- /#main-nav -->
                  </div>
                </div>
                <?php if($user_id != '') { ?>
                  <div class="header__right">
                    <!-- <select class="jb_top_menu_money_selector">
                      <option value="0">$</option>
                      <option value="0">NZ$</option>
                      <option value="0">AU$</option>
                    </select> -->
                    <div class="dropdown user">
                    <button
                      class="btn dropdown-toggle"
                      type="button"
                      id="dropdownMenuButton4"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false" >
                      <?php if($users->profile_picture!='') {
                        $img = $users->profile_picture;
                      } else {
                        $img = front_img().'avt.png';
                      }

                      ?>
                      <img src="<?php echo $img;?>" alt="" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4" >
                      <a class="dropdown-item" href="<?php echo base_url();?>profile">
                      <span>Profile</span></a>
                      <a class="dropdown-item" href="<?php echo base_url();?>dashboard">
                      <span>Dashboard</span></a>
                      <a class="dropdown-item" href="<?php echo base_url();?>kyc">
                      <span>KYC</span></a>
                      <a class="dropdown-item" href="<?php echo base_url();?>wallet">
                      <span>My Wallet</span></a>
                      <a class="dropdown-item d-block" href="<?php echo base_url();?>settings"><span>Settings</span></a>
                    
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="<?php echo base_url();?>logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                      <span>Logout</span></a>
                    </div>
                    </div>				
                  </div>
                <?php } else { ?>			
                  <div class="header__right">
                    <div class="wallet">
                      <a href="<?php echo base_url();?>register" class="jb_sign_btn"> Register </a>
                    </div>
                    <a href="<?php echo base_url();?>signin" class="jb_sign_btn">Sign In</a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- end Header -->
    </div>
    <?php if($user_id != '') { ?>
      <?php if($slug == "home" || $slug == "") { ?>
      <div class="jb_sid_hdr_out_to dash_menu_hide">
      <?php } else { ?>
      <div class="jb_sid_hdr_out_to">
      <?php } ?>
        <div class="jb_sid_hdr_out">
          <a href="<?php echo base_url();?>" class="jb_sid_hdr_li">
            <i class="fal fa-home"></i>
            <div class="jb_sid_hdr_li_txt">Home</div>
          </a>
          <div class="jb_sid_hdr_li jb_buycrypto_modal_tot_btn">
            <i class="fal fa-coins"></i>
            <div class="jb_sid_hdr_li_txt">Buy Crypto</div>
          </div>
          <a href="#" class="jb_sid_hdr_li">
            <i class="fal fa-chart-bar"></i>
            <div class="jb_sid_hdr_li_txt">Trade</div>
          </a>
          <a href="<?php echo base_url();?>report" class="jb_sid_hdr_li">
            <i class="fal fa-id-card"></i>
            <div class="jb_sid_hdr_li_txt">Reports</div>
          </a>
          <a href="<?php echo base_url();?>settings" class="jb_sid_hdr_li">
            <i class="fal fa-cog"></i>
            <div class="jb_sid_hdr_li_txt">Settings</div>
          </a>
          <a href="<?php echo base_url();?>wallet" class="jb_sid_hdr_li">
            <i class="fal fa-wallet"></i>
            <div class="jb_sid_hdr_li_txt">Wallet</div>
          </a>
          <div class="jb_sid_hdr_li jb_sid_hdr_li_subm">
            <i class="fal fa-ellipsis-v-alt"></i>
            <div class="jb_sid_hdr_li_txt">More</div>
            <div class="jb_sid_hdr_li_sub">
              <a href="<?php echo base_url();?>support" class="jb_sid_hdr_li_sub_li">Support</a>
              <a href="<?php echo base_url();?>kyc" class="jb_sid_hdr_li_sub_li">KYC</a>
              <a href="#" class="jb_sid_hdr_li_sub_li">More Menus</a>
              <a href="#" class="jb_sid_hdr_li_sub_li">More Menus</a>
              <a href="#" class="jb_sid_hdr_li_sub_li">More Menus</a>
            </div>
          </div>
        </div>
      </div>
  <?php } ?>
