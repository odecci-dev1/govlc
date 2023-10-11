<div>
    
<main>

    <dialog class="am-filter-modal" data-filter-member-modal>

    <div class="modal-container">

        <!-- * Modal Header and Exit Button -->
        <div class="modal-header">
            <h4>Filter</h4>
            <button class="exit-button" data-close-filter-member-modal>
                <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
            </button>
        </div>

        <!-- * Current Loan -->
        <div class="rowspan">

            <div class="input-wrapper-modal">
                <span>Current Loan</span>
                <input autocomplete="off" type="number" id="filterCurrentLoanFrom" name="filterCurrentLoanFrom" placeholder="From">
            </div>

            <div class="input-wrapper-modal">
                <input autocomplete="off" type="number" id="filterCurrentLoanTo" name="filterCurrentLoanTo" placeholder="To">
            </div>

        </div>

        <!-- * Outstanding Balance -->
        <div class="rowspan">

            <div class="input-wrapper-modal">
                <span>Outstanding Balance</span>
                <input autocomplete="off" type="number" id="filterOutstandingBal" name="filterOutstandingBal">
            </div>

        </div>

        <!-- * Save Button -->
        <div class="rowspan">
            <button class="button" data-save-filter-member-modal>Save</button>
        </div>

    </div>

    </dialog>

    <!-- * All Members' Containers -->
    <!-- * Container 1: All Members Header, Buttons, and Searchbar -->
    <div class="am-con-1">
    <h2>Members</h2>
    <p class="p-1">(Please select member status or loan type)</p>

    <!-- * Button Container -->
    <div class="container">

        <!-- * Button Wrapper -->
        <div class="wrapper">

            <!-- * Add New Button -->
        

            <!-- * Member Type Dropdown Button -->
            <div class="borrower-dropdown" data-bor-dropdown>

                <!-- * Member Type Button -->
                <button class="link dropdown" data-bor-dropdown-button>
                    <span data-bor-dropdown-button>Member Status</span>
                    <img src="{{ URL::to('/') }}/assets/icons/white-carret-down.svg" alt="carret-down"data-bor-dropdown-button>
                </button>

                <!-- * Submenu -->
                <ul class="dropdown-menu">

                    <!-- * Borrower -->
                    <a href="" data-member-borrower>
                        <li>
                            <span>Active</span>
                        </li>
                    </a>

                    <!-- * Co-Borrower -->
                    <a href="" data-member-co-borrower>
                        <li>
                            <span>Inactive</span>
                        </li>
                    </a>

                </ul>

            </div>

            <!-- * Type Of Loan Dropdown Button -->
            <div class="borrower-dropdown" data-bor-dropdown>

                <!-- * Borrower Button -->
                <button class="link dropdown" data-bor-dropdown-button>
                    <span data-bor-dropdown-button>Type Of Loan</span>
                    <img src="{{ URL::to('/') }}/assets/icons/white-carret-down.svg" alt="carret-down"data-bor-dropdown-button>
                </button>

                <!-- * Submenu -->
                <ul class="dropdown-menu">

                    <!-- * Collateral Loan -->
                    <a href="" data-member-borrower>
                        <li>
                            <span>Collateral Loan</span>
                        </li>
                    </a>

                    <!-- * Group Loan -->
                    <a href="" data-member-group-loan>
                        <li>
                            <span>Group Loan</span>
                        </li>
                    </a>

                </ul>

            </div>

        </div>

        <!-- * Filter & Search Wrapper -->
        <div class="wrapper">

            <!-- * Filter Button -->
            <button data-open-filter-member-modal><img src="{{ URL::to('/') }}/assets/icons/filter.svg" alt="filter"></button>

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
    <div class="btn-container">
        <button>View Trash</button>
    </div>
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
                    <input type="checkbox" class="checkbox" data-select-all-checkbox>
                </th>

                <!-- * Borrower -->
                <th>
                    <span class="th-name">Borrower</span>
                </th>

                <!-- * Co-borrower -->

                <!-- * Current Loan -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Current Loan</span>
                        <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                    </div>
                </th>

                <!-- * Outstanding Balance -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Outstanding Balance</span>
                        <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                    </div>
                </th>

                <!-- * Due Date -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Due Date</span> <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                    </div>
                </th>

                <!-- * Action -->
                <th><span class="th-name">Action</span></th>
            </tr>


            <!-- * All Members Data -->
            
            @if($list)              
                @foreach($list as $l)
                <tr>

                    <!-- * Checkbox Opt -->
                    <td>
                        <input type="checkbox" class="checkbox" id="checkbox" data-checkbox>
                    </td>

                    <td>

                        <!-- * Borrower Data -->
                        <div class="td-wrapper">
                            <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana"> <span class="td-num">1</span>
                            <span class="td-name">{{ $l['borrower'] }}</span>
                        </div>

                    </td>

                    <!-- * Current Loan Data-->
                    <td class="td-curLoan">
                        {{ number_format($l['loanAmount'], 2) }}
                    </td>

                    <!-- * Outstading Balance Data-->
                    <td class="td-bal">
                        10,000.00 - 
                    </td>

                    <!-- * Due Date Info-->
                    <td class="td-due">
                        June 4, 2023 -
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            <a href="{{ URL::to('/') }}/members/details/{{ $l['naid'] }}" class="a-btn-view-2">View</a>
                            <button class="a-btn-trash-2">Trash</button>
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
        <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a>
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>

    </div>

    </div>
</main>
</div>
