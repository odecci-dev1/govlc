<div>
    <!-- modals -->
       <livewire:modals.new-application-modal  :type="''" :mid="isset($id) ? $id : ''"/> 
    <!-- modals -->

    <!-- * Filter Modal -->
    <dialog class="am-filter-modal" data-filter-member-modal>

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

                            <div class="options-container" data-filter-type-opt-con>

                                <div class="option" data-filter-type-loan-opt>

                                    <input type="radio" class="radio" name="category" />
                                    <label for="Individual Loan">
                                        <h4>Individual Loan</h4>
                                    </label>

                                </div>

                                <div class="option" data-filter-type-loan-opt>

                                    <input type="radio" class="radio" name="category" />
                                    <label for="Group Loan">
                                        <h4>Group Loan</h4>
                                    </label>

                                </div>

                                <div class="option" data-filter-type-loan-opt>

                                    <input type="radio" class="radio" name="category" />
                                    <label for="Sample Loan">
                                        <h4>Sample Loan</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" data-filter-type-loan-select>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!-- * Applied Loan Amount -->
            <div class="rowspan">

                <div class="input-wrapper-modal">
                    <span>Applied Loan Amount</span>
                    <input autocomplete="off" type="number" id="filterAppliedLoanAmntFrom" name="filterAppliedLoanAmntFrom" placeholder="From">
                </div>

                <div class="input-wrapper-modal">
                    <input autocomplete="off" type="number" id="filterAppliedLoanAmntTo" name="filterAppliedLoanAmntTo" placeholder="To">
                </div>

            </div>

            <!-- * Save Button -->
            <div class="rowspan">
                <button class="button" data-save-filter-member-modal>Save</button>
            </div>

        </div>

    </dialog>

    <div class="na-form-con">

    <!-- * Application List Containers -->
    <!-- * Container 1: User list Header, Buttons, and Searchbar -->

    <div class="nal-con-1">
    <h2>Application List</h2>
    <p class="p-1">
    Total of <span id="numOfApplicants">50</span> active users
    </p>

    <!-- * Button Container -->
    <div class="container">

    <!-- * Button Wrapper -->
    <div class="wrapper">

        <!-- * Add New Button -->
        <button type="button"  class="button" id="data-open-new-application-modal"  data-nav-link>
            <span>Add New</span>
        </button>

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
            id="search"
            name="search"
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
            <tr>
                <!-- * Checkbox All-->
                <th>
                    <input
                    type="checkbox"
                    class="checkbox"
                    data-select-all-checkbox
                    />
                </th>

                <!-- * Borrower -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Borrower</span>
                        <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
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
                        <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
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
                        <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
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
                        <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                    </div>
                </th>

                <!-- * Action -->
                <th><span class="th-name">Action</span></th>
            </tr>

            <!-- * Table Data -->
        
            @if($list)              
                @foreach($list as $l)
                <tr>

                    <!-- * Checkbox Opt -->
                    <td><input type="checkbox" class="checkbox" data-select-checkbox/></td>
                        
                    <!-- * Borrower -->
                    <td>
                       {{ $l['borrower'] }}
                    </td>

                    <!-- * Borrower Contact Number -->
                    <td>
                        {{ $l['co_Cno'] }}
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
                        Individual Loan
                    </td>

                    <!-- * Date Created -->
                    <td>
                        {{ $l['dateCreated'] }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            <a href="{{ URL::to('/') }}/tranactions/application/view/{{ $l['naid'] }}/4" class="a-btn-view-3" data-view-application>View</a>
                            <button class="a-btn-trash-5">Trash</button>
                        </div>
                    </td>
                
                </tr>
                @endforeach
            @endif                        
        </table>
        
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