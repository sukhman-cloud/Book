<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>

   <!-- Google Icon -->
   <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->

   <!-- Bootstrap -->
   <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> -->

   <!-- custom select -->
   <!-- <link rel="stylesheet" href="css/custom-select.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('css/custom-select.css') }}"> -->

   <!-- dataTable -->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" /> -->

   <!-- our css -->
   <!-- <link rel="stylesheet" href="css/master.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('css/master.css') }}">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> -->

   <!-- script -->
<!-- j query -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->

<!-- Bootstrap -->
<!-- <script src="/js/bootstrap.js"></script> -->
<!-- <script src="{{ asset('js/bootstrap.js') }}"></script> -->

<!-- custom select  -->
<!-- <script src="js/custom-select.min.js"></script>
<script src="js/custom-select.js"></script> -->
<!-- <script src="{{ asset('js/custom-select.min.js') }}"></script>
<script src="{{ asset('js/custom-select.js') }}"></script> -->

<!-- data table  -->
<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script> -->
<!-- <script src="js/dataTable.js"></script> -->
<!-- <script src="{{ asset('js/dataTable.js') }}"></script> -->

<!-- Toggle js  -->
<!-- <script src="js/toggle.js"></script> -->
<!-- <script src="{{ asset('js/toggle.js') }}"></script> -->
</head>
<body>
   <header>
      <div class="header-navigation">
         <div class="brandLogo d-lg-none">
            <a href="#">
               <img src="img/spinning-logo.gif" alt="">
            </a>
         </div>
   
         <div class="menu-navigation ">
            <ul class="menu-items">
               <li class="StoreMenu">
                  <div class="custom-select">
                     <select name="client" class="form-control">
                        <option selected value="Select Store">Select Store</option>
                        <option value="1">Return to admin</option>
                        <option value="2">Hasta Store Dev</option>
                        <option value="3">Survival Store Gurri</option>
                        <option value="4">Street Wear Gurri</option>
                        <option value="5">Liquor Store Gurri</option>
                        <option value="6">Wholesale Survival Store</option>
                        <option value="7">New Street Wear Store</option>
                        <option value="8">Liquor</option>
                     </select>
                  </div>
               </li>
   
               <li class="top-searchBox">
                  <input type="search" class="form-control searchBox" placeholder="Search here">
                  <button class="iconBox">
                     <i class="material-icons">search</i>
                  </button>
               </li>
   
               <li class="dropdown">
                  <a href="javascript:void(0)" class="iconBox d-md-none" type="button">
                     <i class="material-icons">email</i>
                     <span class="noty-counter">2</span>
                  </a>
   
                  <button class="iconBox dropdown-toggle d-none d-md-flex" type="button" data-bs-toggle="dropdown"
                     aria-expanded="false" data-bs-auto-close="outside">
                     <i class="material-icons">email</i>
                     <span class="noty-counter">2</span>
                  </button>
   
                  <ul class="dropdown-menu dropdown-menu-end" id="MessageNotifications" aria-labelledby="MessageNotifications">
                     <li class="title">Messages</li>
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn">
                              <img src="img/profile-icon-2.jpg" alt="">
                           </div>
                           <div class="details">
                              <h6>Mark send you a message</h6>
                              <p> 1 Minutes ago</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn">
                              <img src="img/profile-icon-3.jpg" alt="">
                           </div>
                           <div class="details">
                              <h6>Cregh send you a message</h6>
                              <p>15 Minutes ago</p>
                           </div>
                        </a>
                     </li>
   
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn">
                              <img src="img/profile-icon-4.jpg" alt="">
                           </div>
                           <div class="details">
                              <h6>Profile picture updated</h6>
                              <p>18 Minutes ago</p>
                           </div>
                        </a>
                     </li>
   
   
                     <li>
                        <a class="dropdown-item seeAll" href="#">
                           <div class="icon-btn">
                              <i class="material-icons">east</i>
                           </div>
                           <div class="details">
                              <h6>4 new messages</h6>
                           </div>
                        </a>
                     </li>
                  </ul>
               </li>
   
               <li class="dropdown">
                  <a href="javascript:void(0)" class="iconBox d-md-none" type="button">
                     <i class="material-icons">notifications</i>
                     <span class="noty-counter">5</span>
                  </a>
   
                  <button class="iconBox dropdown-toggle d-none d-md-flex" data-bs-toggle="dropdown" aria-expanded="false"
                     data-bs-auto-close="outside">
                     <i class="material-icons">notifications</i>
                     <span class="noty-counter">5</span>
                  </button>
   
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="Notifications">
                     <li class="title">Notifications</li>
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn">
                              <i class="material-icons">event</i>
                           </div>
                           <div class="details">
                              <h6>Event today</h6>
                              <p> Just a reminder that you have an event today </p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn">
                              <i class="material-icons">settings</i>
                           </div>
                           <div class="details">
                              <h6>Settings</h6>
                              <p> Update dashboard</p>
                           </div>
                        </a>
                     </li>
   
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn">
                              <i class="material-icons">approval</i>
                           </div>
                           <div class="details">
                              <h6>Launch Admin</h6>
                              <p>New admin wow!</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item seeAll" href="#">
                           <div class="icon-btn">
                              <i class="material-icons">east</i>
                           </div>
                           <div class="details">
                              <h6>See all notifications</h6>
                           </div>
                        </a>
                     </li>
                  </ul>
               </li>
   
               <li class="dropdown profile-dropdown">
                  <button class="profileMenu-box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                     data-bs-auto-close="outside">
                     <div class="profile-menu">
                        <img src="img/profile.jpeg" alt="">
                     </div>
                  </button>
   
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="ProfileInfo">
                     <li class="title">Navtej Admin <span>admin@dnasync.com</span></li>
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn green-icon">
                              <i class="material-icons">person</i>
                           </div>
                           <div class="details">
                              <h6>My Profile</h6>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="#">
                           <div class="icon-btn red-icon">
                              <i class="material-icons">power_settings_new</i>
                           </div>
                           <div class="details">
                              <h6>Sign out</h6>
                           </div>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </header>
</body>
</html>