<div>
<div class="main-dashboard">     
        <x-error-dialog :message="(session('errormessage') ? session('errormessage') : 'Operation Failed. Retry ?')" :xmid="''" :confirmaction="session('erroraction') ? session('erroraction') : ''" :header="'Error'"></x-error-dialog>       
        @if(session('mmessage'))
            <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
        @endif
        <!-- * Add New User Container -->
        <form action="" class="na-form-con" autocomplete="off">
          <!-- * Wrapper -->
          <div class="na-container-wrapper-2">
            <!-- * Container 1: User Registration Form Fields and Buttons -->
            <div class="nu-con-1">
              <!-- * Container Wrapper -->
              <div class="container-wrapper">
                <!-- * Big Container -->
                <div class="big-con">
                  <!-- * Form Header -->

        
                  <!-- * Rowspan 2: First Name -->
                  <div class="rowspan" style="display: inline;">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem;">
                      <h2 style="font-size: 3rem; font-weight: bold;">Settings</h2>                      
                  </div>

                  <div class="rowspan" style="display: inline;">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem !important;">
                      <span>Monthly Target</span>
                      <input
                        autocomplete="off"
                        type="number"
                        wire:model.lazy="monthly_target"
                        style="width: 30rem;"
                      />
                    </div>
                    @error('monthly_target') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan" style="display: inline;">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem !important;">
                      <span>Dashboard Display Reset</span>
                        <div class="box-wrap" style="gap: 0rem; width: 25rem; justify-content: first baseline !important;">
                          <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                            <input  wire:model.lazy="display_reset" autocomplete="off" type="radio" value="3" name="noAdvancePayment" id="noAdvancePayment3">
                            <span>Daily</span>                                            
                          </div>
                          <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                            <input  wire:model.lazy="display_reset" autocomplete="off" type="radio" value="1" name="noAdvancePayment" id="noAdvancePayment1">
                            <span>Monthly</span>                                            
                          </div>
                          <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                            <input  wire:model.lazy="display_reset" autocomplete="off" type="radio" value="2" name="noAdvancePayment" id="noAdvancePayment1">
                            <span>Yearly</span>                                            
                          </div>
                        </div>
                    </div>
                    @error('monthly_target') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem !important;">
                      <span>Company Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.lazy="company_name"
                       style="width: 90rem;"
                      />
                    </div>
                    @error('company_number') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem !important;">
                      <span>Company Contact Number</span>
                      <input
                        autocomplete="off"
                        type="number"
                        wire:model.lazy="company_number"
                       style="width: 30rem;"
                      />
                    </div>
                    @error('company_number') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem !important;">
                      <span>Company Address</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.lazy="company_address"
                       style="width: 60rem;"
                      />
                    </div>
                    @error('company_address') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper" style="padding-bottom: 3rem !important;">
                      <span>Company Email</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.lazy="company_email"
                       style="width: 60rem;"
                      />
                    </div>
                    @error('company_email') <span class="text-required">{{ $message }}</span>@enderror
                  </div>                
                </div>

                <div class="rowspan">
                    <!-- * First Name -->
                    <button type="button" wire:click="update" class="button">UPDATE SETTINGS</button>    
                </div>

                <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
               
              </div>
            </div>
          
          </div>
        </form>
      </div>
</div>
<script>
        document.addEventListener('livewire:load', function () {          
            window.livewire.on('EMIT_ERROR_ASKING_DIALOG', data =>{
                document.getElementById('error-asking-dialog-div').style.visibility="visible";
            });
        })
      
</script>
@if(session('errmmessage'))
    <x-error :message="session('errmmessage')" :words="'Action not successfull'" :header="'Error'"></x-error>   
@endif