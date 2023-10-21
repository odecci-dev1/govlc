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
                    @if($areas)
                        @foreach($areas as $mareas)
                        <tr>
                            <td>{{ $mareas['areaName'] }}</td>
                            <td>{{ number_format($mareas['totalCollectible'], 2) }}</td>
                            <td>{{ number_format($mareas['total_Balance'], 2) }}</td>
                            <td>{{ number_format($mareas['total_savings'], 2) }}</td>
                            <td>{{ number_format($mareas['total_advance'], 2) }}</td>
                            <td>{{ number_format($mareas['total_lapses'], 2) }}</td>
                            <td>{{ number_format($mareas['total_collectedAmount'], 2) }}</td>
                        </tr>
                        @endforeach
                    @endif    
                  
                </table>


            </div>

            <!-- * Rowspan 3: Footer -->
            <div class="rowspan">
                <p>Grand Total</p>
                <p>{{ number_format($areas->sum('totalCollectible'), 2) }}</p>
                <p>{{ number_format($areas->sum('total_Balance'), 2) }}</p>
                <p>{{ number_format($areas->sum('total_savings'), 2) }}</p>
                <p>{{ number_format($areas->sum('total_advance'), 2) }}</p>
                <p>{{ number_format($areas->sum('total_lapses'), 2) }}</p>
                <p class="textPrimary">{{ number_format($areas->sum('total_collectedAmount'), 2) }}</p>
            </div>

        </div>

    </div>

</div>

</dialog>
