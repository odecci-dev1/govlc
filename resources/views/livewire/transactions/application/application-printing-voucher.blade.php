<div>
   <!-- <main>
            <!-- * Print Collection Modal -->
            <!-- <div class="print-collection-container"> -->

            <!-- * Query Modal -->
            <dialog class="asking-modal" data-query-modal>

                <div class="modal-container">

                    <!-- * Modal Header  -->
                    <div class="modal-header">
                        <h4>Proceed</h4>
                    </div>

                    <!-- * Modal Body -->
                    <div class="rowspan">
                        <img src="{{ URL::to('/') }}/assets/icons/modal-icon/asking.svg" alt="Asking">
                        <p>Are you sure you want to proceed?</p>
                    </div>

                    <!-- * Yes or No Button -->
                    <div class="rowspan">
                        <button class="modalButton" data-proceed-print-passbook-button>Yes</button>
                        <button class="modalButton" data-close-query-modal>No</button>
                    </div>

                </div>

            </dialog>  


                <div class="page-panel" data-page-panel>
                    <div class="panel-inner-wrapper">
                        <!-- <p> &lt;<span data-current-page-num>1</span>/<span data-total-page-num>2</span>&gt;</p> -->
                        <p>Page 
                            <input type="number" value="" data-current-page-num>
                            <!-- <span data-current-page-num> 1 </span> -->
                            <span>/</span> 
                            <span data-total-page-num> 2 </span>
                        </p>
                    </div>
                    <button class="button-2 button-opt done" data-open-query-modal>PROCEED</button>
                    <button class="button-2" data-printables-button>PRINT</button>
                </div>

                <!-- * Printables Container -->
                <div class="printables-container">

                    <!-- * Page 1 -->
                    <div class="page page-1" data-printables>
                        <div class="receipt-voucher-container">
                            <div class="header-wrapper">
                                <div class="box">
                                    <img src="{{ URL::to('/') }}/assets/icons/nav-logo.svg" alt="">
                                    <p>Gold One Victory Financing Corporation Santol Balagtas Bulacan</p>
                                </div>
                                <p>Receipt Voucher</p>
                            </div>
                            <div class="body-wrapper">
                                <div class="box-wrapper">
                                    <!-- * Box-1 -->
                                    <div class="box">
                                        <p>NAME: <span id="printClientName"> {{ $loansummary['fname'] }}, {{ $loansummary['lname'] }} {{ mb_substr($loansummary['mname'], 0, 1) }}</span></p>
                                        <p class="p-bold">AREA 6</p>
                                        <div class="box-inner">
                                            <div class="box-inner-wrapper">
                                                <p>DATE:</p> 
                                                <span id="printDate">{{ isset($loansummary['date']) ? date('F j, Y', strtotime($loansummary['date'])) : 'not found' }}</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>DUE-DATE:</p> 
                                                <span id="printDueDate">{{ isset($loansummary['date']) ? date('F j, Y', strtotime($loansummary['date'])) : 'not found' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- * Box-2 -->
                                    <div class="box">
                                        <div class="box-inner">
                                            <div class="box-inner-wrapper">
                                                <p>LOAN AMOUNT:</p>
                                                <span id="">{{ isset($loansummary['principalLoan']) ? number_format($loansummary['principalLoan'], 2) : 'not found' }}</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>INTEREST RATE:</p>
                                                <span id="">{{ isset($loansummary['interestRate']) ? $loansummary['interestRate'] * 100 : 'not found' }}%</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>NOTARIAL FEE:</p>
                                                <span id=""></span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>LOAN INSURANCE:</p>
                                                <span id=""></span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>LOAN RECEIVABLE:</p>
                                                <span id=""></span>
                                            </div>
                                            <div class="box-inner-wrapper p-red-text">
                                                <p class="p-red-text">FIRST PAYMENT:</p>
                                                <span id="">{{ isset($loansummary['advancePayment']) ? number_format($loansummary['advancePayment'], 2) : 'not found' }}</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>HOLIDAYS:</p>
                                                <span id=""></span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>USED SAVINGS:</p>
                                                <span id=""></span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>LIFE INSURANCE:</p>
                                                <span id=""></span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>DEDUCTED INTEREST:</p>
                                                <span id=""></span>
                                            </div>
                                        </div>
                                        <div class="box-inner">
                                            <p>{{ isset($loansummary['loanAmount']) ? number_format($loansummary['loanAmount'], 2) : 'not found' }}</p>
                                            <p>{{ isset($loansummary['total_InterestAmount']) ? number_format($loansummary['total_InterestAmount'], 2) : 'not found' }}</p>
                                            <p>{{ isset($loansummary['notarialFee']) ? number_format($loansummary['notarialFee'], 2) : 'not found' }}</p>
                                            <p class="underline">{{ isset($loansummary['loanInsurance']) ? number_format($loansummary['loanInsurance'], 2) : 'not found' }}</p>
                                            <p class="p-bold underline-thick">{{ isset($loansummary['approvedReleasingAmount']) ? number_format($loansummary['approvedReleasingAmount'], 2) : 'not found' }}</p>
                                            <p>&nbsp;</p>
                                            <p>holidays</p>
                                            <p>used saving</p>
                                            <p>life insurance</p>
                                            <p>deducted interest</p>
                                        </div>
                                    </div>
                                    <!--  Box-3 -->
                                    <!-- <div class="box">
                                        <p class="p-red-text">FIRST PAYMENT: <span id="">138</span></p>
                                    </div> -->
                                    <!-- * Box-3 -->
                                    <div class="box">
                                        <div class="box-inner">
                                            <div class="box-inner-wrapper">
                                                <p>PREPARED BY:</p>
                                                <span id="">{{ session()->get('auth_name') }}</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>APPROVED BY:</p>
                                                <span id="">{{ isset($loansummary['app_ApprovedBy_2']) ? $loansummary['app_ApprovedBy_2'] : 'not found' }}</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>RELEASED THRU CASH</p>
                                            </div>
                                        </div>
                                        <div class="box-inner">
                                            <div class="box-inner-wrapper">
                                                <p>RECEIVED FROM:</p>
                                                <span id="">GOLD ONE VICTORY LENDING CORPORATION</span>
                                            </div>
                                            <div class="box-inner-wrapper">
                                                <p>AMOUNT RECEIVED:</p> 
                                                <span id="">{{ isset($loansummary['approvedReleasingAmount']) ? number_format($loansummary['approvedReleasingAmount'], 2) : 'not found' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- * Box-4 -->
                                    <div class="box">
                                        <div class="box-inner">
                                            <p class="p-bold line-sig">CO-MAKER</p>
                                            <p>CONTACT NO.</p>
                                        </div>
                                        <div class="box-inner">
                                            <p class="p-bold line-sig">CLIENT</p>
                                            <p>CONTACT NO.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            <!-- </div> -->
    <!-- </main> -->
    <script src="../../res/js/app.js" defer></script>
    <script>
        const printablesContainer = document.querySelector('[data-printables-button]')

        if (printablesContainer) {
            printablesContainer.addEventListener('click', () => {
                window.print()
            })
        }



        const pages = document.querySelectorAll('.page')
        const pagePanel = document.querySelector('[data-page-panel]')
        const spanCurrentPageNum = document.querySelector('[data-current-page-num]')
        const spanTotalPageNum = document.querySelector('[data-total-page-num]')

        // * Page Counter
        pageCount = 0;

        if (spanTotalPageNum) {
            spanTotalPageNum.innerText = pages.length
        }

        if (pagePanel) {
            pagePanel.addEventListener('mouseover', () => {
                pagePanel.classList.add('show-page-panel')
            })
            
            pagePanel.addEventListener('mouseout', (e) => {
                const { relatedTarget } = e;
                if (!pagePanel.contains(relatedTarget)) {
                    pagePanel.classList.remove('show-page-panel')
                }
            })
        }


        pages.forEach(page => {
            if (page) {
                page.classList.add('page-break-after')
            }
            pageCount++
            page.setAttribute('id', `Page${pageCount}`)

            page.addEventListener('mouseover', () => {
                pagePanel.classList.add('show-page-panel')
            })

            page.addEventListener('mouseout', (e) => {
                const { relatedTarget } = e;
                if (!page.contains(relatedTarget)) {
                    pagePanel.classList.remove('show-page-panel')
                }
            })


        })

        // * Intersection Observer for Page Number
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // * Extract the page number from the ID attribute
                    const pageNumber = entry.target.id.replace('Page', '');
                    
                    // * Display the current page number
                    spanCurrentPageNum.value = pageNumber;
                }
            })
        }, {
            threshold: 0.4
        })

        pages.forEach(page => {
            observer.observe(page)
        })

        // * Add functionality to go to a specific page
        if (spanCurrentPageNum) {
            spanCurrentPageNum.addEventListener('input', () => {
                const pageNumber = parseInt(spanCurrentPageNum.value);
                
                // * Validate input
                if (!isNaN(pageNumber) && pageNumber >= 1 && pageNumber <= pages.length) {
                    
                    // * Scroll to the selected page
                    pages[pageNumber - 1].scrollIntoView({ behavior: 'smooth' })
                }
            });
        }


        function openModal(open, modal) {
            open.addEventListener('click', () => {
                modal.showModal()
            })
        }

        function closeModal(close, modal) {
            close.addEventListener('click', () => {
                modal.setAttribute("closing", "");
                modal.addEventListener("animationend", () => {
                    modal.removeAttribute("closing");
                    modal.close();
                }, { once: true });
            
            })
        }

        function proceedButton(proceed, modal, url) {
            proceed.addEventListener('click', () => {
                modal.setAttribute("closing", "");
                modal.addEventListener("animationend", () => {
                    modal.removeAttribute("closing");
                    modal.close();
                }, { once: true });
                location.href = url
            })
        }


        const queryModal = document.querySelector('[data-query-modal]')

        const openQueryModalButton = document.querySelector('[data-open-query-modal]')
        const closeQueryModalButton = document.querySelector('[data-close-query-modal]')
        const proceedQueryModalButton = document.querySelector('[data-proceed-print-passbook-button]')

        // * Application Module: Receipt Voucher Button (Printables)
        // ***** Okay Button (Passbook Front)
        if (proceedQueryModalButton) {
            url = '{{ URL::to("/") }}/tranactions/application/passbook/printing/{{ $naID }}'
            openModal(openQueryModalButton, queryModal)
            closeModal(closeQueryModalButton, queryModal)
            proceedButton(proceedQueryModalButton, queryModal, url)
        }

        // ***** Back Button (Passbook Back)
        const backButton = document.querySelector('[data-passbook-back-print-button]')
        const passbookBack = document.querySelector('.page.page-2.passbook')
        const passbookFront = document.querySelector('.page.page-1.passbook')

        const doneButton = document.querySelector('[data-proceed-to-releasing-completion-button]')

        if (backButton) {
            backButton.addEventListener('click', () => {
                passbookFront.classList.remove('show');
                passbookBack.classList.add('show');
                openQueryModalButton.classList.remove('hidden');
                backButton.classList.add('hidden');

                // * Application Module: Passbook (Printables)
                // ***** Done Button (to Releasing Completion)
                if (doneButton) {
                    url = '/KC/transactions/new-application-releasing-completion.html'
                    openModal(openQueryModalButton, queryModal)
                    closeModal(closeQueryModalButton, queryModal)
                    proceedButton(doneButton, queryModal, url)
                }
            })
        }



        // * Passbook Fill-out Line
        const fillLine = document.querySelectorAll('.p-fill')

        fillLine.forEach(p => {
            const underline = document.createElement('p')
            underline.classList.add('fill-line')
            p.insertAdjacentElement('afterend', underline)
        })


        function countColumns(item, classname) {
            count = 0

            item.forEach(box => {
                count ++
                const spanNum = document.createElement('span')
                spanNum.classList.add(classname)
                spanNum.textContent = `${count}`
                box.appendChild(spanNum)
            })
        }

        // * Passbook Number of Days
        const cellNum = document.querySelectorAll('.box-cell.num')
        visible = 'visible'
        const cellNumHidden = document.querySelectorAll('.box-cell.hidden')
        hidden = 'hidden' 

        // * Visiible Numbers
        countColumns(cellNum, visible)
        // * Hidden Numbers
        countColumns(cellNumHidden, hidden)

        // const passbookBack = document.querySelector('.page-2 .passbook')

        // passbookBack.remove()
    </script>
</div>
