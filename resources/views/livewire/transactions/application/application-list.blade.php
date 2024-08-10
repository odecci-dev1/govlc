    <div class="na-form-con">
    <!-- modals -->
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to trash the selected data'" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
    @endif
    <livewire:modals.new-application-modal  :type="''" :mid="isset($id) ? $id : ''"/> 
    <!-- modals -->
    <!-- <x-error-dialog :message="'Operation Failed. Retry'" :xmid="''" :confirmaction="session('erroraction')" :header="'Error'"></x-error-dialog>        -->
    <!-- * Filter Modal -->
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
                                    <option value="">All Types</option>
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
                    <p>From:</p>
                    <input autocomplete="off" wire:model="loanAmountFrom" type="number" placeholder="From">
                </div>

                <div class="input-wrapper-modal">
                    <p>To:</p>
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
    <!-- * Application List Containers -->
    <!-- * Container 1: User list Header, Buttons, and Searchbar -->

    <div class="nal-con-1">
        <h2>Application List</h2>
        <p class="p-1">
        Total of <span id="numOfApplicants">{{ isset($list) ? count($list) : 0 }}</span> applications
        </p>

        <!-- * Button Container -->
        <div class="container">

        <!-- * Button Wrapper -->
            <div class="wrapper">

                <!-- * Add New Button -->
                @if($usertype != 2)
                <button type="button"  class="button" id="data-open-new-application-modal"  data-nav-link>
                    <span>Add New</span>
                </button>
                @endif

            </div>

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

    <!-- * View Trash Button -->
        <div class="btn-container">
            <a href="{{ URL::to('/') }}/tranactions/trashed/application/list" class="transparentButton">View Trash</a>
        </div>
    </div>

    <!-- * Container 2: User List - Table and Pagination -->
    <div class="nal-con-2">

        <!-- * Table Container -->
        <div class="table-container">

        <!-- * User Table -->
        <table>
            <!-- * Table Header -->
            <tr >
                <!-- * Checkbox All-->
                <!-- <th>
                    <input
                    type="checkbox"
                    class="checkbox"
                    data-select-all-checkbox
                    />
                </th> -->

                <!-- * Borrower -->
                <th >
                    <div class="th-wrapper">
                        <span class="th-name" >Borrower</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Borrower Contact # -->
                <th>
                    <span class="th-name">Borrower Contact #</span>
                </th>

                <!-- * Co-Borrower -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Co-Borrower</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Co-Borrower Contact # -->
                <th>
                    <span class="th-name">Co-Borrower Contact #</span>
                </th>

                <!-- * Applied Loan Amount -->
                <th>
                    <div class="th-wrapper" style="align-items: end;">
                        <span class="th-name" style="text-align: right;">Applied Loan Amount</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Loan type -->
                <th>
                    <span class="th-name">Loan type</span>
                </th>

                <!-- * Date Created -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Date Created</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Action -->
                <th style="text-align: center;"><span class="th-name">Action</span></th>
            </tr>

            <!-- * Table Data -->
        
            @if($list)              
                @foreach($list as $l)
                <tr>

                    <!-- * Checkbox Opt -->
                    <!-- <td><input type="checkbox" class="checkbox" data-select-checkbox/></td> -->
                        
                    <!-- * Borrower -->
                    <td>
                       {{ $l->member->fullname }}. 
                    </td>

                    <!-- * Borrower Contact Number -->
                    <td>
                       {{ $l->member->Cno }}
                    </td>
                        
                    <!-- * Co-Borrower -->
                    <td>
                        {{ $l->comaker->Lnam.', '.$l->comaker->Fname.' '.(!empty($l->comaker->Suffi) ? ' '.$l->comaker->Suffix : '').' '.mb_substr($l->comaker->Mname, 0, 1).'.' }} 
                    </td>

                    <!-- * Co-Borrower Contact Number -->
                    <td>
                        {{ $l->comaker->Cno }}
                    </td>

                    <!-- * Applied Loan Amount -->
                    <td class="td-num">
                        {{ $l->detail->LoanAmount }}
                    </td>

                    <!-- * Loan type -->
                    <td>
                        {{ $l->loantype->LoanTypeName }}
                    </td>

                    <!-- * Date Created -->
                    <td>
                        {{ date('m/d/Y', strtotime($l->DateCreated)) }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            @if($l['loanTypeID'] == 'LT-02')
                                <a href="{{ URL::to('/') }}/tranactions/group/application/view/{{ $l['groupId'] }}" class="a-btn-view-3" data-view-application>View</a>
                            @else
                                <a href="{{ URL::to('/') }}/tranactions/application/view/{{ $l->NAID }}" class="a-btn-view-3" data-view-application>View</a>
                            @endif
                            <button  onclick="showDialog('{{ $l->Id }}')"  type="button" class="a-btn-trash-5">Trash</button>
                        </div>
                    </td>
                
                </tr>
                @endforeach
            @else
                    <tr>
                        <td colspan="9" class="text-required" style="text-align: center; padding: 20px;">No application found</td>
                    </tr>    
            @endif              
        </table>
        
        </div>

    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            window.showDialog = function($mid){              
                @this.call('showDialog', $mid);        
            };

            window.archive = function($mid){
                @this.call('archive', $mid);       
            };
        });

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
        // *** END --- New Application Modal *** //
    </script>
</div>
