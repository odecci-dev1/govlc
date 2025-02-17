<div class="na-form-con">
@if(session('mmessage'))
    <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
@endif
<div wire:loading  wire:loading.delay.longer wire:target="remit,saveExpenses,areaRefNo" class="full-screen-div-loading">
        <div class="center-loading-container">
            <div>
                <div class="lds-dual-ring"></div>
            </div>
            <div class="loading-text">
                <span>Please wait . . .</span>
            </div>
        </div>        
</div>
<dialog class="fe-modal" data-field-expense-modal wire:ignore.self>
    <div class="modal-container">

        <!-- * Modal Header and Exit Button -->
        <div class="modal-header">
            <h4>Field Expenses</h4>

            <!-- * Add and Subtract Button  -->
            <div class="button-wrapper">
                <!-- <button class="button" onclick="addExpenses()">Add Expense</button> -->
                <button class="button" wire:click="addExpenses">Add Expense</button>
                <!-- <button type="button" class="addOrSubButton" onclick="subExpenses()">-</button> -->
                <button type="button" class="addOrSubButton" wire:click="subExpenses">-</button>
            </div>
              
        </div>

        <!-- * Add Expenses -->
        <div class="box-wrap" data-expenses-container>
            <div class="rowspan child" data-expenses>

                @if($expcnt)
                    @foreach($expcnt as $cnt)
                        <!-- * Expense Description -->
                        <div class="input-wrapper">
                            <input autocomplete="off" wire:model.lazy="expenses.expense{{ $cnt }}" class="input" type="text" placeholder="Expense Description">
                            @error('expenses.expense'.$cnt) <span class="text-required fw-normal" style="margin-bottom: 0;">{{ $message }}</span> @enderror
                        </div>

                        <!-- * Amount -->
                        <div class="input-wrapper-add" style="margin-bottom: 2rem;">
                            <div class="inner-container-wrapper">
                                <!-- * Input Inner Wrapper -->
                                <div class="input-inner-wrapper">
                                    <input autocomplete="off" wire:model.lazy="expenses.amount{{ $cnt }}" wire:blur="getTotalExp" class="input" type="number" placeholder="Amount">
                                   
                                </div>
                            </div>
                            @error('expenses.amount'.$cnt) <span class="text-required fw-normal" style="margin-bottom: 0;">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        <!-- * Total -->
        <div class="box-wrap">
            <p>Total <span id="totalFieldExpense">{{ $totalexp }}</span></p>
        </div>

        <!-- * Cancel and Save Button -->
        <div class="box-wrap">
            <button class="a-btn-trash" wire:click="cancelExpenses" data-close-field-expense-modal>Cancel</button>
            <button class="button" wire:click="saveExpenses">Save</button>
        </div>

    </div>

</dialog>

<!-- * Remit Modal -->
<dialog class="re-modal" data-remit-modal wire:ignore.self>

    <div class="modal-container">

        <!-- * Modal Header and Exit Button -->
        <div class="modal-header">
            <h4>Remittance</h4>
        </div>

        <!-- * Box-wrap: Amount Collected, Savings, Lapses, Advance, and Mode of Payment -->
        <div class="box-wrap">

            <!-- * Amount Collected -->
            <div class="input-wrapper">

                <span>Amount Collected</span>
                <input autocomplete="off" type="number" wire:model.lazy="reminfo.amntCollected"  wire:blur="computeLapses" name="amntCollected">
                <p style="color:red;margin-top:5px">{{$remitUsingAdvanceValidation}}</p>
                @if($appdtl)
                <br>
                    <span>Available Advance Payment: {{ $appdtl['advancePayment'] }}</span>
                    <p>Enter 0 as collected amount to use advance payment as full.</p>
                @endif
                
                @error('reminfo.amntCollected') <span class="text-required fw-normal">{{ $message }}</span>@enderror
            </div>

            <!-- * Savings -->
            <div class="input-wrapper">
                <span>Savings</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.savings" name="savings">
                @error('reminfo.savings') <span class="text-required fw-normal">{{ $message }}</span>@enderror
            </div>

            <!-- * Lapses -->
            <div class="input-wrapper">
                <span>Lapses</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.lapses" name="lapses" disabled>
                @error('reminfo.lapses') <span class="text-required fw-normal">{{ $message }}</span>@enderror
            </div>

            <!-- * Advance -->
            <div class="input-wrapper">
                <span>Advance</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.advance" name="advance" disabled>
                @error('reminfo.advance') <span class="text-required fw-normal">{{ $message }}</span>@enderror
            </div>

            <!-- * Mode of Payment -->
            <div class="input-wrapper">
                <span>Mode of Payment</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.modeOfPayment" name="mod">
                @error('reminfo.modeOfPayment') <span class="text-required fw-normal">{{ $message }}</span>@enderror
            </div>
        
        </div>

        <!-- * Cancel and Save Button -->
        <div class="box-wrap">
            <button class="a-btn-trash" wire:click="resetRemittance" data-close-remit-modal>Cancel</button>
            <button wire:click="remit" class="button">Save</button>
        </div>

    </div>

