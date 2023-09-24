<div>
    <div class="full-screen-div">
        <dialog class="asking-modal w-2" open data-restoration-modal>

            <div class="modal-container">

                <!-- * Modal Header  -->
                <div class="modal-header">
                    <h4>{{ $header }}</h4>
                </div>

                <!-- * Modal Body -->
                <div class="rowspan">
                    <img src="{{ URL::to('/') }}/assets/icons/modal-icon/asking.svg" alt="Asking">
                    <p>Are you sure you want to restore
                        the selected data?</p>
                </div>

                <!-- * Yes or No Button -->
                <div class="rowspan">
                    <button class="modalButton" data-restoration-yes>Yes</button>
                    <button class="modalButton" data-restoration-no>No</button>
                </div>

            </div>

        </dialog>   
    </div>
</div>