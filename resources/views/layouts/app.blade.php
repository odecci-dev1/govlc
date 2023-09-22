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
                <a href="../KC/dashboard.html" data-nav-link>
                    <li class="link" no-data-dropdown>
                        <!-- * Overview -->
                        <img src="{{ URL::to('/') }}/assets/icons/overview.svg" alt="overview" />
                        <p>Overview</p>
                    </li>
                </a>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Members -->
                <div class="dropdown" data-dropdown>

                    <li class="link dropdown" data-dropdown-button>
                        <!-- * Members -->
                        <img src="{{ URL::to('/') }}/assets/icons/members.svg" alt="members" data-dropdown-button />
                        <p data-dropdown-button>Members</p>
                    </li>

                    <!-- * Submenu -->
                    <ul class="sub-menu">

                        <a href="{{ URL::to('/') }}/members" data-nav-link>
                            <li>
                                <!-- * All Members -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/all-members.svg" alt="all-members" />
                                <span>All Members</span>
                            </li>
                        </a>

                        <!-- 
                        <a href="../KC/new-member.html" data-nav-link>
                            <li> -->
                        <!-- * New Member -->
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/sub-menu/new-member.svg" alt="new-member" />
                                <span>New Member</span>
                            </li>
                        </a> -->

                    </ul>
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

                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/collection.svg" alt="collection" data-dropdown-button />
                        <p data-dropdown-button>Collection</p>
                    </li>

                    <!-- * Submenu -->
                    <ul class="sub-menu">

                        <a href="../KC/collection.html" data-nav-link>
                            <li>
                                <!-- * Collection -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/collection.svg" alt="collection" />
                                <span>Collection</span>
                            </li>
                        </a>

                        <a href="../KC/areas.html" data-nav-link>
                            <li>
                                <!-- * Areas -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/areas.svg" alt="areas" />
                                <span>Areas</span>
                            </li>
                        </a>

                    </ul>
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

                        <a href="../KC/remittance.html" data-nav-link>
                            <li>
                                <!-- * Remittance  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/remittance.svg" alt="remittance" />
                                <span>Remittance</span>
                            </li>
                        </a>

                        <a href="{{ URL::to('/') }}/tranactions/application/approval" data-nav-link>
                            <li>
                                <!-- * Approval  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/approval.svg" alt="approval" />
                                <span>Approval</span>
                            </li>
                        </a>

                        <a href="../KC/releasing.html" data-nav-link>
                            <li>
                                <!-- * Releasing  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/releasing.svg" alt="releasing" />
                                <span>Releasing</span>
                            </li>
                        </a>

                        <a href="../KC/loan-calculator.html" data-nav-link>
                            <li>
                                <!-- * Loan Calculator  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/loan-calc.svg" alt="loan-calc" />
                                <span>Loan Calculator</span>
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

                        <a href="../KC/outstanding-report.html" data-nav-link>
                            <li>
                                <!-- * Outstanding Reports -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/outstanding-report.svg" alt="" />
                                <span>Outstanding Reports</span>
                            </li>
                        </a>

                        <a href="../KC/custom-report.html" data-nav-link>
                            <li>
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="outstanding-report" />
                                <span>Custom Report</span>
                            </li>
                        </a>

                        <a href="../KC/custom-report.html" data-nav-link>
                            <li>
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Custom Report</span>
                            </li>
                        </a>

                        <a href="../KC/custom-report.html" data-nav-link>
                            <li>
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Custom Report</span>
                            </li>
                        </a>

                        <a href="../KC/custom-report.html" data-nav-link>
                            <li>
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Custom Report</span>
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
                <a href="#" class="link" no-data-dropdown>
                    <img src="{{ URL::to('/') }}/assets/icons/settings.svg" alt="settings" />
                    <p>Settings</p>
                </a>
            </ul>
        </div>
    </div>

    <!-- * Navigation Profile -->
    <div class="profile-nav">
        <div class="profile-nav-con">
            <img src="{{ URL::to('/') }}/assets/icons/bell.svg" alt="Bell" />
            <img src="{{ URL::to('/') }}/assets/icons/profile.svg" alt="Profile" />
        </div>
    </div>

    <!-- modals -->    
    <!-- modals -->
    
    <!-- * Main Dashboard -->
    <div class="main-dashboard">  
    {{ $slot }}  
    </div>

    </main>
    @livewireScripts  
</body>

</html>