<div>
    <!-- * New-Application-Form-Container -->
    <form action="" class="na-form-con" autocomplete="off">

<!-- * New Application Progress Bar Container -->
<div class="na-progress-bar-container">
    <div class="progress-bar-level">

        <!-- * New Application Registration Level 1 -->
        <div class="level level1 active">
            <span>Registration {{ $test }}</span>
        </div>

        <!-- * New Application Credit Investigation Level 2 -->
        <div class="line" data-level-2></div>
        <div class="level" data-level-2>
            <span>Credit<br>Investigation</span>
        </div>

        <!-- * New Application Approval Level 3 -->
        <div class="line line3"></div>
        <div class="level level3">
            <span>Approval</span>
        </div>

        <!-- * New Application Releasing Level 4 -->
        <div class="line line3"></div>
        <div class="level level4">
            <span>Releasing</span>
        </div>

    </div>
</div>

<!-- * Container 1: Add Group Name -->
<div class="na-container-group-1">

    <!-- * Small Container -->
    <div class="small-con-3">

        <!-- * Rowspan 1: Header -->
        <div class="rowspan">

            <!-- * Group Name Input -->
            <div class="input-wrapper">
                <h2>Group Name</h2>
                <input type="text" id="appLoanAmnt" name="appLoanAmnt">
            </div>

        </div>

    </div>

</div>

<!-- * Container 2: Group Table -->
<div class="na-container-group-2">

    <!-- * Table Container -->
    <div class="table-container">

        <!-- * Add Member Button -->
        <div class="btn-wrapper">

            <button type="button" class="button" id="data-open-new-group-modal">Add Member</button>
            <button type="button" wire:click="store" class="button">Save</button>

        </div>

        <!-- * Group Table -->
        <table id="newGroupApplicationTable">

            <!-- * Table Header -->
            <tr>

                <!-- * Checkbox ALl-->
                <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th>

                <!-- * Borrower -->
                <th><span class="th-name">Borrower</span></th>

                <!-- * Co-borrower -->
                <th><span class="th-name">Co-borrower</span></th>

                <!-- * Action -->
                <th><span class="th-name">Action</span></th>

            </tr>

            @if(session('memdata'))
                        @foreach(session('memdata') as $key => $mem)
                        <tr>

                        <!-- * Checkbox Opt -->
                        <td><input type="checkbox" class="checkbox" id="checkbox" data-select-checkbox></td>

                        <td>
                            <!-- * Borrower Data-->
                            <div class="td-wrapper">
                                <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">
                                <span class="td-num"></span>
                                <span class="td-name">{{ $mem['fname'] }}</span>
                            </div>

                        </td>

                        <td>

                            <!-- * Co-Makers Data-->
                            <div class="td-wrapper">
                                <img src="{{ URL::to('/') }}/assets/icons/sample-dp/CoMaker-1.svg" alt="Alfreds Futterkiste">
                                <span class="td-name">Palermo, Juliana</span>
                            </div>

                        </td>

                        <!-- * Table View and Trash Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button type="button" class="a-btn-view-2" data-view-group-member>View</button>
                                <button type="button" class="a-btn-trash-2">Trash</button>
                            </div>
                        </td>

                        </tr>
                        @endforeach
                    @endif
            <!-- * All Members Data -->
           
            <tr>

                <!-- * Checkbox -->
                <td><input type="checkbox" class="checkbox" id=" checkbox" data-select-checkbox></td>

                <!-- * Borrower Data-->
                <td>
                    <div class="td-wrapper">
                        <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-2.svg" alt="">
                        <span class="td-num"></span>
                        <span class="td-name">Beverly, Haily</span>
                    </div>
                </td>

                <!-- * Co-Makers Data-->
                <td>
                    <div class="td-wrapper">
                        <img src="{{ URL::to('/') }}/assets/icons/sample-dp/CoMaker-2.svg" alt="">
                        <span class="td-name">Barbosa, June</span>
                    </div>
                </td>

                <!-- * Table View and Trash Button -->
                <td class="td-btns">

                    <div class="td-btn-wrapper">
                        <button type="button" class="a-btn-view-2" data-view-group-member>View</button>
                        <button type="button" class="a-btn-trash-2">Trash</button>
                    </div>

                </td>

            </tr>

        </table>


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

