<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/todo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:18:16 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Iwiki - Todo list</title>


  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/vendors/sweetalert.css">
  <link rel="stylesheet" href="css/vendors/loading.css">



    <link rel="stylesheet" href="css/vendors/input.css">
    <link rel="stylesheet" href="css/vendors/checkboxes.css">

  <link rel="stylesheet" href="css/main.css">
  <script src="js/modernizr.js"></script>

  <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

  <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.src.js"></script>
  <![endif]-->
</head>


<body>
    <div id="wrap-content" class="wrap-content">

        <div class="preloader">
  <div class="preloader-anim la-animate"></div>
  <div class="loading-anim">Loading</div>
</div>
<div class="aside">
  <a href="index.html" class="btn-logo"></a>
  <span class="menu-btn-open" id="menu-btn-open">Menu</span>
  <span class="toggle-fixed fa fa-thumb-tack" data-toggle="tooltip" data-placement="top" title="Fixed top"></span>
</div>
<div class="header">
  <div class="unit title">
    <h5 class="primary font-weight-700">Todo list</h5>
    <h6 class="secondary">Todo list</h6>
  </div>
  <div class="unit morphsearch" id="morphsearch">
    <form class="morphsearch-form">
      <input class="morphsearch-input" type="search" placeholder="Search..." />
      <button class="morphsearch-submit" type="submit">Search</button>
    </form>
    <div class="morphsearch-content">
      <div class="dummy-column">
        <h2>People</h2>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Sara Soueidan" />
          <h3>Sara Soueidan</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Sara Soueidan" />
          <h3>Rachel Smith</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Peter Finlan" />
          <h3>Peter Finlan</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Patrick Cox" />
          <h3>Patrick Cox</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Tim Holman" />
          <h3>Tim Holman</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Shaun Dona" />
          <h3>Shaun Dona</h3>
        </a>
      </div>
      <div class="dummy-column">
        <h2>Popular</h2>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="PagePreloadingEffect" />
          <h3>Page Preloading Effect</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="ArrowNavigationStyles" />
          <h3>Arrow Navigation Styles</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="HoverEffectsIdeasNew" />
          <h3>Ideas for Subtle Hover Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="FreebieHalcyonDays" />
          <h3>Halcyon Days Template</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="ArticleIntroEffects" />
          <h3>Inspiration for Article Intro Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="DraggableDualViewSlideshow" />
          <h3>Draggable Dual-View Slideshow</h3>
        </a>
      </div>
      <div class="dummy-column">
        <h2>Recent</h2>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="TooltipStylesInspiration" />
          <h3>Tooltip Styles Inspiration</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="AnimatedHeaderBackgrounds" />
          <h3>Animated Background Headers</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="OffCanvas" />
          <h3>Off-Canvas Menu Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="TabStyles" />
          <h3>Tab Styles Inspiration</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="ResponsiveSVGs" />
          <h3>Make SVGs Responsive with CSS</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="NotificationStyles" />
          <h3>Notification Styles Inspiration</h3>
        </a>
      </div>
    </div>
    <span class="morphsearch-close"><svg><use xlink:href="#icon-close"></use></svg></span>
  </div>
  <div class="unit email">
    <span class="btn-email" id="email-btn"><span class="notification-count">6</span></span>
    <div class="mail-content" id="email-content">
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60-2.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60-3.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60-4.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="email-list.html" class="show-all btn btn-danger">Show all mails</a>
    </div>
  </div>
  <div class="unit message">
    <span class="btn-message" id="message-btn"><span class="notification-count">4</span></span>
    <div class="message-content" id="message-content">
      <div class="percent">
        <div class="percent-title">Database Repair</div>
        <div class="percent-mark">70%</div>
        <div class="percent-value color-1" style="width: 70%;"></div>
      </div>
      <div class="percent">
        <div class="percent-title">Database Repair</div>
        <div class="percent-mark">10%</div>
        <div class="percent-value color-2" style="width: 10%;"></div>
      </div>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-android"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-album"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-science"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-box"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="clear-all btn btn-danger">Clear all</a>

      <div class="check-ok">
        <i class="fa fa-check-circle"></i>
        <br>
        <span class="text-uppercase">Empty</span>
      </div>
    </div>
  </div>
  <div class="unit backet user">
    <span class="user-btn" id="user-btn"><i class="fa fa-user"></i></span>
    <div class="user-content" id="user-content">
        <img src="img/images/profile/64.png" alt="image" class="b-profile-avatar" />
        <div class="b-profile-name">
          Alexander Van Gok
        </div>
        <div class="b-profile-profession">
          Web Designer
        </div>
        <ul class="b-profile-folders">
          <li><a href="#">Messages <span class="badge badge-success pull-right">25</span></a></li>
          <li><a href="#">Photos <span class="badge badge-success pull-right">2</span></a></li>
          <li><a href="#">Posts <span class="badge badge-primary badge-round pull-right">6</span></a></li>
        </ul>
        <a href="profile.html" class="view-profile btn btn-danger">View profile</a>

    </div>
  </div>
