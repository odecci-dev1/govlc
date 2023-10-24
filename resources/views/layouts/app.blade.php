<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gold One Victory Lending</title>  
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    @livewireStyles
</head>

<body> 
    <main>

    <!-- * The styles are in ../res/scss/modules/layout/_nav.scss -->

    <!-- * Main Nav Container -->
    <div class="nav">
        <!-- * Nav Container 1 inside main nav-->
        <div class="nav-con-1">
            <!-- * Logo -->
            <img src="{{ URL::to('/') }}/assets/icons/nav-logo.svg" alt="GOVL Logo" />

            <!-- * Nav Links Container -->
            <ul class="nav-links">

                <!-- * Link Wrapper -->
                <!-- * Dashboard -->
                <div class="dropdown" data-dropdown>

                    <a href="{{ URL::to('/') }}/dashboard" class="link " data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/overview.svg" alt="members" data-dropdown-button />
                        <p data-dropdown-button>Overview</p>
                    </a>

                </div>
               
                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Members -->
                <div class="dropdown" data-dropdown>

                    <a href="{{ URL::to('/') }}/members" class="link " data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/members.svg" alt="members" data-dropdown-button />
                        <p data-dropdown-button>Members</p>
                    </a>

                </div>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Maintenance -->
                <div class="dropdown" data-dropdown>

                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/maintenance.svg" alt="maintenance" data-dropdown-button />
                        <p data-dropdown-button>Maintenance</p>
                    </li>

                    <!-- * Submenu -->
                    <ul class="sub-menu">

                        <!-- <a href="../KC/co-maker.html" data-nav-link>
                            <li> -->
                        <!-- * Co Maker -->
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/sub-menu/co-maker.svg" alt="co-maker" />
                                <span>Co Maker</span>
                            </li>
                        </a> -->

                        <a href="{{ URL::to('/') }}/maintenance/fieldofficer/list" data-nav-link>
                            <li>
                                <!-- * Field Officer -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/field-officer.svg" alt="field-officer" />
                                <span>Field Officer</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/maintenance/fieldarea" data-nav-link>
                            <li>
                                <!-- * Field Area -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/field-area.svg" alt="field-area" />
                                <span>Field Area</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/maintenance/loantypes/list" data-nav-link>
                            <li>
                                <!-- * Loan Type -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/loan-type.svg" alt="loan-type" />
                                <span>Loan Type</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/maintenance/holiday/list" data-nav-link>
                            <li>
                                <!-- * Holidays -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/holidays.svg" alt="loan-type" />
                                <span>Holidays</span>
                            </li>
                        </a>

                    </ul>
                </div>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Collection -->
                <div class="dropdown" data-dropdown>

                    <a href="{{ URL::to('/') }}/collection/list" class="link " data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/collection.svg" alt="collection" data-dropdown-button />
                        <p data-dropdown-button>Collection</p>
                    </a>

                </div>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Transactions -->
                <div class="dropdown" data-dropdown>

                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/transactions.svg" alt="transactions" data-dropdown-button />
                        <p data-dropdown-button>Transactions</p>
                    </li>

                    <!-- * Submenu -->
                    <ul class="sub-menu">
                        
                        <a href="{{ URL::to('/') }}/tranactions/application/list" data-nav-link>

                            <li>
                                <!-- * New Application -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/new-application.svg" alt="new-member" />
                                <span>Applications</span>
                            </li>

                        </a>

                        <a href="{{ URL::to('/') }}/tranactions/application/credit/investigation/list" data-nav-link>
                            <li>
                                <!-- * Credit Investigation  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/credit-investigation.svg" alt="credit-investigation" />
                                <span>Credit Investigation</span>
                            </li>
                        </a>

                       
                        <a href="{{ URL::to('/') }}/tranactions/application/approval/list" data-nav-link>
                            <li>
                                <!-- * Approval  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/approval.svg" alt="approval" />
                                <span>Approval</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/tranactions/application/releasing/list" data-nav-link>
                            <li>
                                <!-- * Releasing  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/releasing.svg" alt="releasing" />
                                <span>Releasing</span>
                            </li>
                        </a>
                       
                    </ul>
                </div>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Reports -->
                <div class="dropdown" data-dropdown>

                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/reports.svg" alt="reports" data-dropdown-button />
                        <p data-dropdown-button>Reports</p>
                    </li>

                    <!-- * Submenu -->
                    <ul class="sub-menu">

                        <a href="{{ URL::to('/') }}/outstanding/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Outstanding Reports -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/outstanding-report.svg" alt="" />
                                <span>Outstanding Reports</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/release/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="outstanding-report" />
                                <span>Release Report</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/collection/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Collection Report</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/savings/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Savings Report</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/pastdue/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Past Due Report</span>
                            </li>
                        </a>

                    </ul>
                </div>

            </ul>
        </div>

        <!-- * Nav Container 2 inside main nav-->
        <div class="nav-con-2">

            <!-- * Nav Links Container -->
            
            <ul class="nav-links">
                <!-- * Link Wrapper -->                  
                <a href="{{ URL::to('/') }}/users" class="link" no-data-dropdown>
                    <img src="{{ URL::to('/') }}/assets/icons/user.svg" alt="user" />
                    <p>User</p>
                </a>
                <!-- * Link Wrapper -->
                <a href="{{ URL::to('/') }}/settings" class="link" no-data-dropdown>
                    <img src="{{ URL::to('/') }}/assets/icons/settings.svg" alt="settings" />
                    <p>Settings</p>
                </a>
            </ul>
        </div>
    </div>

    <!-- * Navigation Profile -->
    <div class="profile-nav">
        <div class="profile-nav-con">
            <img style="cursor: pointer;" src="{{ URL::to('/') }}/assets/icons/bell.svg" alt="Bell" />
            <img style="cursor: pointer;" id="profileImg" onclick="openProfile()" src="{{ URL::to('/') }}/assets/icons/profile.svg" alt="Profile" />
        </div>
      
    </div>

    <div class="profileLink hide-me" id="profileLink">
        <div onclick="location.href='{{ URL::to('/') }}/profile'">
            Profile
        </div>
        <div onclick="location.href='{{ URL::to('/') }}/logout'">
            Log Out
        </div>
    </div>

    <!-- modals -->    
    <!-- modals -->
    
    <!-- * Main Dashboard -->
    <div class="main-dashboard">  
    {{ $slot }}  
    </div>
    <script>         
        window.openProfile = function($cnt){                    
            const profileImg = document.getElementById("profileImg");
            const profileLink = document.getElementById("profileLink");
            if(profileLink.classList.contains("hide-me")){
                profileLink.classList.remove("hide-me");               
            }
            else{
                profileLink.classList.add("hide-me");     
            }          
        };   
    </script>
    </main>
    @livewireScripts  
</body>

</html>