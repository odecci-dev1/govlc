<div>
    <div class="na-form-con">

        <!-- * Collection List Containers -->
        <!-- * Container 1: User list Header, Buttons, and Searchbar -->

        <div class="nal-con-1">

            <h2>Collection List</h2>
            <p class="p-1">
                You have <span id="numOfCollectionList">10</span> Collection list
            </p>

            <!-- * Button Container -->
            <div class="container">

                <!-- * Button Wrapper -->
                <div class="wrapper">

                    <!-- * Add New Button -->
                    <a href="{{ URL::to('/') }}/collection/create" class="button" data-add-new-collection>
                        <span>Add New</span>
                    </a>

                </div>

                <!-- * Primary Search Bar -->
                <div class="primary-search-bar">
                    <div class="row">
                        <input type="search" id="searchInput" name="search" placeholder="Search" autocomplete="off">
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
                        <th>
                            <span class="th-name">Total Lapses</span>
                        </th>



                        <!-- * Action -->
                        <th><span class="th-name">Action</span></th>

                    </tr>

                    <!-- * Table Data -->
                    <tr>

                        <!-- * Date -->
                        <td>
                            <div class="td-wrapper">
                                <span class="td-num"></span>
                                <div class="td-inner-wrapper">
                                    <span class="td-name">June 18, 2023</span>
                                    <span>ABPA120230525</span>
                                </div>
                            </div>
                        </td>

                        <!-- * Total Collectible -->
                        <td>
                            500.00
                        </td>

                        <!-- * Total Balance -->
                        <td>
                            5,000.00
                        </td>

                        <!-- * Total Savings -->
                        <td>
                            500.00
                        </td>

                        <!-- * Total Advance -->
                        <td>
                            500.00
                        </td>

                        <!-- * Total Lapses -->
                        <td>
                            0
                        </td>

                        <!-- * Table View Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button class="a-btn-view-3" data-view-collection>View</button>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <!-- * Date -->
                        <td>
                            <div class="td-wrapper">
                                <span class="td-num"></span>
                                <div class="td-inner-wrapper">
                                    <span class="td-name">June 18, 2023</span>
                                    <span>ATRT120230398</span>
                                </div>
                            </div>
                        </td>

                        <!-- * Total Collectible -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Balance -->
                        <td>
                            4,000.00
                        </td>

                        <!-- * Total Savings -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Advance -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Lapses -->
                        <td>
                            0
                        </td>


                        <!-- * Table View Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button class="a-btn-view-3" data-view-collection>View</button>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <!-- * Date -->
                        <td>
                            <div class="td-wrapper">
                                <span class="td-num"></span>
                                <div class="td-inner-wrapper">
                                    <span class="td-name">June 18, 2023</span>
                                    <span>ATRT120230398</span>
                                </div>
                            </div>
                        </td>

                        <!-- * Total Collectible -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Balance -->
                        <td>
                            4,000.00
                        </td>

                        <!-- * Total Savings -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Advance -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Lapses -->
                        <td>
                            0
                        </td>


                        <!-- * Table View Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button class="a-btn-view-3" data-view-collection>View</button>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <!-- * Date -->
                        <td>
                            <div class="td-wrapper">
                                <span class="td-num"></span>
                                <div class="td-inner-wrapper">
                                    <span class="td-name">June 18, 2023</span>
                                    <span>ATRT120230398</span>
                                </div>
                            </div>
                        </td>

                        <!-- * Total Collectible -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Balance -->
                        <td>
                            4,000.00
                        </td>

                        <!-- * Total Savings -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Advance -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Lapses -->
                        <td>
                            0
                        </td>


                        <!-- * Table View Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button class="a-btn-view-3" data-view-collection>View</button>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <!-- * Date -->
                        <td>
                            <div class="td-wrapper">
                                <span class="td-num"></span>
                                <div class="td-inner-wrapper">
                                    <span class="td-name">June 18, 2023</span>
                                    <span>ATRT120230398</span>
                                </div>
                            </div>
                        </td>

                        <!-- * Total Collectible -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Balance -->
                        <td>
                            4,000.00
                        </td>

                        <!-- * Total Savings -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Advance -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Lapses -->
                        <td>
                            0
                        </td>


                        <!-- * Table View Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button class="a-btn-view-3" data-view-collection>View</button>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <!-- * Date -->
                        <td>
                            <div class="td-wrapper">
                                <span class="td-num"></span>
                                <div class="td-inner-wrapper">
                                    <span class="td-name">June 18, 2023</span>
                                    <span>ATRT120230398</span>
                                </div>
                            </div>
                        </td>

                        <!-- * Total Collectible -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Balance -->
                        <td>
                            4,000.00
                        </td>

                        <!-- * Total Savings -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Advance -->
                        <td>
                            800.00
                        </td>

                        <!-- * Total Lapses -->
                        <td>
                            0
                        </td>


                        <!-- * Table View Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button class="a-btn-view-3" data-view-collection>View</button>
                            </div>
                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>
</div>
