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
    <button class="button-2" data-printables-button>PRINT</button>
</div>

<!-- * Printables Container -->
<div class="printables-container">

    <!-- * Page 1 -->

    <div class="page page-1" style="width: 297mm; min-height: 297mm;" data-printables>
        @if ($areaDetails)
            @php
                $cnt = 0;
                $cntheader = 0;
                $countme = 0;
            @endphp
            @foreach ($areaDetails as $mdetails)
                @php
                    $countme = $countme + 1;
                @endphp
                @if ($cntheader == 0)
                    <div class="header-wrapper">
                        <p>Field Officer: <span id="printFieldOfficerName">{{ $areaDetails[0]['fieldOfficer'] }}</span>
                        </p>
                        <p><span id="printAreaNum">{{ $areaDetails[0]['areaName'] }}</span></p>
                        <p>Collection List Number <span
                                id="printCollectionListNumber">{{ $areaDetails[0]['area_RefNo'] }}</span></p>
                    </div>
                    <div class="body-wrapper">
                @endif
                @if ($cnt == 0)
                    <div class="box-wrapper">
                @endif
                <div class="box">
                    <p>Client No: <span id="printClientNo">{{ $mdetails['cno'] }}</span></p>
                    <p>Name: <span id="printClientName">{{ $mdetails['borrower'] }}</span></p>
                    @php
                        $realeseDate = new DateTime($mdetails['releasingDate']);
                        $dueDate = new DateTime($mdetails['dueDate']);
                    @endphp
                    <p>Date Released: <span id="printDateReleased">{{ $realeseDate->format('F d, Y') }}</span></p>
                    <p>Due Date: <span id="printDueDate">{{ $dueDate->format('F d, Y') }}</span></p>
                    <p>Collectible: <span
                            id="printCollectible">{{ number_format($mdetails['dailyCollectibles'], 2) }}</span></p>
                    <p>Balance: <span id="printBalance">{{ number_format($mdetails['amountDue'], 2) }}</span></p>
                    <p>Overall Savings: <span
                            id="printOverallSavings">{{ number_format($mdetails['totalSavingsAmount'], 2) }}</span> </p>
                    <p>Balance Savings: <span id="printBalanceSavings"></span></p>
                    <p>Savings Payment: <span id="printSavingsPayment"></span></p>
                    <p>Advance / Lapses: <span
                            id="printAdvanceOrLapses">{{ $mdetails['advancePayment'] > 0 ? number_format($mdetails['advancePayment'], 2) : number_format($mdetails['lapsePayment'], 2) }}</span>
                    </p>
                </div>

                @php
                    $cnt = $cnt + 1;
                    if ($cnt == 4) {
                        $cnt = 0;
                    }
                    $cntheader = $cntheader + 1;
                    if ($cntheader == 8) {
                        $cntheader = 0;
                    }
                @endphp
                @if ($cnt == 0)
    </div>
    @endif
    @if (count($areaDetails) == $countme)
        @if ($cnt == 0)
            <div class="box-wrapper">
        @endif
        @for ($x = 1; $x <= 4 - $cnt; $x++)
            <div class="box" style="border: none; outline: none;">
            </div>
        @endfor
        @if ($cnt == 0)
        <!-- </div> -->
        @endif
    @endif

@if ($cntheader == 0)
    </div>
    </div>
@else
    @if (count($areaDetails) == $countme)
        </div>
        </div>
        @if ($cntheader > 4)
            </div>
        @endif
    @endif
