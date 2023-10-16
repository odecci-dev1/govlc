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
                <div class="select-box">
                    <select  wire:model="status" class="select-option-menu">
                        <option value="">All Areas</option>     
                        <option value="Active">Active</option>                                    
                        <option value="Inactive">Inactive</option>                                    
                    </select>                       
                </div>         

                
             </div>

             <div class="area-menu-container">             
                 <!-- * Area Menu -->
                 <ul class="area-menu">

                    @if($areas)
                        @foreach($areas as $area)
                        <li data-area-menu wire:click="getCollectionDetails('{{ $area['areaID'] }}')" >
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
                                    <span id="collectionPenalty">{{ number_format($area['expectedCollection'] - $area['total_collectedAmount'], 2) }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @endif

                     <!-- * Area 1 -->
                     <li data-area-menu>
                         <div class="box-1">
                             <h4 id="collectionAreaNum">Area 1</h4>
                         </div>
                         <div class="box-2">
                             <div class="inner-box-1">
                                 <p>Expected Collection</p>
                                 <span id="expectedCollection">13,000.00</span>
                             </div>
                             <div class="inner-box-2">
                                 <p>Penalty</p>
                                 <span id="collectionPenalty">0.00</span>
                             </div>
                         </div>
                     </li>

                     <!-- * Area 2 -->
                     <li data-area-menu>
                         <div class="box-1">
                             <h4 id="collectionAreaNum">Area 2</h4>
                         </div>
                         <div class="box-2">
                             <div class="inner-box-1">
                                 <p>Expected Collection</p>
                                 <span id="expectedCollection">13,000.00</span>
                             </div>
                             <div class="inner-box-2">
                                 <p>Penalty</p>
                                 <span id="collectionPenalty">0.00</span>
                             </div>
                         </div>
                     </li>

                     <!-- * Area 3 -->
                     <li data-area-menu>
                         <div class="box-1">
                             <h4 id="collectionAreaNum">Area 3</h4>
                         </div>
                         <div class="box-2">
                             <div class="inner-box-1">
                                 <p>Expected Collection</p>
                                 <span id="expectedCollection">13,000.00</span>
                             </div>
                             <div class="inner-box-2">
                                 <p>Penalty</p>
                                 <span id="collectionPenalty">0.00</span>
                             </div>
                         </div>
                     </li>

                     <!-- * Area 4 -->
                     <li data-area-menu>
                         <div class="box-1">
                             <h4 id="collectionAreaNum">Area 4</h4>
                         </div>
                         <div class="box-2">
                             <div class="inner-box-1">
                                 <p>Expected Collection</p>
                                 <span id="expectedCollection">13,000.00</span>
                             </div>
                             <div class="inner-box-2">
                                 <p>Penalty</p>
                                 <span id="collectionPenalty">0.00</span>
                             </div>
                         </div>
                     </li>

                     <!-- * Area 5 -->
                     <li data-area-menu>
                         <div class="box-1">
                             <h4 id="collectionAreaNum">Area 5</h4>
                         </div>
                         <div class="box-2">
                             <div class="inner-box-1">
                                 <p>Expected Collection</p>
                                 <span id="expectedCollection">13,000.00</span>
                             </div>
                             <div class="inner-box-2">
                                 <p>Penalty</p>
                                 <span id="collectionPenalty">0.00</span>
                             </div>
                         </div>
                     </li>

                     <!-- * Area 6 -->
                     <li data-area-menu>
                         <div class="box-1">
                             <h4>Area 6</h4>
                         </div>
                         <div class="box-2">
                             <div class="inner-box-1">
                                 <p>Expected Collection</p>
                                 <span id="expectedCollection">13,000.00</span>
                             </div>
                             <div class="inner-box-2">
                                 <p>Penalty</p>
                                 <span id="collectionPenalty">0.00</span>
                             </div>
                         </div>
                     </li>

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
                             <input type="search" id="searchInput" name="search" placeholder="Search"
                                 autocomplete="off">
                             <button>
                             </button>
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
                 <div class="wrapper-1">
                     <span>Total of 3 Items</span>
                     <span>Area No. 1</span>
                     <span>Ref Number: ABPA120230525</span>
                 </div>

             </div>

             <!-- * Inner-inner Container 1 -->
             <div class="inner-inner-container" data-print-remit-buttons>
                 <button type="button" class="button-2-green" data-open-cash-denomination-button>Collect</button>
                 <button type="button" class="button-2-alert" data-open-collection-reject-button>Reject</button>
                 <button type="button" class="button-2" data-collection-print-button>Print</button>
                 <button type="button" class="button-2" data-collection-remit-button>Remit</button>
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
                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Juana Dela Cruz</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             350.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             3,000.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,350.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             350.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Unpaid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Jane Doe</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             250.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             1,830.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             200.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             200.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Paid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Juana Dela Cruz</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             350.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             3,000.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,350.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             350.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Unpaid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Jane Doe</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             250.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             1,830.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             200.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             200.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Paid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Juana Dela Cruz</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             350.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             3,000.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,350.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             350.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Unpaid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Jane Doe</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             250.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             1,830.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             200.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             200.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Paid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Juana Dela Cruz</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             350.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             3,000.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,350.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             350.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Unpaid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr data-area-menu-toggle data-details-wrapper-dropdown>

                         <td>

                             <!-- * Client No. -->
                             <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

                         </td>

                         <td>
                             <span class="td-num"></span>
                         </td>

                         <td>

                             <!-- * Name -->
                             <div class="td-wrapper">
                                 <!-- <span class="td-num"></span> -->
                                 <span class="td-name">Jane Doe</span>
                             </div>

                         </td>

                         <!-- * Collectible  -->
                         <td>
                             250.00
                         </td>

                         <!-- * Amount Due -->
                         <td>
                             1,830.00
                         </td>

                         <!-- * Balance -->
                         <td>
                             2,000.00
                         </td>

                         <!-- * Overall Savings -->
                         <td>
                             200.00
                         </td>

                         <!-- * Advance / Lapses -->
                         <td>
                             200.00
                         </td>

                         <!-- * Status -->
                         <td>
                             Paid
                         </td>

                     </tr>

                     <tr class="details-wrapper" data-details-wrapper>
                         <td>
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
                                         <p>Juana Dela Cruz</p>
                                         <p>0917232132</p>
                                         <p>Melody Ocampo</p>
                                         <p>0923214379</p>
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
                                         <p>12,000.00</p>
                                         <p>June 18, 2023</p>
                                         <p>August 30, 2023</p>
                                         <p>Daily</p>
                                         <p>0.00</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="box">
                                 <div class="inner-box">
                                     <h4>Payment Info</h4>
                                     <div class="box-wrapper">
                                         <div class="inner-inner-box">
                                             <p>Daily Collectible:</p>
                                             <p>Min Daily Savings:</p>
                                         </div>
                                         <div class="inner-inner-box">
                                             <p>350.00</p>
                                             <p>10.00</p>
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
                                             <p>2000.00</p>
                                             <p>0.00</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                 </table>

             </div>

             <!-- * Details Wrapper 3 -->
             <div class="wrapper-3">

                 <!-- * Total Collectible: -->
                 <div class="box">
                     <p>Total Collectible:</p>
                     <span>600.00</span>
                 </div>
                 <!-- * Total Balance: -->
                 <div class="box">
                     <p>Total Balance:</p>
                     <span>4,350.00</span>
                 </div>
                 <!-- * Total Savings: -->
                 <div class="box">
                     <p>Total Savings:</p>
                     <span>550.00</span>
                 </div>
                 <!-- * Total Advance: -->
                 <div class="box">
                     <p>Total Advance:</p>
                     <span>200.00</span>
                 </div>
                 <!-- * Total Lapses: -->
                 <div class="box">
                     <p>Total Lapses:</p>
                     <span>2,200.00</span>
                 </div>
             </div>

         </div>

     </div>

 </div>
 </div>
 <script>
     // * Add New Collection
     const addNewCollectionBtn = document.querySelector('[data-add-new-collection]')

     if (addNewCollectionBtn) {
         addNewCollectionBtn.addEventListener('click', () => {
             url = '/KC/collection/collection-add-new.html'
             location.href = url
         })
     }


     // * View Collection
     const viewCollectionBtn = document.querySelector('[data-view-collection]')

     if (viewCollectionBtn) {
         viewCollectionBtn.addEventListener('click', () => {
             url = '/KC/collection/collection-view.html'
             location.href = url
         })
     }

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
             url = '/KC/collection/collection-summary-print.html'
             window.open(url)
         })
     }
     // ***** Cash Denomination Modal ***** //
     const cashDenominationModal = document.querySelector('[data-cash-denomination-modal]')
     const openCashDenominationBtn = document.querySelector('[data-open-cash-denomination-button]')
     const closeCashDenominationBtn = document.querySelector('[data-close-cash-denomination-button]')
     const approveCashDenominationBtn = document.querySelector('[data-approve-cash-denomination-button]')

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
                     btn.style.pointerEvents = button.classList.contains('view-selected-area') ?
                         'none' : 'auto';
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


         openCashDenominationBtn.addEventListener('click', () => {
             cashDenominationModal.showModal()

             approveCashDenominationBtn.addEventListener('click', () => {
                 areaMenuButton.forEach((button) => {
                     if (button.matches('.view-selected-area')) {
                         button.classList.add('area-is-collected')
                         printRemitButton.classList.remove('show-print-remit-buttons')
                         // collectionSummaryContainer.classList.add('show-summary')
                     }
                     button.style.pointerEvents = 'auto'
                     if (button.classList.contains('area-is-collected')) {
                         collectionSummaryContainer.classList.add('show-summary')
                         button.style.pointerEvents = 'none'
                     }
                 })
             })
         })

         closeCashDenominationBtn.addEventListener('click', () => {
             cashDenominationModal.setAttribute("closing", "")
             cashDenominationModal.addEventListener("animationend", () => {
                 cashDenominationModal.removeAttribute("closing")
                 cashDenominationModal.close()
             }, {
                 once: true
             })

         })

         approveCashDenominationBtn.addEventListener('click', () => {
             cashDenominationModal.setAttribute("closing", "")
             cashDenominationModal.addEventListener("animationend", () => {
                 cashDenominationModal.removeAttribute("closing")
                 cashDenominationModal.close()
             }, {
                 once: true
             })
             // url = '/KC/collection/collection-collected.html'
             // location.href = url
         })


         // * Denomination values
         const denominations = {
             1: 1,
             20: 20,
             50: 50,
             100: 100,
             200: 200,
             500: 500,
             1000: 1000,
         };

         // * Function to calculate the total value
         function calculateTotal(collectedDenominations) {
             let total = 0;

             for (const denomination in collectedDenominations) {
                 const count = collectedDenominations[denomination]
                 if (denominations[denomination]) {
                     total += denominations[denomination] * count
                 }
             }

             // total = total || 0;
             return total;

         }

         // * Auto-computation
         const form = document.getElementById("cashDenominationForm")
         const totalValueElement = document.getElementById("totalCashDenom")
         const collectedAmount = document.getElementById("collectedAmnt")


         form.addEventListener("input", (evt) => {

             const collectedDenominations = {};
             for (const denomination in denominations) {
                 const inputElement = document.getElementById(`cd${denomination}`);
                 const value = parseInt(inputElement.value, 10);

                 if (isNaN(value)) {
                     value = 0
                 }

                 collectedDenominations[denomination] = value;
             }


             const totalValue = calculateTotal(collectedDenominations);
             totalValueElement.textContent = totalValue;

             const collectedAmntValue = parseInt(collectedAmount.innerText, 10)

             if (totalValue >= collectedAmntValue) {
                 totalValueElement.classList.remove('textAlert')
                 totalValueElement.classList.add('textGreen')
             } else if (totalValue < collectedAmntValue) {
                 totalValueElement.classList.remove('textGreen')
                 totalValueElement.classList.add('textAlert')
             }

         });

     }

     // ***** Reject Collection Modal ***** //

     const rejectCollectionModal = document.querySelector('[data-collection-reject-modal]')
     const openRejectCollectionBtn = document.querySelector('[data-open-collection-reject-button]')
     const closeRejectCollectionBtn = document.querySelector('[data-close-collection-reject-button]')
     const submitRejectCollectionBtn = document.querySelector('[data-submit-collection-reject-button]')

     if (rejectCollectionModal) {

         openRejectCollectionBtn.addEventListener('click', () => {
             rejectCollectionModal.showModal()
         })

         closeRejectCollectionBtn.addEventListener('click', () => {
             rejectCollectionModal.setAttribute("closing", "");
             rejectCollectionModal.addEventListener("animationend", () => {
                 rejectCollectionModal.removeAttribute("closing");
                 rejectCollectionModal.close();
             }, {
                 once: true
             });

         })

         submitRejectCollectionBtn.addEventListener('click', () => {
             rejectCollectionModal.setAttribute("closing", "");
             rejectCollectionModal.addEventListener("animationend", () => {
                 rejectCollectionModal.removeAttribute("closing");
                 rejectCollectionModal.close();
             }, {
                 once: true
             });
             url = '/KC/collection/collection-list.html'
             location.href = url
         })

     }


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


     // * Area Toggle Button
     function areaMenuButtonToggle() {

         let areaMenuData = document.querySelectorAll('[data-area-menu-toggle]')

         menuCount = 0

         for (const button of areaMenuButton) {

             menuCount++
             button.setAttribute('id', `area-${menuCount}`)

             button.addEventListener('click', () => {
                 printRemitButton.classList.toggle('show-print-remit-buttons')

             })

             for (const menuData of areaMenuData) {

                 let areaMenuDropdown = menuData.nextElementSibling
                 let areaMenuDropdownDetails = menuData.nextElementSibling.firstElementChild

                 // menuData.classList.remove('show-area-details')

                 // * Details Wrapper Dropdown
                 function toggleClass(element, className) {
                     if (element.classList.contains(className)) {
                         element.classList.remove(className);
                     } else {
                         element.classList.add(className);
                     }
                 }

                 button.addEventListener('click', () => {
                     menuData.classList.toggle('show-area-details')

                     areaMenuDropdown.classList.add('open-wrapper')
                     areaMenuDropdown.classList.remove('open-wrapper')
                     areaMenuDropdownDetails.classList.add('open-details')
                     areaMenuDropdownDetails.classList.remove('open-details')

                     menuData.addEventListener('click', () => {
                         toggleClass(areaMenuDropdown, 'open-wrapper')
                         toggleClass(areaMenuDropdownDetails, 'open-details')
                     })

                 })

             }
         }
     }

     areaMenuButtonToggle()

     // * Printables

     const printButton = document.querySelector('[data-collection-print-button]')
     const remitButton = document.querySelector('[data-collection-remit-button]')


     if (printButton) {
         printButton.addEventListener('click', () => {
             url = '/KC/collection/collection-print.html'
             window.open(url)
         })
     }

     if (remitButton) {
         remitButton.addEventListener('click', () => {
             url = '/KC/collection/collection-remittance.html'
             location.href = url
         })
     }


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
     spanTotalPageNum.innerText = pages.length

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
         threshold: 0.7
     })

     pages.forEach(page => {
         observer.observe(page)
     })

     // * Add functionality to go to a specific page
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
 </script>