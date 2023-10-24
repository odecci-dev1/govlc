<div>
<div class="main-dashboard">
        @if(session('sessmessage'))
            <x-alert :message="session('sessmessage')" :words="session('sessmword') ? session('sessmword') : ''" :header="'Success'"></x-alert>   
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

                <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
               
              </div>
            </div>
          
          </div>
        </form>
      </div>
</div>