@endif
@endforeach
@endif
</div>
<!-- * Page 2 -->
<div class="page page-2 page-break-after" style="width: 297mm; min-height: 209mm;">
    <div class="body-wrapper">
        <!-- * Table Container -->
        <div class="table-container">

            <!-- * Collection Table -->
            <table id="printCollectionTable">

                <!-- * Table Header -->
                <thead>
                    <tr>
                        <th colspan="8">
                            <div class="header-wrapper">
                                <p>Field Officer: <span
                                        id="printFieldOfficerName">{{ $areaDetails[0]['fieldOfficer'] }}</span></p>
                                <p><span id="printAreaNum">{{ $areaDetails[0]['areaName'] }}</span></p>
                                <p>Collection List Number <span
                                        id="printCollectionListNumber">{{ $areaDetails[0]['area_RefNo'] }}</span></p>
                            </div>
                        </th>
                    </tr>
                    <tr>

                        <!-- * Client No. -->
                        <th>
                            <span class="th-name">Client No.</span>
                        </th>

                        <!-- * Borrower -->
                        <th>
                            <span class="th-name">Borrower</span>
                        </th>

                        <!-- * Co-borrower -->
                        <th>
                            <span class="th-name">Co-borrower</span>
                        </th>

                        <!-- * Principal Loan -->
                        <th>
                            <div class="th-wrapper">
                                <span class="th-name">Principal Loan</span>
                            </div>
                        </th>

                        <!-- * Balance -->
                        <th>
                            <div class="th-wrapper">
                                <span class="th-name"> Balance</span>
                            </div>
                        </th>

                        <!-- * Savings -->
                        <th>
                            <div class="th-wrapper">
                                <span class="th-name"> Savings</span>
                            </div>
                        </th>

                        <!-- * Collection -->
                        <th>
                            <div class="th-wrapper">
                                <span class="th-name">Collection</span>
                            </div>
                        </th>

                        <!-- * Advance / Lapses  -->
                        <th>
                            <div class="th-wrapper">
                                <span class="th-name">Advance / Lapses </span>
                            </div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @if ($areaDetails)
                        @foreach ($areaDetails as $mdetails)
                            @php
                                $realeseDate = new DateTime($mdetails['releasingDate']);
                                $dueDate = new DateTime($mdetails['dueDate']);
                            @endphp
                            <tr>

                                <td>
                                    <!-- * Client No. -->
                                    <div class="td-wrapper">
                                        <span class="td-num"></span>
                                    </div>

                                </td>

                                <td>
                                    <!-- * Borrower Data-->
                                    <div class="td-wrapper">
                                        <p class="td-name">{{ $mdetails['borrower'] }}</p>
                                        <span>{{ $mdetails['cno'] }}</span>
                                    </div>
                                </td>

                                <td>
                                    <!-- * Co-Borrower Data-->
                                    <div class="td-wrapper">
                                        <p class="td-name">{{ $mdetails['co_Borrower'] }}</p>
                                        <span>{{ $mdetails['co_Cno'] }}</span>
                                    </div>
                                </td>

                                <!-- * Principal Loan -->
                                <td>
                                    <div class="td-wrapper">
                                        <p>{{ number_format($mdetails['loanPrincipal'], 2) }}</p>
                                        <span>Released: <span>{{ $realeseDate->format('F d, Y') }}</span></span>
                                        <span>Due: <span>{{ $dueDate->format('F d, Y') }}</span></span>
                                    </div>
                                </td>

                                <!-- * Balance -->
                                <td class="td-bal">
                                    <p>{{ number_format($mdetails['amountDue'], 2) }}</p>
                                </td>

                                <!-- * Savings -->
                                <td>
                                    <div class="td-wrapper">
                                        <span>
                                            Over All:
                                        </span>
                                        <span>
                                            Balance
                                        </span>
                                        <span>
                                            Payment:
                                        </span>

                                    </div>
                                </td>

                                <!-- * Collection -->
                                <td>
                                    <div class="td-wrapper">
                                        <p id="printCollectionAmount">
                                            {{ number_format($mdetails['dailyCollectibles'], 2) }}
                                        </p>
                                        <span>
                                            {{ $mdetails['typeOfCollection'] }}
                                        </span>
                                        <span>
                                            Daily Savings: <span id="printDailySavings"></span>
                                        </span>
                                    </div>
                                </td>

                                <!-- * Advance / Lapses -->
                                <td id="printAdvanceAndLapses">
                                    <p>
                                        {{ $mdetails['advancePayment'] > 0 ? number_format($mdetails['advancePayment'], 2) : number_format($mdetails['lapsePayment'], 2) }}
                                    </p>
                                </td>

                            </tr>
                        @endforeach
                        <!-- * Collection Data -->



                    @endif
                </tbody>


            </table>

        </div>

    </div>
    <!-- <div class="footer-wrapper">
            <div class="footer-inner-wrapper">
                <p> &lt;<span id="">2/2</span>&gt;</p>
            </div>
        </div> -->
</div>

</div>
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
            const {
                relatedTarget
            } = e;
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
            const {
                relatedTarget
            } = e;
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
                pages[pageNumber - 1].scrollIntoView({
                    behavior: 'smooth'
                })
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
            }, {
                once: true
            });

        })
    }

    function proceedButton(proceed, modal, url) {
        proceed.addEventListener('click', () => {
            modal.setAttribute("closing", "");
            modal.addEventListener("animationend", () => {
                modal.removeAttribute("closing");
                modal.close();
            }, {
                once: true
            });
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
        url = '/KC/transactions/new-application-passbook-print.html'
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
            count++
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
