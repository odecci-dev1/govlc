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
        <!-- The styles are in ../layout/_nav.scss -->

        <!-- Main Nav Container -->
        <div class="nav">

            <!-- Nav Container 1 inside main nav-->
            <div class="nav-con-1">

                <!-- Logo -->
              
                <img src="{{ URL::to('/') }}/assets/icons/nav-logo.svg" alt="GOVL Logo" />
                
                <!-- Nav Links Container -->
                <ul class="nav-links">

                    <!-- Link Wrapper -->
                    <!-- Overview -->
                    <li class="link" no-data-dropdown>
                        <img src="{{ URL::to('/') }}/assets/icons/overview.svg" alt="overview" />
                        <p>Overview</p>
                    </li>

                    <!-- Link Wrapper w/ SubMenu -->
                    <!-- Members -->
                    <div class="dropdown" data-dropdown>
                        <li class="link dropdown" data-dropdown-button>
                            <img src="{{ URL::to('/') }}/assets/icons/members.svg" alt="members" data-dropdown-button/>
                            <p data-dropdown-button>Members</p>
                        </li>

                        <!-- Submenu -->
                        <ul class="sub-menu">
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/all-members.svg" alt="all-members" />
                                <span>All Members</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/new-member.svg" alt="new-member" />
                                <span>New Member</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Link Wrapper w/ SubMenu -->
                    <!-- Maintenance -->
                    <div class="dropdown" data-dropdown>
                        <li class="link dropdown" data-dropdown-button>
                            <img src="{{ URL::to('/') }}/assets/icons/maintenance.svg" alt="maintenance" data-dropdown-button/>
                            <p data-dropdown-button>Maintenance</p>
                        </li>

                        <!-- Submenu -->
                        <ul class="sub-menu">
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/co-maker.svg" alt="co-maker" />
                                <span>Co Maker</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/field-officer.svg" alt="field-officer" />
                                <span>Field Officer</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/field-area.svg" alt="field-area" />
                                <span>Field Area</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/loan-type.svg" alt="loan-type" />
                                <span>Loan Type</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Link Wrapper w/ SubMenu -->
                    <!-- Collection -->
                    <div class="dropdown" data-dropdown>
                        <li class="link dropdown" data-dropdown-button>
                            <img src="{{ URL::to('/') }}/assets/icons/collection.svg" alt="collection" data-dropdown-button/>
                            <p data-dropdown-button>Collection</p>
                        </li>

                        <!-- Submenu -->
                        <ul class="sub-menu">
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/collection.svg" alt="collection" />
                                <span>Collection</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/areas.svg" alt="areas" />
                                <span>Areas</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Link Wrapper w/ SubMenu -->
                    <!-- Transactions -->
                    <div class="dropdown" data-dropdown>
                        <li class="link dropdown" data-dropdown-button>
                            <img src="{{ URL::to('/') }}/assets/icons/transactions.svg" alt="transactions" data-dropdown-button/>
                            <p data-dropdown-button>Transactions</p>
                        </li>

                        <!-- Submenu -->
                        <ul class="sub-menu">
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/new-application.svg" alt="new-member" />
                                <span>New Application</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/credit-investigation.svg" alt="credit-investigation" />
                                <span>Credit Investigation </span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/remittance.svg" alt="remittance" />
                                <span>Remittance</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/approval.svg" alt="approval" />
                                <span>Approval</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/releasing.svg" alt="releasing" />
                                <span>Releasing</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/loan-calc.svg" alt="loan-calc" />
                                <span>Loan Calculator</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Link Wrapper w/ SubMenu -->
                    <!-- Reports -->
                    <div class="dropdown" data-dropdown>
                        <li class="link dropdown" data-dropdown-button>
                            <img src="{{ URL::to('/') }}/assets/icons/reports.svg" alt="reports" data-dropdown-button/>
                            <p data-dropdown-button>Reports</p>
                        </li>

                        <!-- Submenu -->
                        <ul class="sub-menu">
                            <li>
                                <img src="{{ URL::to('/') }}/assets/assets/icons/sub-menu/outstanding-report.svg" alt="" />
                                <span>Outstanding Reports</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="outstanding-report" />
                                <span>Custom Report</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Custom Report</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Custom Report</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Custom Report</span>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>

            <!-- Nav Container 2 inside main nav-->
            <div class="nav-con-2">

                <!-- Nav Links Container -->
                <ul class="nav-links">

                    <!-- Link Wrapper -->
                    <li class="link" no-data-dropdown>
                        <img src="{{ URL::to('/') }}/assets/icons/settings.svg" alt="settings" />
                        <p>Settings</p>
                    </li>
                </ul>

            </div>

        </div>

        <div class="profile-nav">
            <div class="profile-nav-con">
                <img src="{{ URL::to('/') }}/assets/icons/bell.svg" alt="Bell">
                <img src="{{ URL::to('/') }}/assets/icons/profile.svg" alt="Profile">
            </div>
        </div>

        <div class="main-dashboard">
            @yield('content')
            {{ $slot }}
        </div>

    </main>   
    @livewireScripts  
</body>

</html>