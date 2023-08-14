<div>
    <div class="full-screen-div">
    <dialog class="us-modal" open data-updated-successfully>

    <div class="modal-container">

        <!-- * Modal Header  -->
        <div class="modal-header">
            <h4>{{ $header }}</h4>
        </div>

        <!-- * Modal Body -->
        <div class="rowspan">
            <img src="{{ URL::to('/') }}/assets/icons/modal-icon/status-success.svg" alt="Updated Successfully">
            <span>{{ isset($words) ? $words : '' }}</span>
            <p>{{ $message }}</p>
        </div>

        <!-- * Okay Button -->
        <div class="rowspan">
            <button autofocus class="modalButton" wire:click="closeAlert" data-close-update-modal>OK</button>
        </div>

    </div>

    </dialog>   
    </div>
</div>