
<main>


    <!-- * All Members' Containers -->
    <!-- * Container 1: All Members Header, Buttons, and Searchbar -->
    <div class="am-con-1">
    <h2>Members</h2>
    <p class="p-1">
        Total of <strong>{{ $paginationPaging['totalRecord'] }}</strong> members
    </p>
    

    <!-- * Button Container -->
    <div class="container">

        <!-- * Button Wrapper -->
        <div class="wrapper">

            <!-- * Add New Button -->
        
            <!-- * Member Type Dropdown Button -->
            <div class="borrower-dropdown" data-bor-dropdown>

                <!-- * Member Type Button -->                           
                <div class="select-box" style="width: 30rem;">
                    <select  wire:model="status" wire:change="setPage(1)" class="select-option-menu">
                        <option value="">Active and Inactive Members</option>     
                        <option value="Active">Active Members</option>                                    
                        <option value="Inactive">Inactive Members</option>                                    
                    </select>                       
                </div>                

            </div>

            <!-- * Type Of Loan Dropdown Button -->
            <div class="borrower-dropdown" data-bor-dropdown>

                <div class="select-box" style="width: 40rem;">
                    <select  wire:model="loantype" class="select-option-menu" style="display: none;">
                        <option value="">All Types Of Loan</option>     
                        @if($loantypeList)
                            @if($loantypeList)
                                @foreach($loantypeList as $loantypeList)
                                    <option value="{{ $loantypeList['loanTypeID'] }}">{{ $loantypeList['loanTypeName'] }}</option>
                                @endforeach
                            @endif           
                        @endif                              
                    </select>                       
                </div>


            </div>

        </div>

        <!-- * Filter & Search Wrapper -->
        <div class="wrapper">

            <!-- * Filter Button -->
           

            <!-- * Primary Search Bar -->
            <div class="primary-search-bar">
                <div class="row">
                    <input type="search" wire:model="keyword" placeholder="Search" autocomplete="off">
                    <button>
                    </button>
                </div>
                <div class="result-box" data-search-results>
                </div>
            </div>

        </div>

    </div>

    <!-- * View Trash Button -->

    </div>

    <!-- * Container 2: All Members - Table and Pagination -->
    <div class="am-con-2">

    <!-- * Table Container -->
    <div class="table-container">

        <!-- * All Members Table -->
        <table id="allMembersTable">

            <!-- * Table Header -->
            <tr>

                <!-- * Checkbox ALl-->
                <th>
                    <!-- <input type="checkbox" class="checkbox" data-select-all-checkbox> -->
                </th>

                <!-- * Borrower -->
                <th>
                    <span class="th-name">Borrower</span>
                </th>

                <th>
                    <span class="th-name">Status</span>
                </th>

                <!-- * Co-borrower -->

                <!-- * Current Loan -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Current Loan</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Outstanding Balance -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Outstanding Balance</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Due Date -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Recent application date</span>
                    </div>
                </th>

                <!-- * Action -->
                <th  style="width: 1%; text-align: center"><span class="th-name">Action</span></th>
            </tr>


            <!-- * All Members Data -->
            
            @if($list)              
                @foreach($list as $l)
                <tr>

                    <!-- * Checkbox Opt -->
                    <td>
                        <!-- <input type="checkbox" class="checkbox" id="checkbox" data-checkbox> -->
                    </td>

                    <td>

                        <!-- * Borrower Data -->
                        <div class="td-wrapper">
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana"> <span class="td-num">1</span> -->
                            @if(file_exists(public_path('storage/members_profile/'.(isset($l['profilePath']) ? $l['profilePath'] : 'xxxx'))))                                  
                                <img src="{{ asset('storage/members_profile/'.$l['profilePath']) }}" alt="upload-image" style="height: 4rem; width: 4rem;" />                                                                                                                 
                            @else
                                <img src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" style="height: 4rem; width: 4rem;" />                                               
                            @endif    
                            <span class="td-name">{{ $l['borrower'] }}</span>
                        </div>

                    </td>

                    <td>
                        {{ $l['status'] }}
                    </td>

                    <!-- * Current Loan Data-->
                    <td class="td-curLoan">
                        {{ number_format($l['currentLoan'], 2) }}
                    </td>

                    <!-- * Outstading Balance Data-->
                    <td class="td-bal">
                        {{ number_format($l['outstandingBalance'], 2) }}
                    </td>

                    <!-- * Due Date Info-->
                    <td class="td-due">
                    {{ date('Y-m-d', strtotime($l['lastUpdated'])) }}
                        <!-- June 4, 2023 -->
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns" style="width: 1%;">
                        <div class="td-btn-wrapper">
                            <a href="{{ URL::to('/') }}/members/details/{{ $l['naid'] }}" class="a-btn-view-2">View</a>                         
                        </div>
                    </td>

                </tr>
                @endforeach
            @endif    
           
        </table>
    </div>

    <!-- * Pagination Container -->
    @if($paginationPaging['totalPage'] > 1)
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
</main>

