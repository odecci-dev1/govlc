<div class="main-dashboard">
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to Permanently delete the selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
    @endif
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    <!-- * Maintenance' Containers -->
            <!-- * Container 1: Maintenance Header, Buttons, and Searchbar -->
            <div class="m-con-1">
                <h2>Field Officers</h2>
                <p class="p-1">
                    Total of <strong>{{ $paginationPaging['totalRecord'] }}</strong> field officers
                </p>
                <!-- * Button Container -->
                <div class="container">

                    <!-- * Button Wrapper -->
                    <div class="wrapper">

                        <!-- * Add New Button -->
                        <!-- <button> -->
                            @if($usertype != 2)
                            <a href="{{ URL::to('/') }}/maintenance/fieldofficer/create" class="button"><span>Add New</span></a>
                            @endif
                        <!-- </button> -->

                    </div>

                    <!-- * Search Wrapper -->
                    <div class="wrapper">

                        <!-- * Search Bar -->
                        <div class="search-wrap">
                            <input type="search" wire:model="keyword" placeholder="Search for collector">
                            <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                        </div>

                    </div>

                </div>

                <!-- * View Trash Button -->
                <div class="btn-container">
                    <!-- <button type="button">View Trash</button> -->
                </div>
            </div>

            <!-- * Container 2: Maintenance Field Officer Table and Pagination -->
            <div class="m-con-2 min-height" style="height:clamp(100% - 21rem, 40rem, 80vh); overflow-y: auto;">

                <!-- * Table Container -->
                <div class="table-container">

                    <!-- * Field Officer Table -->
                    <table id="fieldOfficerTable">

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Number -->                         

                            <!-- * Name -->
                            <th>
                                <span class="th-name">Name</span>
                            </th>

                            <!-- * Contact No. -->
                            <th>
                                <span class="th-name">Contact No.</span>
                            </th>

                            <!-- * Address -->
                            <th>
                                <div class="th-wrapper">
                                    <span class="th-name">Address</span>
                                    <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                                </div>
                            </th>

                            <!-- * Contact No. -->
                            <th>
                                <div class="th-wrapper">
                                    <span class="th-name">Age</span>
                                    <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                                </div>
                            </th>

                            <!-- * Area -->
                            <th>
                                <div class="th-wrapper">
                                    <span class="th-name">Area</span>
                                    <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                                </div>
                            </th>

                            <!-- * Action -->
                            <th style="width: 1%; text-align:center; padding: 1rem 0;">
                                <span class="th-name">Action</span>
                            </th>
                        </tr>


                        <!-- * All Members Data -->
                        @if(isset($list) > 0)
                            @foreach($list as $officer)
                            <tr>
                                <!-- * Officer Name -->
                                <td>
                                    <!-- * Officers' Name-->
                                    <div class="td-wrapper">
                                        <!-- <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana"> <span class="td-num">1</span> -->
                                        <span class="td-name">{{ $officer->Lname . ', ' . $officer->Fname . ' ' . mb_substr($officer->Mname, 0, 1) . ($officer->Mname == '' ? '' : '.') }}</span>
                                    </div>
                                </td>

                                <!-- * Contact Number 1 -->
                                <td class="td-con-1">
                                    {{ $officer->Cno }}
                                </td>

                                <!-- * Address -->
                                <td class="td-address">
                                    {{ $officer->HouseNo . ', ' . $officer->Barangay . ', ' . $officer->City . ', '. $officer->Region }}
                                </td>

                                <!-- * Contact Number 2 -->
                                <td class="td-con-2">
                                    {{ $officer->Age }}
                                </td>

                                <!-- * Area -->
                                
                                <td class="td-area">       
                                    {{-- {{ $officer->FOID }} --}}
                                    {{ $officer->area ? $officer->area->Area : '' }}
                                    {{-- {{ strlen( $officer->area->Area ) > 23 ? substr( $officer->area->Area, 0, 23) . '...' :  $officer->area }} --}}
                                </td>

                                <!-- * Area -->
                                
                                {{-- <td class="td-area">       
                                    {{ $officer->status->Id }}
                                </td> --}}

                                <!-- * Action -->
                                <td class="td-btns">
                                    <div class="td-btn-wrapper">
                                        {{-- <button wire:click="selectOfficer('{{ $officer->FOID }}')" class="a-btn-view-2" data-maintenance-view-field-officer>View</button> --}}
                                        <a href="{{ URL::to('/') }}/maintenance/fieldofficer/view/{{ $officer->FOID }}" class="a-btn-view-2" data-maintenance-view-field-officer>View</a>
                                        @if($usertype != 2)
                                        <button type="button" onclick="showDialog('{{ $officer->FOID }}')" class="a-btn-trash-2">Trash</button>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        @endif                       
                    </table>

                </div>
                </div>
                <!-- * Pagination Container -->
                @if($paginationPaging['totalPage'])
                    <div class="pagination-container" style="overflow-x: auto;">
                        <!-- * Pagination Links -->
                        <a href="#" wire:click="setPage({{ $this->paginationPaging['prevPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a>
                        @for($x = 1; $x <= $paginationPaging['totalPage']; $x++)
                        <a href="#" wire:click="setPage({{ $x }})" class="{{ $paginationPaging['currentPage'] == $x ? 'font-size-1_4em color-app' : '' }}">{{ $x }}</a>
                        @endfor
                        <a href="#" wire:click="setPage({{ $this->paginationPaging['nextPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>
                    </div>
                @endif

</div>
<script>
    document.addEventListener('livewire:load', function () {
        window.showDialog = function($mid){              
            @this.call('showDialog', $mid);        
        };

        window.archive = function($mid){
            @this.call('archive', $mid);       
        };
    })
</script>
