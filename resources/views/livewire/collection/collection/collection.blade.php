 <div>
 <!-- * Collection Viewing Container Wrapper -->
 @include('livewire.collection.collection.collection-cash-denomination-modal')
 <!-- * Reject Modal -->
 @include('livewire.collection.collection.collection-reject-reason-modal')
 @include('livewire.collection.collection.collection-summary-modal')
 <div class="can-container-wrapper">

     <!-- * Collection Add New Container 1 -->
     <div class="can-container-1">

         <h3>Collection</h3>

         <div class="wrapper">

             <!-- * All Areas Dropdown Button -->
             <div class="borrower-dropdown" data-bor-dropdown>

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
                        <li data-area-menu wire:click="getCollectionDetails('{{ $area['areaID'] }}', '{{ $area['foid'] }}')" class="{{ $areaID == $area['areaID'] ? 'view-selected-area' : '' }}">
                            <div class="box-1">
                                <h4 id="collectionAreaNum">{{ $area['areaName'] }}</h4>
                            </div>
                            <div class="box-2">
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
                                </div>
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
                            <select wire:model="foid" class="select-option-menu" style="width: 40rem;{{ $areaID != '' ? '' : 'visibility: hidden;' }}">                                
                                @if($folist)
                                    @foreach($folist as $fo)
                                    <option value="{{ $fo['foid'] }}">{{ $fo['lname'] }}, {{ $fo['mname'] }} {{ $fo['mname'] }}</option>           
                                    @endforeach
                                @endif                                  
                            </select>      
                         </div>
                         <div class="result-box" data-search-results>
                         </div>
                     </div>

                     <!-- * Summary Container -->
                     <div class="summary-container" data-collection-summary-container>
                         <p class="textPrimary" data-open-collection-summary-button>View Summary</p>
                     </div>
                 </div>

                 <!-- * Details Wrapper 1 -->
                 @php
                    $countDetails = $areaDetails->where('areaID', $areaID)->count();
                    $checkArea = $areaDetails->where('areaID', $areaID)->first();                 
                @endphp
                 <div class="wrapper-1">
                     <span>Total of {{ $countDetails }} Items</span>
                     <span>{{ $checkArea ? $checkArea['areaName'] : '' }}</span>
                     <span>Ref Number: {{ $checkArea ? ($checkArea['area_RefNo'] != 'PENDING' ? $checkArea['area_RefNo'] : '________________________') : '________________________' }}</span>
                 </div>

             </div>

             <!-- * Inner-inner Container 1 -->
             <div class="inner-inner-container {{ $areaID != '' ? 'show-print-remit-buttons' : '' }}" data-print-remit-buttons>    
                @php
                    $checkDetails = $areaDetails->where('areaID', $areaID)->sum('collectedAmount');                                
                @endphp
                @if($checkDetails > 0)
                <button type="button" class="button-2-green" data-open-cash-denomination-button>Collect</button>
                <button type="button" class="button-2-alert" data-open-collection-reject-button>Reject</button>
                @endif
                <button type="button" wire:click="print" class="button-2" data-collection-print-button>Print</button>
                @if($checkArea)
                    @if($checkArea['collection_RefNo'] != 'PENDING')
                        <a href="{{ URL::to('/') }}/collection/remittance/{{ $checkArea['area_RefNo'] }}" class="button-2" data-collection-remit-button>Remit</a>
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
                             <span class="th-name">Amount Due</span>
                         </th>

                         <!-- * Balance -->
                         <th>
                             <span class="th-name">Balance</span>
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
                                2,350.00
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
                            <td style="text-transform: capitalize;">
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
                     <p>Total Collectible:</p>
                     <span>{{ $footer ? number_format($footer['totalCollectible'], 2) : '0.00' }}</span>
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

 </div>
 </div>
 <script>
    document.addEventListener('livewire:load', function () {
        // open-wrapper,  open-details
        window.livewire.on('openUrlPrintingStub', data =>{
            window.open(data.url, '_blank');
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
    })
 </script>