<!-- * Cash Denomination Modal -->
<dialog class="cd-modal" data-cash-denomination-modal wire:ignore.self>

<div class="modal-container">

    <!-- * Modal Header and Exit Button -->
    <div class="modal-header">
        <h4>Cash Denominations</h4>
        <button class="exit-button" data-close-cash-denomination-button>
            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
        </button>
    </div>

    <!-- * Box-wrap: 1, 20, 50, 100, 500, and 1000 -->
    <div class="box-wrap" id="cashDenominationForm">

        <!-- * 1 -->
        <div class="input-wrapper">
            <span>1</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd1" name="cd1" wire:blur="getTotalDenomination" placeholder="0">
        </div>

         <!-- * 5 -->
         <div class="input-wrapper">
            <span>5</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd5" name="cd5" wire:blur="getTotalDenomination" placeholder="0">
        </div>

         <!-- * 10 -->
         <div class="input-wrapper">
            <span>10</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd10" name="cd10" wire:blur="getTotalDenomination" placeholder="0">
        </div>


        <!-- * 20 -->
        <div class="input-wrapper">
            <span>20</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd20" name="cd20" wire:blur="getTotalDenomination" placeholder="0">
        </div>

        <!-- * 50 -->
        <div class="input-wrapper">
            <span>50</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd50" name="cd50" wire:blur="getTotalDenomination" placeholder="0">
        </div>

        <!-- * 100 -->
        <div class="input-wrapper">
            <span>100</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd100" name="cd100" wire:blur="getTotalDenomination" placeholder="0">
        </div>

        <!-- * 200 -->
        <div class="input-wrapper">
            <span>200</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd200" name="cd200" wire:blur="getTotalDenomination" placeholder="0">
        </div>

        <!-- * 500 -->
        <div class="input-wrapper">
            <span>500</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd500" name="cd500" wire:blur="getTotalDenomination" placeholder="0">
        </div>

        <!-- * 1000 -->
        <div class="input-wrapper">
            <span>1000</span>
            <input autocomplete="off" type="number" wire:model.lazy="cashDenominations.cd1000" name="cd1000" wire:blur="getTotalDenomination" placeholder="0">
        </div>

    </div>

    <!-- * Box-wrap: Total Cash Denomination and Collected Amount -->
    <div class="box-wrap">
        <div class="inner-box-wrap">
            <p>TOTAL</p>
            <span id="totalCashDenom">{{ $totalDenomination == 0 ? '-' : number_format($totalDenomination, 2) }}</span>
        </div>
        <div class="inner-box-wrap">
            <p>COLLECTED AMOUNT</p>            
            <span id="collectedAmnt">{{ number_format($sumDetails, 2) }}</span>
        </div>
    </div>

    <!-- * Approve Button -->
    <div class="box-wrap">
        @if (session()->has('RESPONSE_NOT_EQUAL_DENOMINATIONS_MODAL'))
        <span class="text-required" style="margin-right: 2rem; margin-top: 0.1rem; width: 20rem; font-size: 0.6rem;">{{ session('RESPONSE_NOT_EQUAL_DENOMINATIONS_MODAL') }} !</span>
        @endif
        <button class="button-2-green" wire:click = "approveDenominations"  data-approve-cash-denomination-button>Approve</button>
    </div>

</div>

</dialog>