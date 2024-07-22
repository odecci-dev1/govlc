<div>    
    <!-- * Holiday Maintenance -->
    <!-- * Container 1: Holiday Maintenance Header, Buttons, and Searchbar -->
  
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to Permanently delete the selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
    @endif
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mmessage')" :header="'Success'"></x-alert>   
    @endif
    <div class="m-con-1">
    <h2>Holiday</h2>
    <p class="p-2">Total of <span id="numOfHolidays">{{ $paginationPaging['totalRecord'] }}</span> Holidays</p>

    <!-- * Button Container -->
    <div class="container">

        <!-- * Button Wrapper -->
        <div class="wrapper">

            <!-- * Add New Button -->
            @if($usertype != 2)
            <a href="{{ URL::to('/') }}/maintenance/holiday/create"><button><span>Add New</span></button></a>
            @endif

        </div>

        <!-- * Search Wrapper -->
        <div class="wrapper">

            <!-- * Filter Button -->           

            <!-- * Search Bar -->
            <div class="search-wrap">
                <input type="search" wire:model="keyword" placeholder="Search">
                <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
            </div>

        </div>

    </div>

    <!-- * View Trash Button -->
    <div class="btn-container">
        <!-- <button>View Trash</button> -->
    </div>
    </div>

    <!-- * Container 2: Holiday Maintenance - Table and Pagination -->
    <div class="m-con-2">

    <!-- * Table Container -->
    <div class="table-container">

        <!-- * Holiday Table -->
        <table id="maintenanceHolidayTable">

            <!-- * Table Header -->
            <tr class="tr-loan-type">

                <!-- * Checkbox ALl-->
                <th>
                    <input type="checkbox" class="checkbox" data-select-all-checkbox>
                </th>

                <!-- * Holiday Name -->
                <th>
                    <span class="th-name">Holiday Name</span>
                </th>

                <!-- * Month -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Month</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Day -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Day</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Year -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Year</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Location/Area -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Location/Area</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Action -->
                <th><span class="th-name">Action</span></th>

            </tr>

            <!-- * Holiday Data -->
            @if($list)              
                @foreach($list as $l)
                <tr class="tr-loan-type">

                    <!-- * Checkbox Opt -->
                    <td>
                        <input type="checkbox" class="checkbox" data-select-checkbox>
                    </td>

                    <!-- * Holiday Name Data -->
                    <td id="holidayName">
                        {{ $l['HolidayName'] }}
                    </td>

                    <!-- * Month Data -->
                    <td id="holidayMonth">
                        {{  date('F', strtotime($l['Date'])) }}
                    </td>

                    <!-- * Day Data -->
                    <td id="holiDay">
                        {{ format_date_with_ordinal($l['Date']) }}
                    </td>

                    <!-- * Year Data-->
                    <td id="holidayYear">
                        {{ date('Y', strtotime($l['Date'])) }}
                    </td>

                    <!-- * Location/Area -->
                    <td id="holidayLocation">
                        {{ $l['Location'] }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            <a href="{{ URL::to('/') }}/maintenance/holiday/view/{{ $l['HolidayID'] }}" class="a-btn-view-2" data-maintenance-view-holiday>View</a>
                            @if($usertype != 2)
                            <button onclick="showDialog('{{ $l['HolidayID'] }}')" type="button" class="a-btn-trash-2">Trash</button>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            @endif                          
        </table>

    </div>

            @if($paginationPaging['totalPage'] > 0)
                <div class="pagination-container" style="overflow-x: auto;">
                    <!-- * Pagination Links -->
                    <a href="#" wire:click="setPage({{ $this->paginationPaging['prevPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left" ></a>
                    @for($x = 1; $x <= $paginationPaging['totalPage']; $x++)
                    <a href="#" wire:click="setPage({{ $x }})" class="{{ $paginationPaging['currentPage'] == $x ? 'font-size-1_4em color-app' : '' }}">{{ $x }}</a>
                    @endfor
                    <a href="#" wire:click="setPage({{ $this->paginationPaging['nextPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right" ></a>

                </div>   
            @endif

    </div>
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
