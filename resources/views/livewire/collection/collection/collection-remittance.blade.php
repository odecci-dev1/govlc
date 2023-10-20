<div class="na-form-con">
@if(session('mmessage'))
    <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
@endif
<dialog class="fe-modal" data-field-expense-modal>
    <div class="modal-container">

        <!-- * Modal Header and Exit Button -->
        <div class="modal-header">
            <h4>Field Expenses</h4>

            <!-- * Add and Subtract Button  -->
            <div class="button-wrapper">
                <button class="button" onclick="addExpenses()">Add Expense</button>
                <button type="button" class="addOrSubButton" onclick="subExpenses()">-</button>
            </div>

        </div>

        <!-- * Add Expenses -->
        <div class="box-wrap" data-expenses-container>
            <div class="rowspan child" data-expenses>

                <!-- * Expense Description -->
                <div class="input-wrapper">
                    <input autocomplete="off"class="input" type="text" id="expenseDesc" name="expenseDesc"
                        placeholder="Expense Description">
                </div>

                <!-- * Amount -->
                <div class="input-wrapper-add">

                    <div class="inner-container-wrapper">

                        <!-- * Input Inner Wrapper -->
                        <div class="input-inner-wrapper">
                            <input autocomplete="off" class="input" type="number" id="amount" name="amount"
                                placeholder="Amount">
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- * Total -->
        <div class="box-wrap">
            <p>Total <span id="totalFieldExpense">300</span></p>
        </div>

        <!-- * Cancel and Save Button -->
        <div class="box-wrap">
            <button class="a-btn-trash" data-close-field-expense-modal>Cancel</button>
            <button class="button" data-save-field-expense-modal>Save</button>
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
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.amntCollected"  wire:blur="computeLapses" name="amntCollected">
            </div>

            <!-- * Savings -->
            <div class="input-wrapper">
                <span>Savings</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.savings" name="savings">
            </div>

            <!-- * Lapses -->
            <div class="input-wrapper">
                <span>Lapses</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.lapses" name="lapses" disabled>
            </div>

            <!-- * Advance -->
            <div class="input-wrapper">
                <span>Advance</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.advance" name="advance" disabled>
            </div>

            <!-- * Mode of Payment -->
            <div class="input-wrapper">
                <span>Mode of Payment</span>
                <input autocomplete="off" type="text" wire:model.lazy="reminfo.modeOfPayment" name="mod">
            </div>

        </div>

        <!-- * Cancel and Save Button -->
        <div class="box-wrap">
            <button class="a-btn-trash" data-close-remit-modal>Cancel</button>
            <button wire:click="remit" class="button" data-save-remit-modal>Save</button>
        </div>

    </div>

