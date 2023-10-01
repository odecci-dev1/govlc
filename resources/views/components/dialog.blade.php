<div>
    <div class="full-screen-div">
        <!-- * Deletion Modal -->
        <dialog class="asking-modal w-3" open data-deletion-modal>

        <div class="modal-container">

            <!-- * Modal Header  -->
            <div class="modal-header">
                <h4>{{ $header }}</h4>
            </div>

            <!-- * Modal Body -->
            <div class="rowspan">
                <img src="{{ URL::to('/') }}/assets/icons/modal-icon/asking-deletion.svg" alt="Asking">
                <p>{{ $message }}?</p>
            </div>

            <!-- * Yes or No Button -->
            <div class="rowspan">
                <button type="button" autofocus onclick="{{ $confirmaction }}('{{ $xmid }}')" class="modalButton" data-deletion-yes>Yes</button>
                <button wire:click="closeDialog" type="button" class="modalAlertButton" data-deletion-no>No</button>
            </div>

        </div>

        </dialog>   

    </div>
</div>