</dialog>
    <!-- * Collection List Containers -->
    <!-- * Container 1: User list Header, Buttons, and Searchbar -->

    <div class="nal-con-1">       
        <h2>Reference Number</h2>
        <div class="input-wrapper">
            <div class="select-box" style="display: inline;">
                <select  wire:model="areaRefNo" class="select-option" style="padding-left: 3rem;padding-right: 3rem; margin-top: 1rem;">
                    @if(!empty($arealist))
                        @foreach($arealist as $alist)
                            <option value="{{ $alist['areaRefNo'] }}">{{ $alist['areaRefNo'] }}</option>                                   
                        @endforeach
                    @endif                            
                </select>   
            </div>
        </div>

        <!-- * Button Container -->
        <div class="container">

            <!-- * Button Wrapper -->
            <div class="wrapper">
                <!-- * Field Expenses Button -->
                <button class="button" data-open-field-expense-modal style="height: 3.5rem;">
                    <span>FIELD EXPENSES</span>
                </button>                                
            </div>

            <!-- * Filter & Search Wrapper -->
            <div class="wrapper">
                <!-- * Filter Button -->                     
                <!-- * Collection Officer Search Bar -->        
            </div>
        </div>

    </div>

    <div class="nal-con-1-mobile">    
        <h2>Reference Number</h2>
        <div class="input-wrapper">
            <div class="select-box" style="display: inline;">
                <select  wire:model="areaRefNo" class="select-option" style="padding-left: 1rem;padding-right: 1rem; font-size: 1.2rem">
                    @if(!empty($arealist))
                        @foreach($arealist as $alist)
                            <option value="{{ $alist['areaRefNo'] }}">{{ $alist['areaRefNo'] }}</option>                                   
                        @endforeach
                    @endif                            
                </select>   
            </div>
        </div>
      
        <!-- * Button Container -->
        <div class="container">

            <!-- * Button Wrapper -->
            <div class="wrapper" style="padding-left: 1.5rem;"> 
                <!-- * Field Expenses Button -->
                <button class="button-2" data-open-field-expense-modal data-mobile-toggle-total-footer style="height: 3.5rem; margin-top: 1rem;">
                    <span>Field Expenses</span>
                </button>              
            </div>

            <!-- * Filter & Search Wrapper -->
            <div class="wrapper">

                <!-- * Filter Button -->
                <button data-open-filter-member-modal>
                    <img src="{{ URL::to('/') }}/assets/icons/filter.svg" alt="filter" />
                </button>

                <!-- * Collection Officer Search Bar -->
                <div class="primary-search-bar">
                    <div class="row">
                        <input type="search" id="searchInput" name="search" placeholder="Search"
                            autocomplete="off">
                        <button>
                        </button>
                    </div>
                    <div class="result-box" data-search-results>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- * Container 2: User List - Table and Pagination -->
    <div class="clr-con-2">

        <!-- * Table Container -->
        <div class="table-container">

            <!-- * User Table -->
            <table>

                <!-- * Table Header -->
                <tr>

                    <!-- * Checkbox ALl-->
                  
                    <!-- * Name -->
                    <th><span class="th-name">Borrower</span></th>

                    <!-- * Collectible -->
                    <th><span class="th-name">Collectible</span></th>

                    <!-- * Savings -->
                    <th>
                        <span class="th-name">Savings</span>
                    </th>

                    <!-- * Lapses -->
                    <th>
                        <span class="th-name">Lapses</span>
                    </th>

                    <!-- * Advance -->
                    <th>
                        <span class="th-name">Advance</span>
                    </th>

                    <!-- * Mode of Payment -->
                    <!-- <th>
                        <div class="th-wrapper">
                            <span class="th-name">Mode of Payment</span>
                        </div>
                    </th> -->

                    <!-- * Action -->
                    <th><span class="th-name">Action</span></th>
                </tr>
                <!-- dito -->
                <!-- * All Members Data -->
                @if($list)
                    @php
                        $cnt = 0;
                    @endphp
                    @foreach($list as $l)
                    <tr>

                        <!-- * Checkbox -->                      

                        <!-- * Name -->
                        <td>
                            <div class="td-wrapper">
                                @if(file_exists(public_path('storage/members_profile/'.(isset($l['filePath']) ? $l['filePath'] : 'xxxx'))))                                  
                                    <img src="{{ asset('storage/members_profile/'.$l['filePath']) }}" alt="upload-image" style="height: 4rem; width: 4rem;" />                                                                                                                 
                                @else
                                    <img src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" style="height: 4rem; width: 4rem;" />                                               
                                @endif                                                           
                                <span class="td-name">{{ $l['borrower'] }}</span>
                            </div>
                        </td>

                        <!-- * Co-Makers Data-->
                        <!-- <td>
                                <div class="td-wrapper">
                                    <img src="{{ URL::to('/') }}/assets/icons/sample-dp/CoMaker-2.svg" alt="">
                                    <span class="td-name">Barbosa, June</span>
                                </div>
                            </td> -->

                        <!-- * Collectible -->
                        <td>{{ number_format($l['dailyCollectibles'], 2) }}</td>

                        <!-- * Savings -->
                        <td>{{ number_format((is_numeric($l['totalSavingsAmount']) ? $l['totalSavingsAmount'] : 0), 2) }}</td>

                        <!-- * Lapses -->
                        <td>{{ number_format($l['lapsePayment'], 2) }}</td>

                        <!-- * Advance -->
                        <td>{{ number_format($l['advancePayment'], 2) }}</td>

                        <!-- * Mode of Payment -->
                        <!-- <td>350.00</td> -->

                        <!-- * Table View and Trash Button -->
                        <td class="td-btns">
                            <div class="td-btn-wrapper">
                                <button wire:click="setRemmittInfo('{{ $l['naid'] }}', '{{ $l['memId'] }}', {{ $l['dailyCollectibles'] }} , {{ $cnt }})" type="button" class="a-btn-view-3" data-open-remit-modal>Remit</button>
                            </div>
                        </td>

                    </tr>
                    @php
                        $cnt = $cnt + 1;
                    @endphp
                    @endforeach
                @endif                    
            </table>
        </div>

        <!-- * Total Remittance Footer -->       

    </div>

    <!-- * Container 2: User List Mobile View -->
    <div class="clr-con-2-mobile">
        <!-- dito mobile-->
        <div class="container">
            @if($list)
            @php
            $cnt = 0;
        @endphp
                @foreach($list as $l)
                <div class="inner-container">
                    <div class="inner-wrapper">
                        <div class="box" style="width: 20%; padding-left: 1rem;">
                            <!-- <img src="/res/assets/icons/sample-dp/Borrower-1.svg" alt="Display Picture"> -->
                            @if(file_exists(public_path('storage/members_profile/'.(isset($l['filePath']) ? $l['filePath'] : 'xxxx'))))                                  
                                <img src="{{ asset('storage/members_profile/'.$l['filePath']) }}" alt="upload-image" style="height: 4rem; width: 4rem;" />                                                                                                                 
                            @else
                                <img src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" style="height: 4rem; width: 4rem;" />                                               
                            @endif               
                        </div>
                        <div class="box" style="width: 80%;">
                            <p>{!! $l['borrower'] !!}</p>
                            <p>Client No: <span>{!! $l['cno'] !!}</span></p>
                            <p>Collectible: <span>{{ number_format($l['dailyCollectibles'], 2) }}</span></p>
                        </div>
                        <div class="box" style="padding-right: 1rem;">
                            <!-- <button class="button-2" data-open-remit-modal>Remit</button> -->
                            <button wire:click="setRemmittInfo('{{ $l['naid'] }}', '{{ $l['memId'] }}', {{ $l['dailyCollectibles'] }},{{ $cnt }} )" type="button" class="button-2" data-open-remit-modal>Remit</button>
                        </div>
                    </div>
                    <div class="inner-wrapper" data-show-more-details-field-exp>
                        <div class="expandable">
                            <div class="box">
                                <p>Amount Collected</p>
                                <p>350.00</p>
                            </div>
                            <div class="box">
                                <p>Savings</p>
                                <p>350.00</p>
                            </div>
                            <div class="box">
                                <p>Lapse/Advance</p>
                                <p>350.00</p>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                        $cnt = $cnt + 1;
                    @endphp
                @endforeach 
            @endif            
        </div>

        <div class="mobile-total-remittance-footer" data-total-remittance-footer-mobile>
            <div class="container">
                <div class="box">
                    <p>Total Collection</p>
                    <p>350.00</p>
                </div>
                <div class="box">
                    <p>Total Lapses</p>
                    <p>350.00</p>
                </div>
                <div class="box">
                    <p>Total Expenses</p>
                    <p>350.00</p>
                </div>
                <div class="box">
                    <p>Total Savings</p>
                    <p>350.00</p>
                </div>
                <div class="box">
                    <p>Total Advance</p>
                    <p>350.00</p>
                </div>
                <div class="box">
                    <p>Mode of payments</p>
                    <p>Cash, GCash</p>
                </div>
            </div>
        </div>

    </div>
    </div>

