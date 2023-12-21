<div>    
    <div class="reports-container">
    <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Savings Report</h2>                                      
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                    <button class="button-2" data-print-button>Print</button>
                    <button class="button-2" data-export-button>Export</button>
                </div>
            </div>
            <div class="header-wrapper" style="padding-top: 3rem;">
                <div class="inner-wrapper date-picker">                                 
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date Start</span>
                        <input type="date" wire:model.lazy="datestart" class="">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date End</span>
                        <input type="date" wire:model.lazy="dateend" class="">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>    
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Member</span>
                        <input style="width: 45rem;" readonly type="text" wire:model="member" class="">
                        @error('member') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>     
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">&nbsp;</span>
                        <button class="button-2" class="button" wire:click="searchMembers" id="data-open-new-application-modal"  data-nav-lin>Search</button>      
                    </div>                                       
                </div>              
            </div>
        <div class="body-wrapper">
            <!-- * Container: Reports Table -->
            <div class="reports-table-container">

                <!-- * Table Container -->
                <div class="table-container">

                    <!-- * Savings Table -->
                    <table id="savingsTable">

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Checkbox ALl-->
                            <!-- <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th> -->

                            <!-- * Member Name -->
                            <th><span class="th-name">Member Name</span></th>

                            <!-- * Area -->
                            <th><span class="th-name">Area</span></th>

                            <!-- * Total Savings -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Savings</span>
                            </th>
                         
                        </tr>
                        @if($data)
                            @foreach($data as $d)
                            <!-- * Savings Data -->
                            <tr>

                                <!-- * Member Name -->
                                <td><span class="td-name">{{ $d['borrower'] }}</span></td>

                                <!-- * Area -->
                                <td><span class="td-name">{{ $d['areaName'] }}</span></td>

                                <!-- * Total Savings -->
                                <td style="text-align: right;">
                                    <span class="td-name">{{ !empty($d['totalSavings']) ? number_format($d['totalSavings'], 2) : '0.00' }}</span>
                                </td>

                            </tr>
                            @endforeach
                        @endif
                       
                    </table>
                
                </div>

                <!-- * Total Collection Footer -->
                <div class="total-collection-footer">
                    <div class="footer-wrapper">
                        <p>Total Collection:</p> 
                        <span id="">700.00</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>


<dialog class="na-modal" data-new-application-modal wire:ignore.self>

    <div class="modal-container">
        <!-- * Exit Button -->
        <button class="exit-button" id="data-close-new-application-modal">
            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
        </button>

        <!-- * Choose Type of Loan -->
        <div class="rowspan">
            
                    
        </div>

        <!-- * Search for existing member -->
        <div class="rowspan">

            <!-- * Search for existing member -->
            <h3>Search for existing member</h3>

            <div class="wrapper">

                <!-- * Search Bar -->
                <div class="search-wrap">
                    <!-- <input type="search" wire:keydown.enter="searchExistingMembers($event.target.value)" placeholder="Search name or member ID"> -->
                    <input type="search" wire:model="newappmodelkeyword" wire:input="searchMembers" placeholder="Search name or member ID">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

                <!-- * Create New Button -->
 
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
                       
                        @if(isset($memberlist))
                            @foreach($memberlist as $list)
                            <tr wire:click="setMember('{{ $list['fullname'] }}')" onclick="closeModal()">
                            <!-- * Checkbox Opt
                            <td><input type="checkbox" id="checkbox" data-checkbox></td> -->
                                <td>

                                    <!-- * Data Name-->
                                    <span class="td-name">{{ $list['fullname'] }}</span>

                                </td>
                                <td>
                                    <!-- * Data Member ID-->
                                    <span class="td-name">{{ $list['memId'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @endif

                    </table>

                </div>

                <!-- * Pagination Container -->
                <div class="pagination-container">

                    <!-- * Pagination Links -->
                    <!-- <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a> -->

                </div>

            </div>

        </div>

    </div>

    </dialog>
</div>
<script>
        // *** New Application Modal *** //
        // *** New Application Modal *** //
        
        function newAppModal() {
            
            // * New Application (Individual)
            const newApplicationModal = document.querySelector('[data-new-application-modal]')
            
            if (newApplicationModal) {
                
                const openNewApplicationButton = document.querySelector('#data-open-new-application-modal')
                const closeNewApplicationButton = document.querySelector('#data-close-new-application-modal')
                
                if (openNewApplicationButton) {
                    openNewApplicationButton.addEventListener('click', (e) => {
                        newApplicationModal.showModal()
                    })
                }
            
                if (closeNewApplicationButton) {
                    closeNewApplicationButton.addEventListener('click', () => {
                        newApplicationModal.setAttribute("closing", "")
                        newApplicationModal.addEventListener("animationend", () => {
                            newApplicationModal.removeAttribute("closing")
                            newApplicationModal.close()
                        }, { once: true })
                
                    })
                }
            } 

            // ** Loan Type Dropdown
                
           
            

        }

        newAppModal();

        function closeModal(){
            const closeNewApplicationButton = document.querySelector('#data-close-new-application-modal');
            closeNewApplicationButton.click();
        }
        // *** END --- New Application Modal *** //
</script>