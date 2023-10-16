<div>
 

    <!-- * Main Dashboard -->
    <div class="main-dashboard">

    <dialog class="am-filter-modal" data-filter-member-modal wire:ignore.self>

        <div class="modal-container-3">

            <!-- * Modal Header and Exit Button -->
            <div class="modal-header">
                <h4>Filter</h4>
                <button class="exit-button" data-close-filter-member-modal>
                    <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
                </button>
            </div>
            
            <!-- * Choose Type of Loan -->
            <div class="rowspan">

                <h3>Choose Type of Loan</h3>
                <!-- * Type Of Loan Dropdown Menu -->
                <div class="loan-type-dropdown">
                    <!-- * Type Of Loan -->
                    <div class="input-wrapper">

                        <div class="select-box">

                            <select  wire:model="loantype"  class="select-option">
                                @if($loantypeList)
                                    @foreach($loantypeList as $loantypeList)
                                        <option value="{{ $loantypeList['loanTypeID'] }}">{{ $loantypeList['loanTypeName'] }}</option>
                                    @endforeach
                                @endif                                        
                            </select>          
                            @error('loantype') <span class="text-required fw-bold">{{ $message }}</span>@enderror

                        </div>
                    </div>

                </div>

            </div>

            <!-- * Applied Loan Amount -->
            <div class="rowspan">

                <div class="input-wrapper-modal">
                    <span>Applied Loan Amount</span>
                    <input autocomplete="off" wire:model="loanAmountFrom" type="number" placeholder="From">
                </div>

                <div class="input-wrapper-modal">
                    <input autocomplete="off" wire:model="loanAmountTo" type="number" placeholder="To">
                </div>

            </div>
            <div class="rowspan">
                <label>Zero (0) value for unfiltered amount</label>
            </div>
            <!-- * Save Button -->
            <div class="rowspan">
                <button class="button" data-save-filter-member-modal>Close</button>
            </div>

        </div>

    </dialog>
    <div class="na-form-con">

        <!-- * For Credit Checking Containers -->
        <!-- * Container 1: CI List Header, Buttons, and Searchbar -->

        <div class="cil-con-1">
            <div class="header-container">
                <h2>For Credit Checking</h2>
                <p class="p-1">
                You have a total <span id="numOfApplicantsForApproval">10</span> 
                <span>applications for approval</span>
                </p>
            </div>

            <!-- * Button Container -->
            <div class="container">


            <!-- * Search Wrapper -->
            <div class="wrapper">
                <!-- * Filter Button -->
                <button data-open-filter-member-modal>
                    <img src="{{ URL::to('/') }}/assets/icons/filter.svg" alt="filter" />
                </button>
    
                <!-- * Search Bar -->
                <div class="search-wrap">
                        <input
                            type="search"
                            wire:model="keyword"
                            placeholder="Search"
                        />
                    <img
                        src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg"
                        alt="search"
                    />
                </div>
            </div>
            </div>
        </div>
        <!-- * Container 2: CI List - Table and Pagination -->
        <div class="cil-con-2">

            <!-- * Table Container -->
            <div class="table-container">

            <!-- * User Table -->
            <table>
                <!-- * Table Header -->
                <tr>

                    <!-- * Borrower -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Borrower</span>
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                        </div>
                    </th>
    
                    <!-- * Contact Number -->
                    <th>
                        <span class="th-name">Contact Number</span>
                    </th>
    
                    <!-- * Loan Amount -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Loan Amount</span>
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                        </div>
                    </th>
    
                    <!-- * Terms of Payment -->
                    <th>
                        <span class="th-name">Terms of Payment</span>
                    </th>
    
                    <!-- * Interest -->
                    <th>
                        <div class="th-wrappers" style="text-align: end;">
                            <span class="th-name">Interest</span>
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                        </div>
                    </th>

                    <!-- * Action -->
                    <th><span class="th-name">Action</span></th>
                </tr>
                @if($list)
                    @foreach($list as $mlist)
                    <tr>

                        <!-- * Borrower -->
                        <td>
                            <!-- <span class="td-num"></span> -->
                            {{ $mlist['borrower'] }}
                        </td>
        
                        <!-- * Borrower Contact Number -->
                        <td>
                            {{ $mlist['borrowerCno'] }}
                        </td>

                        <!-- * Loan Amount -->
                        <td>
                            {{ $mlist['loanAmount'] }}
                        </td>
        
                        <!-- * Terms of Payment -->
                        <td>
                           
                        </td>
        
                        <!-- * Interest -->
                        <td style="text-align: end;">
                                
                        </td>
        
                        <!-- * Table View and Trash Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <a href="{{ URL::to('/') }}/tranactions/application/view/{{ $mlist['naid'] }}" class="a-btn-view-3" data-view-ci>Review</a>                                
                            </div>
                        </td>
                    
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-required" style="text-align: center; padding: 20px;">No application found</td>
                    </tr>    
                @endif
                <!-- * Table Data -->                                                
            </table>
            
            </div>

        </div>

    </div>
    
    </div>

</div>
<script>
        
        const filterMemberModal = document.querySelector('[data-filter-member-modal]')

        if (filterMemberModal) {
            
            const openFilterMemberModal = document.querySelector('[data-open-filter-member-modal]')
            const closeFilterMemberModal = document.querySelector('[data-close-filter-member-modal]')
            const saveFilterMemberModal = document.querySelector('[data-save-filter-member-modal]')
            
            openFilterMemberModal.addEventListener('click', () => {
                filterMemberModal.showModal()
            })
            
            closeFilterMemberModal.addEventListener('click', () => {
                filterMemberModal.setAttribute("closing", "");
                filterMemberModal.addEventListener("animationend", () => {
                    filterMemberModal.removeAttribute("closing");
                    filterMemberModal.close();
                }, { once: true });
            
            })
            
            saveFilterMemberModal.addEventListener('click', () => {
                filterMemberModal.setAttribute("closing", "");
                filterMemberModal.addEventListener("animationend", () => {
                    filterMemberModal.removeAttribute("closing");
                    filterMemberModal.close();
                }, { once: true });
            
            })

        }
    </script>