    <div class="na-form-con">
    <!-- modals -->
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    <livewire:modals.new-application-modal  :type="''" :mid="isset($id) ? $id : ''"/> 
    <!-- modals -->

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
            <button class="transparentButton">View Trash</button>
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
                    <div class="th-wrapper">
                        <span class="th-name">Applied Loan Amount</span>
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
                       {{ $l['borrower'] }}
                    </td>

                    <!-- * Borrower Contact Number -->
                    <td>
                        {{ $l['cno'] }}
                    </td>
                        
                    <!-- * Co-Borrower -->
                    <td>
                        {{ $l['coBorrower'] }}
                    </td>

                    <!-- * Co-Borrower Contact Number -->
                    <td>
                         {{ $l['co_Cno'] }}
                    </td>

                    <!-- * Applied Loan Amount -->
                    <td class="td-num">
                        {{ $l['loanAmount'] }}
                    </td>

                    <!-- * Loan type -->
                    <td>
                        {{ $l['loanType'] }}
                    </td>

                    <!-- * Date Created -->
                    <td>
                        {{ date('m/d/Y', strtotime($l['dateCreated'])) }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            @if(isset($l['groupId']))
                                <a href="{{ URL::to('/') }}/tranactions/group/application/view/{{ $l['groupId'] }}" class="a-btn-view-3" data-view-application>View</a>
                            @else
                                <a href="{{ URL::to('/') }}/tranactions/application/view/{{ $l['naid'] }}" class="a-btn-view-3" data-view-application>View</a>
                            @endif
                            <button class="a-btn-trash-5">Trash</button>
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


            // If the dropdown filter is in the DOM
            const selected = document.querySelector('[data-filter-type-loan-select]');

            if (selected) {
                
                const optionsContainer = document.querySelector('[data-filter-type-opt-con');
                const optionsList = document.querySelectorAll('[data-filter-type-loan-opt]');
            
                selected.addEventListener("click", () => {
                    optionsContainer.classList.toggle("active");
                });
            
                optionsList.forEach(option => {
                    option.addEventListener("click", () => {
                        selected.innerHTML = option.querySelector("label").innerHTML;
                        optionsContainer.classList.remove("active");
                    });
                });

            }


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
                
            const selected = document.querySelector('[data-type-loan-select]')
            const optionsContainer = document.querySelector('[data-type-opt-con')
            const optionsList = document.querySelectorAll('[data-type-loan-opt]')

            selected.addEventListener("click", () => {
                optionsContainer.classList.toggle("active");
            });

            optionsList.forEach(option => {
                option.addEventListener("click", () => {
                    selected.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer.classList.remove("active");
                });
            });   
            
            // ** Loan Type terms
                
            const selected2 = document.querySelector('[data-type-loan-select2]')
            const optionsContainer2 = document.querySelector('[data-type-opt-con2')
            const optionsList2 = document.querySelectorAll('[data-type-loan-opt2]')

            selected2.addEventListener("click", () => {
                optionsContainer2.classList.toggle("active");
            });

            optionsList2.forEach(option => {
                option.addEventListener("click", () => {
                    selected2.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer2.classList.remove("active");
                });
            });    

            // * Linked to Individual Loan
            const individualLoanOpt = document.querySelector('[data-individual-loan-link]')
            
            individualLoanOpt.addEventListener('click', () => {
                btnToNewApp.style.visibility = 'visible'
            })

            // * Linked to New Application
            const btnToNewApp = document.querySelector('[data-link-to-newapp]')

            btnToNewApp.addEventListener('click', () => {

                const url = '/KC/transactions/new-application.html'
                window.location = url

            })  
                
            const newAppModalTable = document.getElementById('newApplicationModalTable')
            const existingMembers = newAppModalTable.querySelectorAll('td')

            existingMembers.forEach((member) => {
                const url = '/KC/transactions/new-application-view.html'

                member.closest('tr').addEventListener('click', () => {
                    window.location = url
                })
            })
            

        }

        newAppModal();
        // *** END --- New Application Modal *** //
    </script>
</div>
