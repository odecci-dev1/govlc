<div>
        <!-- * Loan Type Containers -->
        <!-- * Container 1: All Members Header, Buttons, and Searchbar -->

        <div class="m-con-1">
        <h2>Loan Types</h2>
        <p class="p-2">Total of <span id="numOFLoanTypes">5</span> loan types</p>

        <!-- * Button Container -->
        <div class="container">

            <!-- * Button Wrapper -->
            <div class="wrapper">

                <!-- * Add New Button -->
                <a href="{{ URL::to('/') }}/maintenance/loantypes/create"><button><span>Add New</span></button></a>

            </div>

            <!-- * Search Wrapper -->
            <div class="wrapper">

                <!-- * Filter Button -->
                <button><img src="{{ URL::to('/') }}/assets/icons/filter.svg" alt="filter"></button>

                <!-- * Search Bar -->
                <div class="search-wrap">
                    <input type="search" id="search" name="search" placeholder="Search">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

            </div>

        </div>

        <!-- * View Trash Button -->
        <div class="btn-container">
            <button>View Trash</button>
        </div>
        </div>

        <!-- * Container 2: Loan Type - Table and Pagination -->
        <div class="m-con-2">

        <!-- * Table Container -->
        <div class="table-container">

            <!-- * Loan Type Table -->
            <table>

                <!-- * Table Header -->
                <tr class="tr-loan-type">

                    <!-- * Checkbox ALl-->
                    <th>
                        <input type="checkbox" class="checkbox" data-select-all-checkbox>
                    </th>

                    <!-- * Loan type name -->
                    <th>
                        <span class="th-name">Loan type name</span>
                    </th>

                    <!-- * Notarial fee -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Notarial fee</span>
                            <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                        </div>
                    </th>

                    <!-- * Interest rate -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Interest rate</span>
                            <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                        </div>
                    </th>

                    <!-- * Terms of payment -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Terms of payment</span>
                            <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                        </div>
                    </th>

                    <!-- * Action -->
                    <th><span class="th-name">Action</span></th>
                </tr>


                <!-- * Loan Type Data -->
                <tr class="tr-loan-type">

                    <!-- * Checkbox Opt -->
                    <td>
                        <input type="checkbox" class="checkbox" data-select-checkbox>
                    </td>

                    <!-- * Loan type name Data-->
                    <td>
                        Collateral loan
                    </td>

                    <!-- * Notarial fee Data-->
                    <td>
                        10%
                    </td>

                    <!-- * Interest rate Data-->
                    <td class="td-curLoan">
                        18%
                    </td>

                    <!-- * Terms of payment Data-->
                    <td class="td-bal">
                        60 Days
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            <button class="a-btn-view-2">View</button>
                            <button class="a-btn-trash-2">Trash</button>
                        </div>
                    </td>

                </tr>

                <tr class="tr-loan-type">

                    <!-- * Checkbox Opt -->
                    <td>
                        <input type="checkbox" class="checkbox" data-select-checkbox>
                    </td>

                    <!-- * Loan type name Data-->
                    <td>
                        Sample loan
                    </td>

                    <!-- * Notarial fee Data-->
                    <td>
                        10%
                    </td>

                    <!-- * Interest rate Data-->
                    <td class="td-inter-rate">
                        18%
                    </td>

                    <!-- * Terms of payment Data-->
                    <td class="td-top">
                        90 Days
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            <button class="a-btn-view-2">View</button>
                            <button class="a-btn-trash-2">Trash</button>
                        </div>
                    </td>

                </tr>

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
</div>
