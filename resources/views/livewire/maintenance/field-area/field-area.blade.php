<div>
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to trash this data '" :xmid="$mid" :confirmaction="'archive'" :header="'Trash'"></x-dialog>   
    @endif
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
        <!-- * Field Area Maintenance -->
        <form class="fa-form-con" id="field-area-maintenance-form" autocomplete="off">

        <!-- * Field Area Maintenance -->
        <div class="fa-container-wrapper">

            <!-- * Container 1: New Member Form Fields and Buttons -->
            <div class="fa-container-1">

                <!-- * Vertical Container -->
                <div class="verti-con">

                    <!-- * Form Header -->

                    <!-- * Rowspan 1: Header -->
                    <div class="rowspan">

                        <h2>Field Area Maintenance</h2>
                        <p>Last Updated:
                            <span id="faUpdateDate"> 05/26/2022</span>,
                            <span id="faUpdateDay"> Thursday</span> at
                            <span id="faUpdateTime"> 9:45 AM</span> by
                            <span id="faUpdateUser"> Admin</span>
                        </p>

                    </div>

                    <!-- * Rowspan 2: Area Name, Location and Search Bar -->
                    <div class="rowspan">

                        <!-- * Area Name -->
                        <div class="input-wrapper">
                            <span>Area Name</span>
                            <input autocomplete="off" wire:model.lazy="areaName">
                            @error('areaName') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Location -->
                        <div class="input-wrapper">                           
                            <span>Location</span>
                            <div class="locations-container">
                                <div class="chip-container" id="mLocationContainer">
                                    <!-- <span class="tb-chip" data-tb-chip=""><span wire:click="removeSelUnassigned('')" class="tb-chips-w-x"></span></span>                                                     -->
                                    @if(isset($selectedLocations))
                                        @foreach($selectedLocations as $key => $value)
                                            <span class="tb-chip" data-tb-chip="">{{ $value['location'] }}<span wire:click="removeFromSelected('{{ $value['location'] }}', {{ $value['stat'] }})" class="tb-chips-w-x"></span></span>
                                        @endforeach
                                    @endif
                                </div>                                
                            </div>
                            @error('selectedLocations') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Search Wrapper -->
                        <div class="input-wrapper">
                            <span>Field Officer</span>
                            <!-- * Search Bar -->                            
                            <div class="search-wrap">                               
                                <input type="hidden" wire:model.lazy="foid" placeholder="field officer id" >
                                <input type="search" readonly wire:model.lazy="fullname" placeholder="Select field officer" >    
                                @error('foid') <span class="text-required fw-normal">{{ $message }}</span>@enderror                            
                            </div>
                            <div class="input-wrapper" style="padding-top: 20px;">
                                <button type="button" wire:click="openSearchOfficer"  id="data-open-new-group-modal" class="button">Search Field Officer</button>
                            </div>

                        </div>

                    </div>

                    <!-- * Rowspan 3: Save Button -->
                    <div class="rowspan">

                        @if($areaID == '')
                        <!-- * Save Button -->
                        <div class="input-wrapper">
                            <button type="button" wire:click="store" class="button">Save</button>
                        </div>
                        @else
                        <div class="input-wrapper" style="display: inline;">
                            <button type="button" wire:click="resetFields" class="button">Cancel</button>
                            <button type="button" wire:click="update" class="button">Update</button>
                        </div>                       
                        @endif

                    </div>


                </div>

                <!-- * Horizontal Container 1 -->
                <div class="horiz-con con1">

                    <div class="box-wrap">


                        <!-- * Rowspan 1: Header and Search Bar -->
                        <div class="rowspan">

                            <!-- * Header -->
                            <h3>Areas</h3>

                            <!-- * Search Wrapper -->
                            <div class="input-wrapper">

                                <!-- * Search Bar -->
                                <div class="search-wrap">
                                    <input type="search" wire:model="keyword" placeholder="Search for Areas">
                                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                                </div>

                            </div>

                        </div>

                        <!-- * Rowspan 2: Areas Table and Pagination -->
                        <div class="rowspan">

                            <!-- * Table Container -->
                            <div class="table-container tbc-1">

                                <!-- * Area Table -->
                                <table id="maintenanceAreasTable">

                                    <!-- * Table Header -->
                                    <tr>

                                        <!-- * Checkbox ALl-->                                       

                                        <!-- * Area Name -->
                                        <th><span class="th-name">Area Name</span></th>

                                        <!-- * Locations -->
                                        <th><span class="th-name">Locations</span></th>

                                        <!-- * Field Officer -->
                                        <th><span class="th-name">Field Officer</span></th>

                                        <!-- * Action -->
                                        <th style="text-align: center;"><span class="th-name">Action</span></th>

                                    </tr>
                                    @if($list)              
                                        @foreach($list as $l)
                                        <tr>
                                            <!-- * Checkbox Opt -->                                            

                                            <!-- * Data Area Name-->
                                            <td  wire:click="selectArea('{{ $l['areaID'] }}')" class="td-name" data-area-name>
                                               {{ $l['areaName'] }}
                                            </td>

                                            <!-- * Data Locations-->
                                            <td  wire:click="selectArea('{{ $l['areaID'] }}')" class="td-name" data-area-location>
                                                {{ $l['location'] }}
                                            </td>

                                            <!-- * Data Field Officer-->
                                            <td  wire:click="selectArea('{{ $l['areaID'] }}')" class="td-field-off" data-area-field-officer>
                                                {{ $l['fullname'] }}
                                            </td>

                                            <!-- * Table Trash Button -->
                                            <td class="td-btns" data-area-button>
                                                <div class="td-btn-wrapper">
                                                    <!-- <button class="a-btn-view">View</button> -->
                                                    <button type="button" onclick="showDialog('{{ $l['areaID'] }}')" class="a-btn-trash-2" data-area-trash-btn>Trash</button>
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                    @endif 
                                                                    
                                </table>

                            </div>

                            <!-- * Pagination Container -->
                            <div class="pagination-container">

                                <!-- * Pagination Links -->
                                <!-- <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a> -->
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a>.</a>
                                <a>.</a>
                                <a>.</a>
                                <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>

                            </div>
                        </div>

                    </div>

                </div>

                <!-- * Horizontal Container 2 -->
                <div class="horiz-con con2">

                    <div class="box-wrap">


                        <!-- * Rowspan 1: Header and Search Bar -->
                        <div class="rowspan">

                            <!-- * Header -->
                            <h3>Un-assigned Locations</h3>

                            <!-- * Search Wrapper -->
                            <div class="input-wrapper">

                                <!-- * Search Bar -->
                                <div class="search-wrap">
                                    <input type="search" wire:model="keywordunassigned"  placeholder="Search for Locations">
                                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                                </div>

                            </div>

                        </div>

                        <!-- * Rowspan 2: Areas Table and Pagination -->
                        <div class="rowspan">

                            <!-- * Table Container -->
                            <div class="table-container tbc-2">

                                <!-- * Un-assigned Locations Table -->
                                <table id="maintenanceUnAssignedLocationsTable">

                                    <!-- * Table Header -->
                                    <tr>

                                        <!-- * Checkbox ALl-->
                                        <th></th>

                                        <!-- * Locations -->
                                        <th><span class="th-name">Locations</span></th>

                                    </tr>


                                    <!-- * Un-assigned Locations Data -->
                                    @if(isset($unassignedLocations))
                                        @foreach($unassignedLocations as $unassigned)
                                        <tr>
                                            <td>
                                                <!-- <input wire:model="chkunassigned"   value="{{ $unassigned['location'] }}" type="checkbox" class="checkbox" > -->
                                                <button type="button" wire:click="addToSelected('{{ $unassigned['location'] }}', {{ $unassigned['stat'] }})" class="btn-add-icon"> + </button>
                                            </td>

                                            <!-- * Data Locations-->
                                            <td class="td-name">
                                                {{ $unassigned['location'] }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif                                   
                                </table>                             
                            </div>

                            <!-- * Pagination Container -->
                            <div class="pagination-container">

                                <!-- * Pagination Links -->
                                <!-- <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a> -->
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a>.</a>
                                <a>.</a>
                                <a>.</a>
                                <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        </form>
        <!-- * New Group Application Modal -->
    <dialog class="ng-modal" data-new-group-modal wire:ignore>
        <div class="modal-container">

            <!-- * Exit Button -->
            <button class="exit-button" id="data-close-new-group-modal">
                <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
            </button>

            <!-- * Search for existing member -->
            <div class="rowspan">

                <!-- * Search for existing member -->
                <h3>Search for field officer</h3>

                <div class="wrapper">

                    <!-- * Search Bar -->
                    <div class="search-wrap">
                        <input type="search" wire:model="searchfokeyword" placeholder="Search field officer">
                        <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                    </div>


                </div>


            </div>

            <!-- * Table -->
            <div class="rowspan">

                <!-- * Container: Table and Pagination -->
                <div class="na-table-con">

                    <!-- * Table Container -->
                    <div class="table-container">

                        <!-- * Members Table -->
                        <table>

                            <!-- * Table Header -->
                            <tr>

                                <!-- * Checkbox ALl
                        <th><input type="checkbox" class="checkbox" id="allCheckbox" onchange="checkAll(this)"></th> -->

                                <!-- * Header Name -->
                                <th><span class="th-name">Name</span></th>

                                <!-- * Header Action-->
                                <th><span class="th-name">Action</span></th>

                            </tr>

                            @if(isset($folist) > 0)
                                @foreach($folist as $fol)
                                <tr>
                                    <!-- * Officer Name -->
                                    <td>

                                        <!-- * Officers' Name-->
                                        <div class="td-wrapper">
                                            <!-- <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana"> <span class="td-num">1</span> -->
                                            <span class="td-name">{{ $fol['lname'] . ', ' . $fol['fname'] . ' ' . mb_substr($fol['mname'], 0, 1) . '.' }}</span>
                                        </div>

                                    </td>

                                    <!-- * Action -->
                                    <td class="td-btns">
                                        <div class="td-btn-wrapper">                                           
                                            <button type="button" onclick="selectFO('{{ $fol['foid'] }}', '{{ $fol['lname'] . ', ' . $fol['fname'] . ' ' . mb_substr($fol['mname'], 0, 1) . '.' }}')" class="a-btn-trash-2">Select</button>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            @endif     

                          

                        </table>

                    </div>

                    <!-- * Pagination Container -->
                    <div class="pagination-container">

                        <!-- * Pagination Links -->
                        <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg"
                                alt="caret-left"></a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg"
                                alt="caret-right"></a>

                    </div>

                </div>

            </div>

        </div>
    </dialog>
        <script>
            document.addEventListener('livewire:load', function() {
                window.showDialog = function($mid){            
                    @this.call('showDialog', $mid);        
                };

                window.archive = function($mid){
                    @this.call('trash', $mid);       
                };
                
                const dataNewGroupModal = document.querySelector('[data-new-group-modal]')
                const openNewGroupModal = document.querySelector('#data-open-new-group-modal')
                const closeNewGroupModal = document.querySelector('#data-close-new-group-modal')
                const addNewGroupModal = document.querySelector('[data-add-new-group-modal]')

                closeNewGroupModal.addEventListener('click', () => {
                    dataNewGroupModal.setAttribute("closing", "");
                    dataNewGroupModal.addEventListener("animationend", () => {
                        dataNewGroupModal.removeAttribute("closing");
                        dataNewGroupModal.close();
                    }, {
                        once: true
                    });
                })

                window.livewire.on('openSearchOfficerModal', message => {
                    dataNewGroupModal.showModal()
                });

                window.selectFO = function($foid, $fullname){
                    @this.call('selectFO', $foid, $fullname);       
                };

                window.livewire.on('closeSearchFOModal', message => {
                    dataNewGroupModal.close();
                });
            })
        </script>
</div>
