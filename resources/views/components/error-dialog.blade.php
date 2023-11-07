<div>
    <div class="full-screen-div">
       
        <div class="alert-container">
            <div class="alert-header">
                <h4>{{ $header }}</h4>
            </div>
            <div class="alert-body">
                <img src="{{ URL::to('/') }}/assets/icons/modal-icon/asking.svg" alt="Asking">
                <p>Are you sure you want to restorethe selected data?</p>
            </div>
            <div class="alert-footer">
                <button class="modalButton" data-restoration-yes>Yes</button>
                <button class="modalButton" data-restoration-no>No</button>
            </div>
        </div>

    </div>  
</div>