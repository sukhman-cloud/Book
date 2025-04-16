@extends('link.header')
<div class="sidebar">
    <div class="sidebar-header">
        <a href="dashboard.html" class="sidebar-brandLogo">
            <img src="img/spinning-logo.gif" alt="">
        </a>
    </div>

    <ul class="sidebar-menus" id="sidebarMenu">
        <li class="accordion-item">
            <a href="dashboard.html">
                <i class="material-icons">grid_view</i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="accordion-item">
            <a href="#menu0" data-bs-toggle="collapse" data-bs-target="#menu0" aria-expanded="false"
                aria-controls="menu0" class="collapse-menu">
                <i class="material-icons">inventory</i>
                <span>Library Resources</span>
            </a>

            <div id="menu0" class="accordion-collapse collapse" data-bs-parent="#sidebarMenu">

                <a href="subscription-request.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Allotted Books</span>
                </a>

                <a href="collections.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Books</span>
                </a>

                <a href="approved-subscriptions.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Category</span>
                </a>

                <a href="manage-products.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Subjects</span>
                </a>
            </div>
        </li>

        <li class="accordion-item">
            <a href="#menu2" data-bs-toggle="collapse" data-bs-target="#menu2" aria-expanded="false"
                aria-controls="menu2" class="collapse-menu">
                <i class="material-icons">description</i>
                <span>Academic Details</span>
            </a>

            <div id="menu2" class="accordion-collapse collapse" data-bs-parent="#sidebarMenu">
                <a href="orders-report.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Course</span>
                </a>

                <a href="fulfillments-report.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Semester</span>
                </a>
            </div>
        </li>

        <li class="accordion-item">
            <a href="#menu4" data-bs-toggle="collapse" data-bs-target="#menu4" aria-expanded="false"
                aria-controls="menu4" class="collapse-menu">
                <i class="material-icons">bug_report</i>
                <span>Manage Users</span>
            </a>

            <div id="menu4" class="accordion-collapse collapse" data-bs-parent="#sidebarMenu">

                <a href="daily-monitoring.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Student</span>
                </a>

                <a href="webhooks-logs.html" class="submenu">
                    <i class="material-icons">fiber_manual_record</i>
                    <span>Staff</span>
                </a>
            </div>
        </li>
    </ul>
</div>

<div onclick="removeMenu()" class="sideOverlay"></div>

<header>
    <div class="header-navigation">
        <div class="brandLogo d-lg-none">
            <a href="dashboard.html">
                <img src="img/spinning-logo.gif" alt="">
            </a>
        </div>

        <div class="menu-navigation ">
            <button type="button" class="toggleSwitch" onclick="sidebarSwitch()">
                <span></span>
                <span></span>
                <span></span>
            </button>

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

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="MessageNotifications">
                    <li class="title">Messages</li>
                    <li>
                        <a class="dropdown-item" href="messages.html">
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
                        <a class="dropdown-item" href="messages.html">
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
                        <a class="dropdown-item" href="messages.html">
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
                        <a class="dropdown-item seeAll" href="messages.html">
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
                        <a class="dropdown-item" href="notification.html">
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
                        <a class="dropdown-item" href="notification.html">
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
                        <a class="dropdown-item" href="notification.html">
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
                        <a class="dropdown-item seeAll" href="notification.html">
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
                    <li class="title">Navtej Admin <mailto:span>admin@dnasync.com</span></li>
                    <li>
                        <a class="dropdown-item" href="my-profile.html">
                            <div class="icon-btn green-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="details">
                                <h6>My Profile</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="login.html">
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