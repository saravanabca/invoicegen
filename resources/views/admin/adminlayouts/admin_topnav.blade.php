<!-- ======= Header ======= -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
  .header{
    background: #012970 !important;
    color: #ffffff;
    height: 65px;
  }
  .header[data-background-color=blue2] {
    background: #ffffff !important
  }
  .bi-list::before {
    content: "\f479";
    color: black;
  }
  .header-nav .nav-profile span{
    color: white;
  }
  .logo span{
    color: #000000d4;
    font-size: 21px !important;
    letter-spacing: 3px;
    text-transform: uppercase;
  }

  .icon-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    background: #ffffff;
    color: black;
    border: none;
    outline: none;
    border-radius: 50%;
    padding-right: 24px !important;
  }

  .icon-button:hover {
    cursor: pointer;
  }

  .icon-button:active {
    background: #012970;
    color: #ffffff;
  }

  .icon-button__badge {
    height: 20px;
    line-height: 16px;
    font-size: 10px;
    font-weight: 700;
    border: 2px solid #fff;
    padding: 0 2px;
    position: absolute;
    top: -4px;
    right: 4px;
    background: #ff002a;
    color: white;
    border-radius: 4px;
    transform: scale(1.1);
    /* position: absolute;
    top: -3px;
    right: -2px;
    width: 15px;
    height: 15px;
    background: red;
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%; */
  }
  .back-to-top {
    background: #b72828 !important;
  }
</style>

<header id="header" class="header fixed-top d-flex align-items-center" data-background-color=blue2>

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{url('dashboard')}}" class="logo d-flex align-items-center">
      {{-- <span class="me-1"> <img src="{{asset('assets/img/skyraan-technologies.avif')}}"> </span> --}}
      <span class="d-none d-lg-block">Invoice Generator</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
        
      <li class="nav-item dropdown pe-3" style="display: flex;flex-direction: row;">
      
        <style>
          .notificationsPreview {
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.5);
            text-align: left;
            position: absolute;
            width: 320px;
            top: 45px;
            right: 175px;
            border-radius: 1px;
            background-color: #FFFFFF;
          }
          .notificationsPreview:before {
            content: "";
            background-color: #FFFFFF;
            position: absolute;
            height: 20px;
            width: 20px;
            right: 58px;
            top: -10px;
            transform: rotateZ(45deg);
            box-shadow: -1px -1px 0px 0 rgba(0, 0, 0, 0.05);
          }
          #notificationsWrapper {
            width: 100%;
            overflow-y: auto !important;
            overflow-x: hidden !important;
          }
          .notificationsWrapper {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
          }
          .no-notif {
            text-align: center;
            font-size: 13px;
            margin-top: 20px;
          }
          .alt-loader {
              height: 300px;
          }
          .hide {
            display: none;
          }
          .text-left {
            text-align: left!important;
          }
          .ft-14 {
            font-size: 14px;
          }
          .semibold {
            font-weight: 600;
          }
          .text-muted {
            color: #636c72!important;
          }
          .p-3 {
            padding: 1rem 1rem!important;
          }
        </style>


 
          {{-- <button type="button" class="icon-button" id="toggleButton">
            <span class="material-icons">notifications</span>
            <span class="icon-button__badge">{{count($ContactSList)}}</span>
          </button> --}}
    
        {{-- <div class="notificationsPreview hide" id="notificationPanel">
          <div class="row text-left p-3">
            <div class="col-6">
                <h4 class="semibold float-left text-muted" style="font-size: 19px;">Notifications</h4>
            </div>
            <div class="col-6 text-end">
                <span class="ft-14 text-muted semibold notification-count-container">{{count($ContactSList)}}</span>
            </div>
          </div>
        
          
            
           
        </div> --}}


        

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          {{-- {{$formattedDateTime}}
          <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::guard('admin')->user()->name}}</span> --}}
          <div>
            {{-- <span class="d-none d-md-block ps-2" style="font-size: 18px; color: #ffffff; font-weight: bold;">{{ $formattedDateTime }} </span> --}}
            {{-- <br> --}}
            <span class=""></span>
            {{-- {{ Auth::guard('webadmin')->user()->name }} --}}
          </div>
          <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle d-none d-md-block dropdown-toggle"> 
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header"> 
             
            {{-- <img src="" alt="Profile" class="rounded-circle" style="height:30% !important;width:30% !important;"> --}}
           
             
          
            <h6 style="color: #fffff"></h6>
            {{-- {{ Auth::guard('webadmin')->user()->name }} --}}
            <span></span>
          </li>
       
        
          <li>
            <form id="submit_logout" action="{{url('admin_logout')}}" >
              <button class="dropdown-item d-flex align-items-center" type="button" onclick="addClass()">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </form>
          </li>

        </ul>

      </li>

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->


<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    // Get the button and panel elements
    var toggleButton = document.getElementById('toggleButton');
    var notificationPanel = document.getElementById('notificationPanel');
    var alt_loader = document.getElementById('alt-loader');
    var notification_id = document.getElementById('notification_id');

    // Check if elements exist before adding event listener
    if (toggleButton && notificationPanel) {
      // Toggle the visibility of the notification panel
      toggleButton.addEventListener('click', function() {
        if (notificationPanel.classList.contains('hide')) {
          notificationPanel.classList.remove('hide');
          alt_loader.classList.remove('hide');
          setTimeout(() => {
            alt_loader.classList.add('hide');
            notification_id.classList.remove('hide');
            notification_id.classList.add('show');
          }, 1000);
        } else {
          notificationPanel.classList.add('hide');
          alt_loader.classList.add('hide');
          notification_id.classList.add('hide');
        }
      });
    }
  });
  
  function addClass() {
    var element = document.getElementById("pre-loader");

    // Add your desired class name
    var classNameToAdd = "is-active";

    // Check if the class is not already present
    if (!element.classList.contains(classNameToAdd)) {
      // Add the class// Remove the 'is-active' class
      document.getElementById('pre-loader').classList.remove('active-is');
      document.getElementById('pre-loader').classList.add('is-active');
      document.getElementById('submit_logout').submit();

    }
  } 

  function redirectToLink(url) {
    window.location.href = url;
  }
</script>