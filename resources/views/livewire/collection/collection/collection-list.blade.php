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
                    @if(!$check)
                    <a href="{{ URL::to('/') }}/collection/create" class="button" data-add-new-collection>
                        <span>Make Collection</span>
                    </a>
                    @endif

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
                    @if($list)
                        @foreach($list as $l)
                        <tr>
                            @php
                                $dateCreated = new DateTime($l['dateCreated']);
                            @endphp
                            <!-- * Date -->
                            <td>
                                <div class="td-wrapper">
                                    <span class="td-num"></span>
                                    <div class="td-inner-wrapper">
                                        <span class="td-name">{{ $dateCreated->format('F d, Y') }}</span>
                                        <span>{{ $l['collection_RefNo'] }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- * Total Collectible -->
                            <td>
                                {{ number_format($l['totalCollectible'], 2) }}
                            </td>

                            <!-- * Total Balance -->
                            <td>
                                {{ number_format($l['total_Balance'], 2) }}
                            </td>

                            <!-- * Total Savings -->
                            <td>
                                {{ number_format($l['total_savings'], 2) }}
                            </td>

                            <!-- * Total Advance -->
                            <td>
                                {{ number_format($l['total_advance'], 2) }}
                            </td>

                            <!-- * Total Lapses -->
                            <td>
                                {{ number_format($l['total_lapses'], 2) }}
                            </td>

                            <!-- * Table View Button -->
                            <td class="td-btns">
                                <div class="td-btn-wrapper">
                                    <a href="{{ URL::to('/') }}/collection/view/{{ $l['collection_RefNo'] }}" class="a-btn-view-3" data-view-collection>View</a>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    @endif                    
                </table>

            </div>

        </div>

    </div>

</div>
</div>
