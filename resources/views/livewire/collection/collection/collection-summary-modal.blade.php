<!-- * Collection Summary Modal -->
<dialog class="cl-summary-modal" data-collection-summary-modal>

<!-- * Modal Container -->
<div class="modal-container">

    <!-- * Reason for rejecting Modal Container -->
    <div class="inner-modal-container">

        <!-- * Button Wrapper -->
        <div class="button-wrapper">
            <button type="button" data-close-collection-summary-button>
                <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="close">
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