</dialog>
    <!-- * Collection List Containers -->
    <!-- * Container 1: User list Header, Buttons, and Searchbar -->

    <div class="nal-con-1">

        <h2>Reference Number</h2>
        <p class="p-1" id="referenceNumber">
            ABPA120230525
        </p>
        <p class="p-1b" id="collectionDate">
            July 10, 2023
        </p>

        <!-- * Button Container -->
        <div class="container">

            <!-- * Button Wrapper -->
            <div class="wrapper">

                <!-- * Field Expenses Button -->
                <button class="button" data-open-field-expense-modal>
                    <span>Field Expenses</span>
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
        <p class="p-1" id="referenceNumber">
            ABPA120230525
        </p>
        <p class="p-1b" id="collectionDate">
            July 10, 2023
        </p>

        <!-- * Button Container -->
        <div class="container">

            <!-- * Button Wrapper -->
            <div class="wrapper">

                <!-- * Field Expenses Button -->
                <button class="button-2" data-open-field-expense-modal data-mobile-toggle-total-footer>
                    <span>Field Expenses</span>
                </button>

            </div>

            <!-- * Filter & Search Wrapper -->
            <div class="wrapper">

                <!-- * Filter Button -->
                <button data-open-filter-member-modal>
                    <img src="../../res/assets/icons/filter.svg" alt="filter" />
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
                    <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th>

                    <!-- * Name -->
                    <th><span class="th-name">Name</span></th>

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

                <!-- * All Members Data -->
                @if($list)
                    @foreach($list as $l)
                    <tr>

                        <!-- * Checkbox -->
                        <td><input type="checkbox" class="checkbox" id="checkbox" data-select-checkbox></td>

                        <!-- * Name -->
                        <td>
                            <div class="td-wrapper">
                                <img src="../../res/assets/icons/sample-dp/Borrower-2.svg" alt="">
                                <span class="td-num"></span>
                                <span class="td-name">{{ $l['borrower'] }}</span>
                            </div>
                        </td>

                        <!-- * Co-Makers Data-->
                        <!-- <td>
                                <div class="td-wrapper">
                                    <img src="../../res/assets/icons/sample-dp/CoMaker-2.svg" alt="">
                                    <span class="td-name">Barbosa, June</span>
                                </div>
                            </td> -->

                        <!-- * Collectible -->
                        <td>{{ number_format($l['dailyCollectibles'], 2) }}</td>

                        <!-- * Savings -->
                        <td>{{ number_format($l['totalSavingsAmount'], 2) }}</td>

                        <!-- * Lapses -->
                        <td>{{ number_format($l['lapsePayment'], 2) }}</td>

                        <!-- * Advance -->
                        <td>{{ number_format($l['advancePayment'], 2) }}</td>

                        <!-- * Mode of Payment -->
                        <!-- <td>350.00</td> -->

                        <!-- * Table View and Trash Button -->
                        <td class="td-btns">

                            <div class="td-btn-wrapper">
                                <button wire:click="setRemmittInfo('{{ $l['naid'] }}')" type="button" class="a-btn-view-3" data-open-remit-modal>Remit</button>
                            </div>

                        </td>

                    </tr>
                    @endforeach
                @endif                    
            </table>
        </div>

        <!-- * Total Remittance Footer -->
        <div class="total-remittance-footer">
            <div class="expandable" data-total-remittance-footer>
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

    <!-- * Container 2: User List Mobile View -->
    <div class="clr-con-2-mobile">

        <div class="container">
            <div class="inner-container">
                <div class="inner-wrapper">
                    <div class="box">
                        <img src="/res/assets/icons/sample-dp/Borrower-1.svg" alt="Display Picture">
                    </div>
                    <div class="box">
                        <p>Juana Dela Cruz</p>
                        <p>Client No: <span>1</span></p>
                        <p>Collectible: <span>350.00</span></p>
                    </div>
                    <div class="box">
                        <button class="button-2" data-open-remit-modal>Remit</button>
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
            <div class="inner-container">
                <div class="inner-wrapper">
                    <div class="box">
                        <img src="/res/assets/icons/sample-dp/Borrower-1.svg" alt="Display Picture">
                    </div>
                    <div class="box">
                        <p>Juana Dela Cruz</p>
                        <p>Client No: <span>1</span></p>
                        <p>Collectible: <span>350.00</span></p>
                    </div>
                    <div class="box">
                        <button class="button-2" data-open-remit-modal>Remit</button>
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
            <div class="inner-container">
                <div class="inner-wrapper">
                    <div class="box">
                        <img src="/res/assets/icons/sample-dp/Borrower-1.svg" alt="Display Picture">
                    </div>
                    <div class="box">
                        <p>Juana Dela Cruz</p>
                        <p>Client No: <span>1</span></p>
                        <p>Collectible: <span>350.00</span></p>
                    </div>
                    <div class="box">
                        <button class="button-2" data-open-remit-modal>Remit</button>
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
            if (isMobile) {
                saveFieldExpenseBtn.removeAttribute('data-save-field-expense-modal');
                saveFieldExpenseBtn.setAttribute('data-show-total-remittance', '');

            } else {

                saveFieldExpenseBtn.removeAttribute('data-show-total-remittance', '');
                saveFieldExpenseBtn.setAttribute('data-save-field-expense-modal', '');

            }

            if (saveFieldExpenseBtn.matches('[data-save-field-expense-modal]')) {
                saveFieldExpenseBtn.addEventListener('click', () => {
                    showMoreDetailsFieldExp.forEach((button) => {
                        button.classList.add('show-more-details')
                    })
                    totalRemittanceFooter.classList.add('show-remittance-footer')
                    totalRemittanceFooterMobile.setAttribute("show", "")
                    fieldExpenseModal.setAttribute("closing", "")
                    fieldExpenseModal.addEventListener("animationend", () => {
                        fieldExpenseModal.removeAttribute("closing")
                        fieldExpenseModal.close();
                    }, {
                        once: true
                    });
                })

            }

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