<!-- * Container 3: Group Loan Input Fields -->
<div class="na-container-group-3">

    <!-- * Small Container -->
    <div class="small-con-3">

        <!-- * Rowspan 1: Header -->
        <div class="rowspan">

            <!-- * Loan Details -->
            <div class="input-wrapper">
                <h2>Loan Details</h2>
                <span>Group Loan</span>
            </div>

        </div>

        <!-- * Rowspan 2: Applied Loan Amount, Terms Of Payment and Purpose -->
        <div class="rowspan">

            <!-- * Applied Loan Amount -->
            <div class="input-wrapper">
                <span>Applied Loan Amount</span>
                <input type="text" id="appLoanAmnt" name="appLoanAmnt">
            </div>

            <!-- * Terms Of Payment -->
            <div class="input-wrapper">
                <span>Terms Of Payment</span>
                <input type="text" id="top" name="top">
            </div>

            <!-- * Purpose -->
            <div class="input-wrapper">
                <span>Purpose</span>
                <input type="text" id="purpose" name="purpose">
            </div>

        </div>

    </div>

</div>

</form>

<!-- * New Group Application Modal -->
<dialog class="ng-modal" data-new-group-modal>

<div class="modal-container">

    <!-- * Exit Button -->
    <button class="exit-button" id="data-close-new-group-modal">
        <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
    </button>

    <!-- * Search for existing member -->
    <div class="rowspan">

        <!-- * Search for existing member -->
        <h3>Search for existing member</h3>

        <div class="wrapper">

            <!-- * Search Bar -->
            <div class="search-wrap">
                <input type="search" id="search" name="search" placeholder="Search name or member ID">
                <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
            </div>

            <!-- * Create New Button -->
            <a href="{{ URL::to('/') }}/tranactions/application/create/2" targets="_blank" class="button" data-link-to-newgroup-app>Create New</a>

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


                    <!-- * Members Data -->
                    <tr>

                        <!-- * Checkbox Opt
                        <td><input type="checkbox" class="checkbox" id="checkbox" data-checkbox></td> -->

                        <td>

                            <!-- * Data Name-->
                            <span class="td-name">Dela Cruz, Juana</span>

                        </td>

                        <td>

                            <!-- * Add to member button -->
                            <button class="a-btn-view-2" data-add-new-group-modal>Add to Group</button>

                        </td>


                    </tr>
                    <tr>

                        <!-- * Checkbox Opt
                        <td><input type="checkbox" class="checkbox" id="checkbox" data-checkbox></td> -->

                        <td>

                            <!-- * Data Name-->
                            <span class="td-name">Dela Cruz, Juana</span>

                        </td>

                        <td>

                            <!-- * Add to member button -->
                            <button class="a-btn-view-2" data-add-new-group-modal>Add to Group</button>

                        </td>


                    </tr>
                    <tr>

                        <!-- * Checkbox Opt
                        <td><input type="checkbox" class="checkbox" id="checkbox" data-checkbox></td> -->

                        <td>

                            <!-- * Data Name-->
                            <span class="td-name">Dela Cruz, Juana</span>

                        </td>

                        <td>

                            <!-- * Add to member button -->
                            <button class="a-btn-view-2" data-add-new-group-modal>Add to Group</button>

                        </td>


                    </tr>
                   
                    <tr>

                        <!-- * Checkbox Opt
                        <td><input type="checkbox" class="checkbox" id="checkbox" data-checkbox></td> -->

                        <td>

                            <!-- * Data Name-->
                            <span class="td-name">Dela Cruz, Juana</span>

                        </td>

                        <td>

                            <!-- * Add to member button -->
                            <button class="a-btn-view-2" data-add-new-group-modal>Add to Group</button>

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

</div>
<script>
    const dataNewGroupModal = document.querySelector('[data-new-group-modal]')
    const openNewGroupModal = document.querySelector('#data-open-new-group-modal')
    const closeNewGroupModal = document.querySelector('#data-close-new-group-modal')
    const addNewGroupModal = document.querySelector('[data-add-new-group-modal]')
    
    openNewGroupModal.addEventListener('click', () => {
    
        dataNewGroupModal.showModal()
    
    })

    closeNewGroupModal.addEventListener('click', () => {
        dataNewGroupModal.setAttribute("closing", "");
        dataNewGroupModal.addEventListener("animationend", () => {
            dataNewGroupModal.removeAttribute("closing");
            dataNewGroupModal.close();
        }, { once: true });

    })
</script>
</div>
