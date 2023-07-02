<div >
    <!-- * New Application Modal -->
    <dialog class="na-modal" data-new-application-modal wire:ignore.self>

    <div class="modal-container">
        <!-- * Exit Button -->
        <button class="exit-button" id="data-close-new-application-modal">
            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
        </button>

        <!-- * Choose Type of Loan -->
        <div class="rowspan">
            <h3>Choose Type of Loan</h3>

            <!-- * Type Of Loan Dropdown Menu -->
            <div class="loan-type-dropdown" data-bor-dropdown>

                <!-- * Gender -->
                <div class="input-wrapper">
                    <div class="select-box">
                        <select name="typeOfLoan" id="typeOfLoan">
                            <option disabled selected value></option>
                            <option value="Individual Loan">Individual Loan</option>
                            <option value="Group Loan">Group Loan</option>
                            <option value="Sample Loan">Sample Loan</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>

        <!-- * Search for existing member -->
        <div class="rowspan">

            <!-- * Search for existing member -->
            <h3>Search for existing member</h3>

            <div class="wrapper">

                <!-- * Search Bar -->
                <div class="search-wrap">
                    <!-- <input type="search" wire:keydown.enter="searchExistingMembers($event.target.value)" placeholder="Search name or member ID"> -->
                    <input type="search" wire:model="newappmodelkeyword" placeholder="Search name or member ID">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

                <!-- * Create New Button -->
                <a href="{{ URL::to('/') }}/tranactions/application/create" class="button">Create New</a>

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
                            <th><input type="checkbox" id="allCheckbox" onchange="checkAll(this)"></th> -->

                            <!-- * Header Name -->
                            <th><span class="th-name">Name</span></th>

                            <!-- * Header Member ID -->
                            <th><span class="th-name">Member ID</span></th>

                        </tr>


                        <!-- * Members Data -->
                       
                        @if($memberlist)
                            @foreach($memberlist as $list)
                            <tr>
                            <!-- * Checkbox Opt
                            <td><input type="checkbox" id="checkbox" data-checkbox></td> -->
                                <td>

                                    <!-- * Data Name-->
                                    <span class="td-name">Dela Cruz, Juana</span>

                                </td>
                                <td>
                                    <!-- * Data Member ID-->
                                    <span class="td-name">778 8596 2125</span>
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

        </div>

    </div>

    </dialog>
</div>
