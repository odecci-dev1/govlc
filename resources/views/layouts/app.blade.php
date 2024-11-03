<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gold One Victory Lending</title>  
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    @livewireStyles
</head>

<body> 
    <main>

    <!-- * The styles are in ../res/scss/modules/layout/_nav.scss -->

    <!-- * Main Nav Container -->
    <div class="nav">
        @php 
            $modules = session()->get('auth_usermodules');
            $usertype = session()->get('auth_usertype'); 
            $remittanceonly = session()->get('auth_remittance_only'); 
        @endphp
        <!-- * Nav Container 1 inside main nav-->
        <div class="nav-con-1">
            <!-- * Logo -->
            <img src="{{ URL::to('/') }}/assets/icons/nav-logo.svg" alt="GOVL Logo" />

            <!-- * Nav Links Container -->
            <ul class="nav-links">

                <!-- * Link Wrapper -->
                <!-- * Dashboard -->
                @if($remittanceonly == 0)
                @if(in_array('Module-018', $modules))
                <div class="dropdown" data-dropdown>

                    <a href="{{ URL::to('/') }}/dashboard" class="link " data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/overview.svg" alt="members" data-dropdown-button />
                        <p data-dropdown-button>Overview</p>
                    </a>

                </div>
                @endif
                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Members -->
                @if(in_array('Module-019', $modules))
                <div class="dropdown" data-dropdown>

                    <a href="{{ URL::to('/') }}/members" class="link " data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/members.svg" alt="members" data-dropdown-button />
                        <p data-dropdown-button>Members</p>
                    </a>

                </div>
                @endif
                @endif
                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Maintenance -->
                <div class="dropdown" data-dropdown>

                    @php 
                        $cntmaintenance = array_intersect(['Module-01', 'Module-02', 'Module-03', 'Module-04'],$modules);
                    @endphp
                    @if( count($cntmaintenance) > 0 )
                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/maintenance.svg" alt="maintenance" data-dropdown-button />
                        <p data-dropdown-button>Maintenance</p>
                    </li>
                    @endif

                    <!-- * Submenu -->
                    <ul class="sub-menu">
                        @if(in_array('Module-01', $modules))
                        <a href="{{ URL::to('/') }}/maintenance/fieldofficer/list" data-nav-link>
                            <li>
                                <!-- * Field Officer -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/field-officer.svg" alt="field-officer" />
                                <span>Field Officer</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-02', $modules))
                        <a href="{{ URL::to('/') }}/maintenance/fieldarea" data-nav-link>
                            <li>
                                <!-- * Field Area -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/field-area.svg" alt="field-area" />
                                <span>Field Area</span>
                            </li>
                        </a>
                        @endif
                        
                        @if(in_array('Module-03', $modules))
                        <a href="{{ URL::to('/') }}/maintenance/loantypes/list" data-nav-link>
                            <li>
                                <!-- * Loan Type -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/loan-type.svg" alt="loan-type" />
                                <span>Loan Type</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-04', $modules))
                        <a href="{{ URL::to('/') }}/maintenance/holiday/list" data-nav-link>
                            <li>
                                <!-- * Holidays -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/holidays.svg" alt="loan-type" />
                                <span>Holidays</span>
                            </li>
                        </a>
                        @endif

                    </ul>
                </div>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Collection -->
                @if(in_array('Module-06', $modules))
                <div class="dropdown" data-dropdown>

                    <a href="{{ URL::to('/') }}/collection/list" class="link " data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/collection.svg" alt="collection" data-dropdown-button />
                        <p data-dropdown-button>Collection</p>
                    </a>

                </div>
                @endif
                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Transactions -->
                <div class="dropdown" data-dropdown>

                    @php 
                        $cnttran = array_intersect(['Module-08', 'Module-09', 'Module-010', 'Module-011'],$modules);
                    @endphp
                    @if( count($cnttran) > 0 )
                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/transactions.svg" alt="transactions" data-dropdown-button />
                        <p data-dropdown-button>Transactions</p>
                    </li>
                    @endif

                    <!-- * Submenu -->
                    <ul class="sub-menu">
                        
                        @if(in_array('Module-08', $modules))
                        <a href="{{ URL::to('/') }}/tranactions/application/list" data-nav-link>

                            <li>
                                <!-- * New Application -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/new-application.svg" alt="new-member" />
                                <span>Applications</span>
                            </li>

                        </a>
                        @endif

                        @if(in_array('Module-09', $modules))
                        <a href="{{ URL::to('/') }}/tranactions/application/credit/investigation/list" data-nav-link>
                            <li>
                                <!-- * Credit Investigation  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/credit-investigation.svg" alt="credit-investigation" />
                                <span>Credit Investigation</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-010', $modules))
                        <a href="{{ URL::to('/') }}/tranactions/application/approval/list" data-nav-link>
                            <li>
                                <!-- * Approval  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/approval.svg" alt="approval" />
                                <span>Approval</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-011', $modules))
                        <a href="{{ URL::to('/') }}/tranactions/application/releasing/list" data-nav-link>
                            <li>
                                <!-- * Releasing  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/releasing.svg" alt="releasing" />
                                <span>Releasing</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-012', $modules))
                        <a href="{{ URL::to('/') }}/transactions/loan-calculator/list" data-nav-link>
                            <li>
                                <!-- * Loan Calculator  -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/loan-calc.svg" alt="loan-calculator" />
                                <span>Loan Calculator</span>
                            </li>
                        </a>
                        @endif
                       
                    </ul>
                </div>

                <!-- * Link Wrapper w/ SubMenu -->
                <!-- * Reports -->
                <div class="dropdown" data-dropdown>
                    @php 
                        $cntrep = array_intersect(['Module-013', 'Module-014', 'Module-015', 'Module-016', 'Module-017'],$modules);
                    @endphp
                    @if( count($cntrep) > 0 )
                    <li class="link dropdown" data-dropdown-button>
                        <img src="{{ URL::to('/') }}/assets/icons/reports.svg" alt="reports" data-dropdown-button />
                        <p data-dropdown-button>Reports</p>
                    </li>
                    @endif
                   
                    <!-- * Submenu -->
                    <ul class="sub-menu">
                        @if(in_array('Module-013', $modules))
                        <!-- <a href="{{ URL::to('/') }}/outstanding/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">                            
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/outstanding-report.svg" alt="" />
                                <span>Outstanding Reports</span>
                            </li>
                        </a> -->
                        @endif

                        @if(in_array('Module-014', $modules))
                        <a href="{{ URL::to('/') }}/release/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="outstanding-report" />
                                <span>Release Report</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-015', $modules))
                        <a href="{{ URL::to('/') }}/collection/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Collection Report</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-016', $modules))
                        <a href="{{ URL::to('/') }}/savings/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Savings Report</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-017', $modules))
                        <a href="{{ URL::to('/') }}/pastdue/report" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Past Due Report</span>
                            </li>
                        </a>
                        @endif

                        @if(in_array('Module-019', $modules))
                        <a href="{{ URL::to('/') }}/declined/applications" data-nav-link>
                            <li style="padding: 1.3rem 4rem 1.3rem 2rem;">
                                <!-- * Custom Report -->
                                <img src="{{ URL::to('/') }}/assets/icons/sub-menu/custom-report.svg" alt="custom-report" />
                                <span>Declined Loan Applications</span>
                            </li>
                        </a>
                        @endif

                    </ul>
                </div>

            </ul>
        </div>

        <!-- * Nav Container 2 inside main nav-->
        @if(in_array($usertype, [1]))
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
        @endif
    </div>

    <!-- * Navigation Profile -->
    <div class="profile-nav">
        <!-- <span style="color: white; margin-right: 30px;">{{ session()->get('auth_userid')  }}</span> -->
        <div class="profile-nav-con">
            @php 
                $profilepic = session()->get('auth_profile');
            @endphp
            
            <div style="position: relative;">           
            <img onclick="showNoti()" style="cursor: pointer;" src="{{ URL::to('/') }}/assets/icons/bell.svg" alt="Bell" />
            <span id="noti-count" style="{{ session()->get('noti_count') == '0' || session()->get('noti_count') == '' ? 'display: none' : '' }}">{{ session()->get('noti_count') }}</span>
            </div>
            @if(file_exists(public_path('storage/users_profile/'.$profilepic)))                                  
                <img src="{{ asset('storage/users_profile/'.$profilepic) }}" alt="upload-image" style="height: 5rem; width: 5rem; cursor: pointer;  border-radius: 50%" id="profileImg" onclick="openProfile()"/>                                                                                                                 
            @else
                <img src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" style="height: 5rem; width: 5rem; cursor: pointer;  border-radius: 50%" id="profileImg" onclick="openProfile()"/>                                               
            @endif  
            <!-- <img style="cursor: pointer;" id="profileImg" onclick="openProfile()" src="{{ URL::to('/') }}/assets/icons/profile.svg" alt="Profile" /> -->
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
    <div class='div-noti hide-me' id='div-noti'></div>
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
        window.showNoti = function(){      
            
            var elementExists = document.getElementById("div-noti");    
            if(elementExists.classList.contains('hide-me')){
                elementExists.classList.remove('hide-me');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            elementExists.innerHTML = this.responseText;                   
                        }
                }
                xmlhttp.open("GET", "{{ URL::to('/getnoti') }}", true);
                xmlhttp.send();
            }
            else{
                elementExists.classList.add('hide-me');
                const notielement = document.getElementById("div-noti-container");
                notielement.remove();
                //elementExists.innerHTML = "";  
            }
           

            // if(typeof(elementExists) != 'undefined' && elementExists != null){                
            //     elementExists.remove();
            // }
            // else{
            //     document.body.innerHTML += "";
            //     var xmlhttp = new XMLHttpRequest();
            //     xmlhttp.onreadystatechange = function() {
            //         if (this.readyState == 4 && this.status == 200) {
            //             document.getElementById("div-noti").innerHTML = this.responseText;                   
            //         }
            //     }
            //     xmlhttp.open("GET", "{{ URL::to('/getnoti') }}", true);
            //     xmlhttp.send();
            // }
        }
    
        var intervalId = window.setInterval(function(){
            //  
            var notihttp = new XMLHttpRequest();
            notihttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if( this.responseText == 0 || this.responseText == '' ){
                        document.getElementById("noti-count").style.visibility = 'hidden';    
                    }
                    else{
                        document.getElementById("noti-count").innerHTML = this.responseText; 
                        document.getElementById("noti-count").style.visibility = 'visible';       
                    }                  
                }
            }
            notihttp.open("GET", "{{ URL::to('/getnoticount') }}", true);
            notihttp.send();
        }, 5000);
        
                
    </script>
    </main>
    @livewireScripts  
</body>

</html>