</div>



         <div class="content container-fluid">
         <div class="row row-broken">
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li class="active">Todo list</li>
              </ol>
            </div>
          </div>
          <div class="row decor-default" style="backgound-color:#c1c9e3">
            <div class="col-lg-12">
                    <div class="">
                        
						
						<span class="input__label-content input__label-content--kaede">
						
						Your Complaint has been successfully registered. To Refer to your complaint you can Find the status in the <a href="complaint-status.php">Complaint Status Tab</a>
						
						</span>
						<span class="">
						
						</span>
                    </div>
              
            </div>
          </div>
        </div>
        <div class="footer">
            © 2015 Copyright.
        </div>
    </div>


  <div id="wrap-menu" class="wrap-menu">
  <span id="menu-btn-close" class="menu-btn-close">
          <svg><use xlink:href="#icon-close"></use></svg>
        </span>
  <h1 class="menu-title">Navigation</h1>
  <ul id="menu" class="menu">
    <li id="menu-btn-back" class="back">
      <span>Back</span>
    </li>
    <li>
        <i class="fa fa-bars more"></i>
       <i class="fa fa-globe"></i>
      <span>Dashboards</span>
      <ul class="menu">
        <li><i class="fa fa-hashtag"></i><a href="index.html">Dashboard v1</a></li>
        <li><i class="fa fa-cube"></i><a href="dashboard2.html">Dashboard v2</a></li>
      </ul>
    </li>
    <li>
       <i class="fa fa-bars more"></i>
       <i class="fa fa-th"></i>
      <span>Colors</span>
      <ul class="menu">
        <li><i class="fa fa-desktop"></i><a href="index.html">Default Skin</a></li>
        <li><i class="fa fa-laptop"></i><a href="index-light.html">Light Skin</a></li>
        <li><i class="fa fa-life-ring"></i><a href="index-dark.html">Dark Skin</a></li>
        <li><i class="fa fa-image"></i><a href="index-dim.html">Dim Skin</a></li>
      </ul>
    </li>
    <li>
     <i class="fa fa-bars more"></i>
     <i class="fa fa-envelope-o"></i>
      <span>Mailbox</span>
      <ul class="menu">
        <li><i class="fa fa-list-ul"></i><a href="email-list.html">Email list</a></li>
        <li><i class="fa fa-inbox"></i><a href="email-inbox.html">Email inbox</a></li>
        <li><i class="fa fa-paper-plane-o"></i><a href="email-send.html">Email send</a></li>
      </ul>
    </li>
    <li>
       <i class="fa fa-bars more"></i>
       <i class="fa fa-server"></i>
      <span>Contacts</span>
      <ul class="menu">
        <li><i class="fa fa-mobile"></i><a href="contacts.html">Contact list</a></li>
        <li><i class="fa fa-phone"></i><a href="contact.html">Contact preview</a></li>
      </ul>
    </li>
    <li>
        <i class="fa fa-calendar"></i>
        <a href="calendar.html">Calendar</a>
    </li>
    <li>
      <i class="fa fa-th-list"></i>
      <a href="widgets.html">Widgets</a>
    </li>
    <li>
     <i class="fa fa-bars more"></i>
     <i class="fa fa-desktop"></i>
      <span>Ui Kits</span>
      <ul class="menu">
        <li><i class="fa fa-font"></i><a href="typography.html">Typography</a></li>
        <li><i class="fa fa-code"></i><a href="grid.html">Grid Options</a></li>
        <li><i class="fa fa-briefcase"></i><a href="buttons.html">Buttons</a></li>
        <li><i class="fa fa-check-circle-o"></i><a href="checkboxes.html">Checkboxes</a></li>
        <li><i class="fa fa-bell"></i><a href="notification.html">Notifications</a></li>
        <li><i class="fa fa-keyboard-o"></i><a href="input.html">Input Fields</a></li>
        <li><i class="fa fa-spinner"></i><a href="loading.html">Loading effect</a></li>
        <li><i class="fa fa-diamond"></i><a href="dialogs.html">Dialogs</a></li>
      </ul>
    </li>

    <li>
     <i class="fa fa-edit"></i>
      <a href="charts.html">Charts</a>
    </li>
    <li>
     <i class="fa fa-sliders"></i>
     <a href="filter.html">Filter & Cart</a>
    </li>
    <li>
      <i class="fa fa-list-alt"></i>
      <a href="todo.html">Todo list</a>
    </li>
    <li>
      <i class="fa fa-user"></i>
      <a href="profile.html">User profile</a>
    </li>
    <li>
     <i class="fa fa-bars more"></i>
     <i class="fa fa-file"></i>
      <span>Other pages</span>
      <ul class="menu">
        <li><i class="fa fa-magic"></i><a href="wizard.html">Wizards</a></li>
        <li><i class="fa fa-crop"></i><a href="crop.html">Crop</a></li>
        <li><i class="fa fa-picture-o"></i><a href="gallery.html">Gallery</a></li>
        <li><i class="fa fa-camera-retro"></i><a href="slider.html">Sliders</a></li>
        <li><i class="fa fa-comment"></i><a href="chat.html">Chat</a></li>
        <li><i class="fa fa-clock-o"></i><a href="timeline.html">Timeline</a></li>
        <li><i class="fa fa-book"></i><a href="register.html">Register</a></li>
        <li><i class="fa fa-sign-in"></i><a href="login.html">Log in</a></li>
        <li><i class="fa fa-unlock-alt"></i><a href="lostpassword.html">Recovery password</a></li>
        <li><i class="fa fa-cogs"></i><a href="403.html">403 error</a></li>
        <li><i class="fa fa-share-alt"></i><a href="404.html">404 error</a></li>
        <li><i class="fa fa-recycle"></i><a href="500.html">500 error</a></li>
      </ul>
    </li>
  </ul>
</div>

<div id="overlay" class="overlay"></div>

<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28 28" style="display: none;" xml:space="preserve">
  <g id="icon-close">
    <line x1="2" y1="2" x2="26" y2="26" />
    <line x1="2" y1="26" x2="26" y2="2" />
  </g>
</svg>


      <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/ui.js"></script>
    <script src="js/search.js"></script>
    <script src="js/sweetalert.min.js"></script>



    <script src="js/checkboxes.js"></script>
    <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    </script>

</body>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/todo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:18:16 GMT -->
</html>

