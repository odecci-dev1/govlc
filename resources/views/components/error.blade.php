<div id="error-asking-dialog-div">
    <div class="full-screen-div">       
        <div class="alert-container">
            <div class="alert-header">
                <h4>{{ $header }}</h4>
            </div>
            <div class="alert-body">                
                <div>
                    <img src="{{ URL::to('/') }}/assets/icons/modal-icon/circle-x.svg" alt="Asking">
                </div>
                <div>
                    <p>{{ $message }}</p>
                </div>                
            </div>
            <div class="alert-footer">                
                <button class="alert-btn alert-btn-no" wire:click="closeErrorMessage" data-restoration-no>Got It</button>                
            </div>
        </div>       
    </div>  
</div>