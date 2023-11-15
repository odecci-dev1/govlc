<div id="error-asking-dialog-div" style="visibility: hidden;">
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
                <button class="alert-btn alert-btn-no" onclick="closeAskingDiv()" data-restoration-no>Close</button>
                <button class="alert-btn alert-btn-yes" wire:click="{{ $confirmaction }}" onclick="closeAskingDiv()" data-restoration-yes>Retry</button>
            </div>
        </div>
        <script>
            window.closeAskingDiv = function(){
                const askingdiv = document.getElementById('error-asking-dialog-div');              
                if(askingdiv){
                    askingdiv.style.visibility="hidden";
                }
            }
           
        </script>
    </div>  
</div>