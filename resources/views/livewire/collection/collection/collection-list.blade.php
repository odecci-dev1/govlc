<div class="main-dashboard">
    <div class="na-form-con">

        <!-- * Collection List Containers -->
        <!-- * Container 1: User list Header, Buttons, and Searchbar -->
        <div wire:loading.delay.longest  class="full-screen-div-loading">
            <div class="center-loading-container">
                <div>
                    <div class="lds-dual-ring"></div>
                </div>
                <div class="loading-text">
                    <span>Please wait . . .</span>
                </div>
            </div>        
        </div>
        <div class="nal-con-1">

            <h2>Collection List</h2>
            <p class="p-1">
                You have <span id="numOfCollectionList">{{ $paginationPaging['totalRecord'] }}</span> Collection Items
            </p>

            <!-- * Button Container -->
            <div class="container">

                <!-- * Button Wrapper -->
                <div class="wrapper">

                    <!-- * Add New Button -->
                    @if(!$check)
                        <a href="{{ URL::to('/') }}/collection/create" class="button" data-add-new-collection>
                            <span>Make Collection</span>
                        </a>
                    @endif

                </div>

                <!-- * Primary Search Bar -->
                <div class="primary-search-bar" style="display: inline; font-size: 1.2rem !important;">
                    <input wire:model="displayrecent" type="checkbox" id="displayrecent" name="displayrecent" value="1" style="margin-right: 4px !important;">
                    <label for="displayrecent"> Display only collections for the last seven (7) days</label><br>
                </div>

                <div class="primary-search-bar">
                    <div class="row">
                        <input type="search" wire:model="keyword" style="width: 53rem; font-weight: normal !important;" wire:input="setToFalse" placeholder="Search by collection reference ex : COL-AREA-0012" autocomplete="off">
                        <button>
                        </button>
                    </div>
                    <div class="result-box" data-search-results>
                    </div>
                </div>

            </div>

        </div>

        <!-- * Container 2: User List - Table and Pagination -->
        <div class="cll-con-2">

            <!-- * Table Container -->
            <div class="table-container">

                <!-- * User Table -->
                <table>
                    <!-- * Table Header -->
                    <tr>

                        <!-- * Date -->
                        <th>
                            <span class="th-name">Date</span>
                        </th>

                        <!-- * Total Collectible -->
                        <th>
                            <span class="th-name">Total Collectible</span>
                        </th>

                        <!-- * Total Balance -->
                        <th>
                            <span class="th-name">Total Balance</span>
                        </th>

                        <!-- * Total Savings -->
                        <th>
                            <span class="th-name">Total Savings</span>
                        </th>

                        <!-- * Total Advance -->
                        <th>
                            <span class="th-name">Total Advance</span>
                        </th>

                        <!-- * Total Lapses -->
                        <th style="padding-left: 5rem;">
                            <span class="th-name">Total Lapses</span>
                        </th>



                        <!-- * Action -->
                        <th><span class="th-name">Action</span></th>

                    </tr>

                    <!-- * Table Data -->
                    @if($list)
                        @foreach($list->sortBy('DateCreated') as $collection)
                        <tr>
                            @php
                                $DateCreated = new DateTime($collection['DateCreated']);
                            @endphp
                            <!-- * Date -->
                            <td>
                                <div class="td-wrapper">                                  
                                    <div class="td-inner-wrapper">
                                        <span class="td-name">{{ $DateCreated->format('F d, Y') }}</span>
                                        <span>{{ $collection['RefNo'] }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- * Total Collectible -->
                            <td>
                                {{ number_format($collection->totals['totalCollectible'], 2) }}
                            </td>

                            <!-- * Total Balance -->
                            <td>
                                {{ number_format($collection->totals['total_Balance'], 2) }}
                            </td>

                            <!-- * Total Savings -->
                            <td>
                                {{ number_format($collection->totals['total_savings'], 2) }}
                            </td>

                            <!-- * Total Advance -->
                            <td>
                                {{ number_format($collection->totals['total_advance'], 2) }}
                            </td>

                            <!-- * Total Lapses -->
                            <td style="padding-left: 5rem;">
                                {{ number_format($collection->totals['total_lapses'], 2) }}
                            </td>

                            <!-- * Table View Button -->
                            <td class="td-btns">
                                <div class="td-btn-wrapper">
                                    <a href="{{ URL::to('/') }}/collection/view/{{ $collection['RefNo'] }}" class="a-btn-view-3" data-view-collection>View</a>
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

</div>
</div>
