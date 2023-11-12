 <div>
 <!-- * Collection Viewing Container Wrapper -->
 @php 
    $modules = session()->get('auth_usermodules');
 @endphp
 <div class="can-container-wrapper">
    <div wire:loading  wire:loading.delay class="full-screen-div-loading">
        <div class="center-loading-container">
            <div>
                <div class="lds-dual-ring"></div>
            </div>
            <div class="loading-text">
                <span>Please wait . . .</span>
            </div>
        </div>        
    </div>
     <!-- * Collection Add New Container 1 -->
     <div class="can-container-1">

         <h3>Collection</h3>

         <div class="wrapper">

             <!-- * All Areas Dropdown Button -->
             <div class="borrower-dropdown" data-bor-dropdown>
                    @php 
                           $totalAreaCollected = $areas->sum('total_collectedAmount');
                      @endphp 
                     <!-- * Summary Container total_collectedAmount -->
                     <div class="summary-container" style="visibility: {{ $totalAreaCollected > 0 ? 'visible' : 'hidden' }};" data-collection-summary-container> 
                         <p class="textPrimary" data-open-collection-summary-button>View Summary</p>
                     </div>
                <!-- * All Areas Button -->
                <!-- <div class="select-box">
                    <select  wire:model="status" class="select-option-menu">
                        <option value="">All Areas</option>     
                        <option value="Active">Active</option>                                    
                        <option value="Inactive">Inactive</option>                                    
                    </select>                       
                </div>          -->

                
             </div>

             <div class="area-menu-container">             
                 <!-- * Area Menu -->
                 <ul class="area-menu">
                    @if($areas)
                        @foreach($areas as $area)
                        @php 
                            $checkIfPaid = $area['total_collectedAmount'] > 0 ? true : false; //$areaDetails->where('areaID', $area['areaID'])->where('payment_Status', 'Paid')->first();       
                            //$checkIfPrinted = $areaDetails->where('areaID', $area['areaID'])->where('area_RefNo', '!=', 'PENDING')->first();                 
                            $checkIfPrinted = in_array($area['area_RefNo'], ['PENDING', '']) ? false : true;
                        @endphp
                        <li data-area-menu wire:click="getCollectionDetails('{{ $area['areaID'] }}', '{{ in_array($area['area_RefNo'], ['PENDING', '']) ? '' : $area['area_RefNo'] }}')" class=" {{ $checkIfPrinted ? 'paid-selected-area' : '' }}">
                            <div class="box-1">
                                <h4 id="collectionAreaNum">{{ $area['areaName'] }}</h4>
                            </div>
                            <div class="box-2" style="position: relative;">
                                <div class="inner-box-1">
                                    <p>Expected Collection</p>
                                    <span id="expectedCollection">{{ number_format($area['expectedCollection'], 2) }}</span>
                                </div>
                                <div class="inner-box-2">
                                    <p>Penalty</p>
                                    @php 
                                        $penalty = $area['expectedCollection'] - $area['total_collectedAmount'];
                                    @endphp
                                    <span id="collectionPenalty">{{ number_format(($penalty < 0 ? 0 : $penalty), 2) }}</span>
                                    @if( $checkIfPaid )
                                    <img src="{{ URL::to('/') }}/assets/icons/circle-check.svg" alt="upload-image" 
                                         style="height: 2rem; width: 2rem; position: absolute; right: 8px; bottom: 8px;" />    
                                    @endif      
                                </div>
                            </div>
                            <div class=" {{ $checkIfPrinted ? 'box-3-printed' : 'box-3' }} {{ $areaID == $area['areaID'] ? 'box-3-selected' : '' }}">
                                &nbsp;
                            </div>
                        </li>
                        @endforeach
                    @endif                    
                 </ul>
             </div>
         </div>
     </div>

     <!-- * Collection Add New Container 2 -->
     <div class="can-container-2">

         <!-- * Inner Container -->
         <div class="inner-container">

             <!-- * Inner-inner Container 1 -->
             <div class="inner-inner-container">

                 <div class="wrapper-0">
                     <!-- * Collection Officer Search Bar -->
                     <div class="primary-search-bar">
                         <div class="row">
                            <select wire:model.lazy="foid" class="select-option-menu" style="width: 40rem;{{ $areaID != '' ? '' : 'visibility: hidden;' }}">                                
                                @if($folist)
                                    @foreach($folist as $fo)
                                        <option value="{{ $fo['foid'] }}">{{ $fo['lname'] }}, {{ $fo['fname'] }} {{ substr($fo['mname'], 0, 1) }}.</option>           
                                    @endforeach
                                @endif                                  
                            </select>      
                         </div>
                         <div class="result-box" data-search-results>
                         </div>
                     </div>
          
                 </div>

                 <!-- * Details Wrapper 1 -->
                 @php
                    $countDetails = $areaDetails->where('areaID', $areaID)->count();
                    $checkArea = $areas->where('areaID', $areaID)->first();       
                 @endphp
                 <div class="wrapper-1">
                     <span>Total of {{ $countDetails }} Items</span>
                     <span>{{ $checkArea ? $checkArea['areaName'] : '' }}</span>
                     <span>Ref Number: {{ $checkArea ? (!in_array($checkArea['area_RefNo'], ['PENDING', '']) ? $checkArea['area_RefNo'] : '________________________') : '________________________' }}</span>
                 </div>

             </div>

             <!-- * Inner-inner Container 1 -->
             <div class="inner-inner-container {{ $areaID != '' ? 'show-print-remit-buttons' : '' }}" data-print-remit-buttons>    
                @php
                    $sumDetails = $areaDetails->where('areaID', $areaID)->sum('collectedAmount');                                
                @endphp
                <button type="button" style="{{ $sumDetails > 0 && $countDetails > 0 && $checkArea && $checkArea['total_collectedAmount'] <= 0 && (!in_array($checkArea['area_RefNo'], ['PENDING', ''])) ? '' : 'display: none;' }}" class="button-2-green" data-open-cash-denomination-button>Collect</button>
                <button type="button" style="{{ $sumDetails > 0 && $countDetails > 0 && $checkArea && $checkArea['total_collectedAmount'] <= 0 && (!in_array($checkArea['area_RefNo'], ['PENDING', ''])) ? '' : 'display: none;' }}" class="button-2-alert" data-open-collection-reject-button>Reject</button>
                @if($countDetails > 0)
                    @if($checkArea)
                        @if(!in_array($checkArea['area_RefNo'], ['PENDING', '']))
                        <!-- <button type="button" style="{{ $sumDetails > 0 ? '' : 'display: none;' }}" class="button-2-green" data-open-cash-denomination-button>Collect</button> -->
                        <!-- <button type="button" style="{{ $sumDetails > 0 ? '' : 'display: none;' }}" class="button-2-alert" data-open-collection-reject-button>Reject</button> -->
                        @endif                    
                    @endif                                       
                    <!-- $checkArea ? (!in_array($checkArea['area_RefNo'], ['PENDING', '']) -->
                
                    <button type="button" wire:click="print" class="button-2" data-collection-print-button>Print</button>
                
                    @if($checkArea)
                        @if(!in_array($checkArea['area_RefNo'], ['PENDING', '']))
                            @if(in_array('Module-07', $modules))
                                <a href="{{ URL::to('/') }}/collection/remittance/{{ $foid }}/{{ $checkArea['area_RefNo'] }}" class="button-2" data-collection-remit-button>Remit</a>
                            @endif  
                        @endif                 
                    @endif                
                @endif
               
             </div>

         </div>


         <!-- * Details Wrapper 2 / Table -->
         <div class="wrapper-2">

             <!-- * Table Container -->
             <div class="table-container">

                 <!-- * Client's Table -->
                 <table id="clientsTable">

                     <!-- * Table Header -->
                     <tr>

                         <!-- * Client No. -->
                         <th>
                             <span class="th-name">Client No.</span>
                         </th>

                         <!-- * Th Num -->
                         <th>
                         </th>

                         <!-- * Name -->
                         <th>
                             <span class="th-name">Name</span>
                         </th>

                         <!-- * Collectible -->
                         <th>
                             <span class="th-name">Collectible</span>
                         </th>

                         <th>
                             <span class="th-name">Collected Amount</span>
                         </th>

                         <!-- * Amount Due -->
                         <th>
                             <span class="th-name">Balance</span>
                         </th>

                         <!-- * Balance -->
                         <th>
                             <span class="th-name">Past Due</span>
                         </th>

                         <!-- * Overall Savings -->
                         <th>
                             <span class="th-name">Overall Savings</span>
                         </th>

                         <!-- * Advance / Lapses -->
                         <th>
                             <span class="th-name">Advance / Lapses</span>
                         </th>

                         <!-- * Status -->
                         <th>
                             <span class="th-name">Status</span>
                         </th>

                     </tr>


                    <!-- * Table Data -->
                   
                    @if($areaDetails)
                        @php 
                            $cnt = 0;
                        @endphp
                        @foreach($areaDetails as $mdetails)
                        @php 
                            $cnt = $cnt + 1;
                        @endphp
                        <tr data-area-menu-toggle data-details-wrapper-dropdown onclick="showDetails('{{ $cnt }}')" class="{{ $areaID != '' ? ($mdetails['areaID'] == $areaID ? 'show-area-details' : '') : '' }}" style="{{ $areaID != '' ? ($mdetails['areaID'] == $areaID ? '' : 'display:none;') : 'display:none;' }}">

                            <td>                                                            
                                @if(file_exists(public_path('storage/members_profile/'.(isset($mdetails['filePath']) ? $mdetails['filePath'] : 'xxxx'))))                                  
                                    <img src="{{ asset('storage/members_profile/'.$mdetails['filePath']) }}" alt="upload-image" style="height: 4rem; width: 4rem;" />                                                                                                                 
                                @else
                                    <img src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" style="height: 4rem; width: 4rem;" />                                               
                                @endif    
                            </td>

                            <td>
                                <span class="td-num">{{ $cnt }}</span>
                            </td>

                            <td>                             
                                <div class="td-wrapper">                                
                                    <span class="td-name">{{ $mdetails['borrower'] }}</span>
                                </div>
                            </td>

                            <!-- * Collectible  -->
                            <td>
                                {{ number_format($mdetails['dailyCollectibles'], 2) }}
                            </td>

                            <td>
                                {{ number_format($mdetails['collectedAmount'], 2) }}
                            </td>

                            <!-- * Amount Due -->
                            <td>
                                {{ number_format($mdetails['amountDue'], 2) }}
                            </td>

                            <!-- * Balance -->
                            <td>
                                {{ number_format($mdetails['pastDue'], 2) }}
                            </td>

                            <!-- * Overall Savings -->
                            <td>
                                {{ number_format($mdetails['totalSavingsAmount'], 2) }}
                            </td>

                            <!-- * Advance / Lapses -->
                            <td>
                                {{ $mdetails['advancePayment'] > 0 ? number_format($mdetails['advancePayment'], 2) : number_format($mdetails['lapsePayment'], 2) }}
                            </td>

                            <!-- * Status -->
                            <td style="text-transform: capitalize; color: {{ $mdetails['payment_Status'] == 'Paid' ? 'green' : 'red' }};">
                                {{ strtolower($mdetails['payment_Status']) }}
                            </td>

                        </tr>

                        <tr id="tr{{ $cnt }}" class="details-wrapper" data-details-wrapper>
                            <td id="td{{ $cnt }}" class="">
                                <div class="box">
                                    <h4>Client Info</h4>
                                    <div class="box-wrapper">
                                        <div class="inner-inner-box">
                                            <p>Borrower Name:</p>
                                            <p>Contact No.:</p>
                                            <p>Co-borrower:</p>
                                            <p>Contact No.:</p>
                                        </div>
                                        <div class="inner-inner-box">
                                            <p>{{ $mdetails['borrower'] }}</p>
                                            <p>{{ $mdetails['cno'] }}</p>
                                            <p>{{ $mdetails['co_Borrower'] }}</p>
                                            <p>{{ $mdetails['co_Cno'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <h4>Loan Info</h4>
                                    <div class="box-wrapper">
                                        <div class="inner-inner-box">
                                            <p>Principal Loan:</p>
                                            <p>Date Released:</p>
                                            <p>Due Date:</p>
                                            <p>Collection Date:</p>
                                            <p>Savings:</p>
                                        </div>
                                        <div class="inner-inner-box">
                                            @php
                                                $realeseDate = new DateTime($mdetails['releasingDate']);
                                                $dueDate = new DateTime($mdetails['dueDate']);
                                            @endphp   
                                            <p>{{ number_format($mdetails['loanPrincipal'], 2) }}</p>
                                            <p>{{ $realeseDate->format('F d, Y') }}</p>
                                            <p>{{ $dueDate->format('F d, Y') }}</p>
                                            <p>{{ $mdetails['typeOfCollection'] }}</p>
                                            <p>{{ number_format($mdetails['totalSavingsAmount'], 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="inner-box">
                                        <h4>Payment Info</h4>
                                        <div class="box-wrapper">
                                            <div class="inner-inner-box">
                                                <p>Daily Collectible:</p>                                             
                                            </div>
                                            <div class="inner-inner-box">
                                                <p>{{ number_format($mdetails['dailyCollectibles'], 2) }}</p>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-box">
                                        <h4>Others</h4>
                                        <div class="box-wrapper">
                                            <div class="inner-inner-box">
                                                <p>Collection Lapses:</p>
                                                <p>Advance Collection:</p>
                                            </div>
                                            <div class="inner-inner-box">
                                                <p>{{ number_format($mdetails['lapsePayment'], 2) }}</p>
                                                <p>{{ number_format($mdetails['advancePayment'], 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif    
                     

                 </table>

             </div>

             <!-- * Details Wrapper 3 -->
             <div class="wrapper-3">
                @php 
                    $footer = $areaDetailsFooter->where('areaID', $areaID)->first();
                @endphp
                 <!-- * Total Collectible: -->
                 <div class="box">
                     <p>Total Collectibles:</p>
                     <span>{{ $footer ? number_format($footer['totalCollectible'], 2) : '0.00' }}</span>
                 </div>
                 <div class="box">
                     <p>Total Collected Amount:</p>
                     <span>{{ $footer ? number_format($footer['total_collectedAmount'], 2) : '0.00' }}</span>
                 </div>
                 <!-- * Total Balance: -->
                 <div class="box">
                     <p>Total Balance:</p>
                     <span>{{ $footer ? number_format($footer['total_Balance'], 2) : '0.00' }}</span>
                 </div>
                 <!-- * Total Savings: -->
                 <div class="box">
                     <p>Total Savings:</p>
                     <span>{{ $footer ? number_format($footer['total_savings'], 2) : '0.00' }}</span>
                 </div>
                 <!-- * Total Advance: -->
                 <div class="box">
                     <p>Total Advance:</p>
                     <span>{{ $footer ? number_format($footer['total_advance'], 2) : '0.00' }}</span>
                 </div>
                 <!-- * Total Lapses: -->
                 <div class="box">
                     <p>Total Lapses:</p>
                     <span>{{ $footer ? number_format($footer['total_lapses'], 2) : '0.00' }}</span>
                 </div>
             </div>

         </div>

     </div>
    @include('livewire.collection.collection.collection-cash-denomination-modal')
    <!-- * Reject Modal -->
    @include('livewire.collection.collection.collection-reject-reason-modal')
    @include('livewire.collection.collection.collection-summary-modal')
 </div>
 </div>
 <script>
    document.addEventListener('livewire:load', function () {
        // open-wrapper,  open-details
        window.livewire.on('openUrlPrintingStub', data =>{
            window.open(data.url, '_blank');
        });
     
        window.livewire.on('RESPONSE_CLOSE_DENOMINATIONS_MODAL', data =>{
          
                cashDenominationModal.setAttribute("closing", "")
                cashDenominationModal.addEventListener("animationend", () => {
                    cashDenominationModal.removeAttribute("closing")
                    cashDenominationModal.close()
                }, { once: true })               
                location.href = data.url
                
        });

        window.livewire.on('RESPONSE_CLOSE_REJECTION_MODAL', data =>{
                rejectCollectionModal.setAttribute("closing", "");
                rejectCollectionModal.addEventListener("animationend", () => {
                    rejectCollectionModal.removeAttribute("closing");
                    rejectCollectionModal.close();
                }, { once: true });
                location.href = data.url
        });
       
        window.showDetails = function($cnt){              
            const trElem = document.getElementById("tr"+$cnt);
            const tdElem = document.getElementById("td"+$cnt);

            if(trElem.classList.contains("open-wrapper")){
                trElem.classList.remove("open-wrapper");
                tdElem.classList.remove("open-details");
            }
            else{
                trElem.classList.add("open-wrapper");
                tdElem.classList.add("open-details");
            }          
        };   
        
        
        // ***** Area Menu Button ***** //
        // * used in Cash Denomination
        // * used in Print and Remit Toggle
        const areaMenuButton = document.querySelectorAll('[data-area-menu]')
        const printRemitButton = document.querySelector('[data-print-remit-buttons]')

        // ***** Collection Summary Modal ***** //
        const collectionSummaryContainer = document.querySelector('[data-collection-summary-container]')
        if (collectionSummaryContainer) {
            const collectionSummaryPrintBtn = document.querySelector('[data-collection-summary-print-button]')
            collectionSummaryPrintBtn.addEventListener('click', () => {
                //url = '/KC/collection/collection-summary-print.html'
                url = '{{ URL::to("/") }}/collection/print/summary'
                window.open(url)
            })
        }
        // ***** Cash Denomination Modal ***** //
        const cashDenominationModal = document.querySelector('[data-cash-denomination-modal]')
        const openCashDenominationBtn = document.querySelector('[data-open-cash-denomination-button]')
        const closeCashDenominationBtn = document.querySelector('[data-close-cash-denomination-button]')
        // const approveCashDenominationBtn = document.querySelector('[data-approve-cash-denomination-button]')

        // * Cash Denomination (collection-collected.html)
        // * Approved Button
      
        areaMenuButton.forEach(button => {
            button.addEventListener('click', () => {               
                // * Current Button Toggled
                button.classList.toggle('view-selected-area')

                areaMenuButton.forEach(btn => {
                    // * If current button is toggled, all buttons except the current button
                    // * will have pointer-events: none; Otherwise, all buttons will have pointer-events: auto.
                    if (btn !== button) {
                        btn.style.pointerEvents = button.classList.contains('view-selected-area') ? 'none' : 'auto';
                    }

                    if (printRemitButton.classList.contains('show-print-remit-buttons')) {
                        button.style.pointerEvents = 'auto';
                    }
                })

                if (collectionSummaryContainer) {
                    collectionSummaryContainer.classList.remove('show-summary')
                }

            })
        })
      
        if (cashDenominationModal) {

            if(openCashDenominationBtn){
                openCashDenominationBtn.addEventListener('click', () => {
                  
                    cashDenominationModal.showModal()

                    // approveCashDenominationBtn.addEventListener('click', () => {
                    //     areaMenuButton.forEach((button) => {
                    //         if (button.matches('.view-selected-area')) {
                    //             button.classList.add('area-is-collected')
                    //             printRemitButton.classList.remove('show-print-remit-buttons')
                    //             // collectionSummaryContainer.classList.add('show-summary')
                    //         }
                    //         button.style.pointerEvents = 'auto'
                    //         if (button.classList.contains('area-is-collected')) {
                    //             collectionSummaryContainer.classList.add('show-summary')
                    //             button.style.pointerEvents = 'none'
                    //         }    
                    //     })
                    // })
                })
            }
            closeCashDenominationBtn.addEventListener('click', () => {
                cashDenominationModal.setAttribute("closing", "")
                cashDenominationModal.addEventListener("animationend", () => {
                    cashDenominationModal.removeAttribute("closing")
                    cashDenominationModal.close()
                }, { once: true })            
            })
           
            // approveCashDenominationBtn.addEventListener('click', () => {
            //     cashDenominationModal.setAttribute("closing", "")
            //     cashDenominationModal.addEventListener("animationend", () => {
            //         cashDenominationModal.removeAttribute("closing")
            //         cashDenominationModal.close()
            //     }, { once: true })
            //     // url = '/KC/collection/collection-collected.html'
            //     // location.href = url
            // })
            


        }

        // ***** Reject Collection Modal ***** //

        const rejectCollectionModal = document.querySelector('[data-collection-reject-modal]')
        const openRejectCollectionBtn = document.querySelector('[data-open-collection-reject-button]')
        const closeRejectCollectionBtn = document.querySelector('[data-close-collection-reject-button]')
        const submitRejectCollectionBtn = document.querySelector('[data-submit-collection-reject-button]')       
        if (rejectCollectionModal) {

            if(openRejectCollectionBtn){
                openRejectCollectionBtn.addEventListener('click', () => {
                    rejectCollectionModal.showModal()
                })
                
                closeRejectCollectionBtn.addEventListener('click', () => {
                    rejectCollectionModal.setAttribute("closing", "");
                    rejectCollectionModal.addEventListener("animationend", () => {
                        rejectCollectionModal.removeAttribute("closing");
                        rejectCollectionModal.close();
                    }, { once: true });
                
                })
            }
            submitRejectCollectionBtn.addEventListener('click', () => {
                // rejectCollectionModal.setAttribute("closing", "");
                // rejectCollectionModal.addEventListener("animationend", () => {
                //     rejectCollectionModal.removeAttribute("closing");
                //     rejectCollectionModal.close();
                // }, { once: true });
                // url = '/KC/collection/collection-list.html'
                // location.href = url
            })

        }


        // ***** Add and Subtract Field Expenses ***** //

        // * Add Expenses


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
                }, { once: true });
            })

            if (saveRemitModalBtn) {
                saveRemitModalBtn.addEventListener('click', () => {
                    remitModal.setAttribute("closing", "");
                    remitModal.addEventListener("animationend", () => {
                        remitModal.removeAttribute("closing");
                        remitModal.close();
                    }, { once: true });
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
                }, { once: true });
            
            })
        }        
    })
 </script>