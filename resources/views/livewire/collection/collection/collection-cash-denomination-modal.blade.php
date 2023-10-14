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