<script>
    // ***** Field Expense Modal ***** //

    const fieldExpenseModal = document.querySelector('[data-field-expense-modal]')
    const openFieldExpenseBtn = document.querySelectorAll('[data-open-field-expense-modal]')
    const closeFieldExpenseBtn = document.querySelector('[data-close-field-expense-modal]')
    const saveFieldExpenseBtn = document.querySelector('[data-save-field-expense-modal]')

    // * For toggling for Total Remittance Footer
    const totalRemittanceFooter = document.querySelector('[data-total-remittance-footer]')
    const totalRemittanceFooterMobile = document.querySelector('[data-total-remittance-footer-mobile]')
    const showMoreDetailsFieldExp = document.querySelectorAll('[data-show-more-details-field-exp]')


    if (fieldExpenseModal) {

        openFieldExpenseBtn.forEach((button) => {
            button.addEventListener('click', () => {
                fieldExpenseModal.showModal()
            })
        })

        closeFieldExpenseBtn.addEventListener('click', () => {
            fieldExpenseModal.setAttribute("closing", "");
            fieldExpenseModal.addEventListener("animationend", () => {
                fieldExpenseModal.removeAttribute("closing");
                fieldExpenseModal.close();
            }, {
                once: true
            });

        })

        // * Toggle Attributes
        function toggleAttributes() {

            const isMobile = window.innerWidth <= 430

            // * If mobile viewport
            // if (isMobile) {
            //     saveFieldExpenseBtn.removeAttribute('data-save-field-expense-modal');
            //     saveFieldExpenseBtn.setAttribute('data-show-total-remittance', '');

            // } else {

            //     saveFieldExpenseBtn.removeAttribute('data-show-total-remittance', '');
            //     saveFieldExpenseBtn.setAttribute('data-save-field-expense-modal', '');

            // }

            // if (saveFieldExpenseBtn.matches('[data-save-field-expense-modal]')) {
            //     saveFieldExpenseBtn.addEventListener('click', () => {
            //         showMoreDetailsFieldExp.forEach((button) => {
            //             button.classList.add('show-more-details')
            //         })
            //         totalRemittanceFooter.classList.add('show-remittance-footer')
            //         totalRemittanceFooterMobile.setAttribute("show", "")
            //         fieldExpenseModal.setAttribute("closing", "")
            //         fieldExpenseModal.addEventListener("animationend", () => {
            //             fieldExpenseModal.removeAttribute("closing")
            //             fieldExpenseModal.close();
            //         }, {
            //             once: true
            //         });
            //     })

            // }

        }

        window.addEventListener('resize', toggleAttributes)
        toggleAttributes()

    }

    // ***** END ---- Field Expense Modal ***** //

    // ***** Add and Subtract Field Expenses ***** //

    // * Add Expenses

    cloneCount = 0;

    function addExpenses() {

        const expensesForm = document.querySelector('[data-expenses]')
        const expensesContainer = document.querySelector('[data-expenses-container]')

        expensesForm.setAttribute('id', 'expenses-1')

        // * Clone the original element
        const clonedChild = expensesForm.cloneNode(true)

        // * Increment the clone count and modify the ID
        cloneCount++
        const newId = `expenses-${cloneCount}`
        clonedChild.id = newId

        // * Hide the increment button
        // clonedChild.lastElementChild.lastElementChild.lastElementChild.children[0].style.visibility = 'hidden'

        // * Append the cloned element to the target container
        expensesContainer.appendChild(clonedChild)

    }

    // * Subtract Expenses
    function subExpenses() {

        const expensesContainer = document.querySelector('[data-expenses-container]')

        // * Reset cloneCount when decrement
        cloneCount = 1

        // * Remove the the next sibling of appliance-1
        if (expensesContainer.firstElementChild.nextElementSibling !== null) {
            expensesContainer.lastElementChild.remove()
        }

    }

    // ***** END ---- Add and Subtract Expenses ***** //

    // ***** Remit Modal ***** //

    const remitModal = document.querySelector('[data-remit-modal]')
    const openRemitModalBtn = document.querySelectorAll('[data-open-remit-modal]')
    const closeRemitModalBtn = document.querySelector('[data-close-remit-modal]')
    const saveRemitModalBtn = document.querySelector('[data-save-remit-modal]')
    const linkToRemittedAllBtn = document.querySelector('[data-link-to-remitted-all]')

    // ***** For Mobile Devices ***** //
    const showRemittedBtn = document.querySelector('[data-show-remitted-button]')

    if (remitModal) {
        openRemitModalBtn.forEach((button) => {
            button.addEventListener('click', () => {
                remitModal.showModal()

                saveRemitModalBtn.addEventListener('click', () => {
                    button.innerText = ''
                    button.classList.add('remitted')
                })
            })
        })

        closeRemitModalBtn.addEventListener('click', () => {
            remitModal.setAttribute("closing", "");
            remitModal.addEventListener("animationend", () => {
                remitModal.removeAttribute("closing");
                remitModal.close();
            }, {
                once: true
            });
        })

        if (saveRemitModalBtn) {
            saveRemitModalBtn.addEventListener('click', () => {
                remitModal.setAttribute("closing", "");
                remitModal.addEventListener("animationend", () => {
                    remitModal.removeAttribute("closing");
                    remitModal.close();
                }, {
                    once: true
                });
            })
        }

    }

    // ***** END ---- Remit Modal ***** //


    // ***** Collection Summary Modal ***** //

    const collectionSummaryModal = document.querySelector('[data-collection-summary-modal]')
    const openCollectionSummaryBtn = document.querySelector('[data-open-collection-summary-button]')
    const closeCollectionSummaryBtn = document.querySelector('[data-close-collection-summary-button]')

    if (collectionSummaryModal) {

        openCollectionSummaryBtn.addEventListener('click', () => {
            collectionSummaryModal.showModal()
        })

        closeCollectionSummaryBtn.addEventListener('click', () => {
            collectionSummaryModal.setAttribute("closing", "");
            collectionSummaryModal.addEventListener("animationend", () => {
                collectionSummaryModal.removeAttribute("closing");
                collectionSummaryModal.close();
            }, {
                once: true
            });

        })

    }
</script>
