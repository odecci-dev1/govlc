 <!-- * Collection Viewing Container Wrapper -->

 <!-- * Cash Denomination Modal -->
 <dialog class="cd-modal" data-cash-denomination-modal>

     <div class="modal-container">

         <!-- * Modal Header and Exit Button -->
         <div class="modal-header">
             <h4>Cash Denominations</h4>
             <button class="exit-button" data-close-cash-denomination-button>
                 <img src="../../res/assets/icons/x-circle.svg" alt="exit">
             </button>
         </div>

         <!-- * Box-wrap: 1, 20, 50, 100, 500, and 1000 -->
         <div class="box-wrap" id="cashDenominationForm">

             <!-- * 1 -->
             <div class="input-wrapper">
                 <span>1</span>
                 <input autocomplete="off" type="number" id="cd1" name="cd1" value="0" placeholder="0">
             </div>

             <!-- * 20 -->
             <div class="input-wrapper">
                 <span>20</span>
                 <input autocomplete="off" type="number" id="cd20" name="cd20" value="0" placeholder="0">
             </div>

             <!-- * 50 -->
             <div class="input-wrapper">
                 <span>50</span>
                 <input autocomplete="off" type="number" id="cd50" name="cd50" value="0" placeholder="0">
             </div>

             <!-- * 100 -->
             <div class="input-wrapper">
                 <span>100</span>
                 <input autocomplete="off" type="number" id="cd100" name="cd100" value="0" placeholder="0">
             </div>

             <!-- * 200 -->
             <div class="input-wrapper">
                 <span>200</span>
                 <input autocomplete="off" type="number" id="cd200" name="cd200" value="0" placeholder="0">
             </div>

             <!-- * 500 -->
             <div class="input-wrapper">
                 <span>500</span>
                 <input autocomplete="off" type="number" id="cd500" name="cd500" value="0" placeholder="0">
             </div>

             <!-- * 1000 -->
             <div class="input-wrapper">
                 <span>1000</span>
                 <input autocomplete="off" type="number" id="cd1000" name="cd1000" value="0" placeholder="0">
             </div>

         </div>

         <!-- * Box-wrap: Total Cash Denomination and Collected Amount -->
         <div class="box-wrap">
             <div class="inner-box-wrap">
                 <p>TOTAL</p>
                 <span id="totalCashDenom">-</span>
             </div>
             <div class="inner-box-wrap">
                 <p>COLLECTED AMOUNT</p>
                 <span id="collectedAmnt">3000</span>
             </div>
         </div>

         <!-- * Approve Button -->
         <div class="box-wrap">
             <button class="button-2-green" data-approve-cash-denomination-button>Approve</button>
         </div>

     </div>

 </dialog>

 <!-- * Reject Modal -->
 <dialog class="na-application-decline-modal" data-collection-reject-modal>

     <!-- * Modal Container -->
     <div class="modal-container">

         <!-- * Reason for rejecting Modal Container -->
         <div class="application-decline-modal-container">

             <!-- * Button Wrapper -->
             <div class="button-wrapper">
                 <button type="button" data-close-collection-reject-button>
                     <img src="../../res/assets/icons/x-circle.svg" alt="close">
                 </button>
             </div>

             <!-- * Small Container -->
             <div class="small-con">

                 <!-- * Rowspan 1: Header -->
                 <div class="rowspan">
                     <h2>Reason for rejecting</h2>
                 </div>

                 <!-- * Rowspan 2: Reason for rejecting Container -->
                 <div class="rowspan">
                     <textarea name="" rows="15" id=""placeholder="Enter the reason here..."></textarea>
                 </div>

                 <!-- * Rowspan 3: Button Wrapper -->
                 <div class="rowspan">
                     <button type="button" class="button" data-submit-collection-reject-button>Submit</button>
                 </div>

             </div>

         </div>
     </div>

 </dialog>

 <!-- * Collection Summary Modal -->
 <dialog class="cl-summary-modal" data-collection-summary-modal>

     <!-- * Modal Container -->
     <div class="modal-container">

         <!-- * Reason for rejecting Modal Container -->
         <div class="inner-modal-container">

             <!-- * Button Wrapper -->
             <div class="button-wrapper">
                 <button type="button" data-close-collection-summary-button>
                     <img src="../../res/assets/icons/x-circle.svg" alt="close">
                 </button>
             </div>

             <!-- * Small Container -->
             <div class="small-con">

                 <!-- * Rowspan 1: Header -->
                 <div class="rowspan">
                     <h2>Summary</h2>
                     <button class="button-2" data-collection-summary-print-button>Print</button>
                 </div>

                 <!-- * Rowspan 2: Table -->
                 <div class="rowspan table">

                     <table>
                         <!-- * Table Header -->
                         <tr>
                             <th>Area</th>
                             <th>Total Collectible:</th>
                             <th>Total Balance:</th>
                             <th>Total Savings:</th>
                             <th>Total Advance:</th>
                             <th>Total Lapses:</th>
                             <th>Total Collected Amount</th>
                         </tr>

                         <!-- * Table Data -->
                         <tr>
                             <td>Area 1</td>
                             <td>600.00</td>
                             <td>34,350.00</td>
                             <td>550.00</td>
                             <td>200.00</td>
                             <td>2,200.00</td>
                             <td>550.00</td>
                         </tr>

                         <tr>
                             <td>Area 2</td>
                             <td>600.00</td>
                             <td>34,350.00</td>
                             <td>550.00</td>
                             <td>200.00</td>
                             <td>2,200.00</td>
                             <td>550.00</td>
                         </tr>

                         <tr>
                             <td>Area 3</td>
                             <td>600.00</td>
                             <td>34,350.00</td>
                             <td>550.00</td>
                             <td>200.00</td>
                             <td>2,200.00</td>
                             <td>550.00</td>
                         </tr>

                         <tr>
                             <td>Area 4</td>
                             <td>600.00</td>
                             <td>34,350.00</td>
                             <td>550.00</td>
                             <td>200.00</td>
                             <td>2,200.00</td>
                             <td>550.00</td>
                         </tr>

                         <tr>
                             <td>Area 5</td>
                             <td>600.00</td>
                             <td>34,350.00</td>
                             <td>550.00</td>
                             <td>200.00</td>
                             <td>2,200.00</td>
                             <td>550.00</td>
                         </tr>

                     </table>


                 </div>

                 <!-- * Rowspan 3: Footer -->
                 <div class="rowspan">
                     <p>Grand Total</p>
                     <p>3,000.00</p>
                     <p>21,750.00</p>
                     <p>2,750.00</p>
                     <p>1,000.00</p>
                     <p>11,000.00</p>
                     <p class="textPrimary">2,750.00</p>
                 </div>

             </div>

         </div>

     </div>

 </dialog>

 <div class="can-container-wrapper">

     <!-- * Collection Add New Container 1 -->
     <div class="can-container-1">

         <h3>Collection</h3>

         <div class="wrapper">

             <!-- * All Areas Dropdown Button -->
             <div class="borrower-dropdown" data-bor-dropdown>

                 <!-- * All Areas Button -->
                 <button class="link dropdown" data-bor-dropdown-button>
                     <span data-bor-dropdown-button>All Areas</span>
                     <img src="../../res/assets/icons/white-carret-down.svg" alt="carret-down"data-bor-dropdown-button>
                 </button>

                 <!-- * Submenu -->
                 <!-- <ul class="dropdown-menu"> -->

                 <!-- * Area 1 -->
                 <!-- <li>
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
                                </li> -->

                 <!-- * Area 2 -->
                 <!-- <li>
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
                                </li> -->

                 <!-- * Area 3 -->
                 <!-- <li>
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
                                </li> -->

                 <!-- * Area 4 -->
                 <!-- <li>
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
                                </li> -->

                 <!-- * Area 5 -->
                 <!-- <li>
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
                                </li> -->


                 <!-- * Area 5 -->
                 <!-- <li>
                                    <div class="box-1">
                                        <h4>Area 1</h4>
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
                                </li> -->


                 <!-- * Area 5 -->
                 <!-- <li>
                                    <div class="box-1">
                                        <h4>Area 1</h4>
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
                                </li> -->


                 <!-- </ul> -->

             </div>

             <div class="area-menu-container">

                 <!-- * Area Menu -->
                 <ul class="area-menu">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana">

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
                             <img src="../../res/assets/icons/sample-dp/Borrower-2.svg" alt="Dela Cruz, Juana">

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
