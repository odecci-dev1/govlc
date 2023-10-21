<dialog class="na-application-decline-modal" data-collection-reject-modal wire:ignore.self>

     <!-- * Modal Container -->
     <div class="modal-container">

         <!-- * Reason for rejecting Modal Container -->
         <div class="application-decline-modal-container">

             <!-- * Button Wrapper -->
             <div class="button-wrapper">
                 <button type="button" data-close-collection-reject-button>
                     <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="close">
                 </button>
             </div>

             <!-- * Small Container -->
             <div class="small-con">

                 <!-- * Rowspan 1: Header -->
                 <div class="rowspan">
                     <h2>Reason for rejecting</h2>
                 </div>

                 <!-- * Rowspan 2: Reason for rejecting Container -->
                 <div class="rowspan">
                     <textarea wire:model.lazy="rejectReason" rows="15" id=""placeholder="Enter the reason here..."></textarea>                  
                 </div>

                 <!-- * Rowspan 3: Button Wrapper -->
                 <div class="rowspan">   
                    @error('rejectReason') 
                    <span class="text-required" style="margin-right: 2rem;  width: 40rem; margin-top: 0.8rem; font-size: 0.6rem; text-align:right !important;">Please enter reason !</span>
                    @enderror           
                    <button type="button" wire:click="reject" class="button" data-submit-collection-reject-button>Submit</button>
                 </div>

             </div>

         </div>
     </div>

 </dialog>