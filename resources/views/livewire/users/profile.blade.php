<div>
<div class="main-dashboard">
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

                  <!-- * Rowspan 1: Rowspan Header - User Information -->
                  <div class="rowspan">
                    <h2>User Profile</h2>
                    @php
                        $usertypedesc = '';
                        if($usertype == 1){
                            $usertypedesc = 'All Access';
                        } 
                        else if($usertype == 2){
                            $usertypedesc = 'Overview';
                        } 
                        else if($usertype == 3){
                            $usertypedesc = 'Members';
                        }                       
                    @endphp
                    <h2 style="float: right; color: #b3b3b3; font-weight: normal; font-size: 1.2rem;">User Type: <span style="color: #D6A330;font-size: 2rem; font-weight: bold;">{{ $usertypedesc }}</span></h2>
                  </div>

                  <!-- * Rowspan 2: First Name -->

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>Username</span>
                      <input
                        autocomplete="off"
                        type="text"
                       wire:model.defer="username"
                      />
                    </div>
                    @error('username') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  @if($updatePassword == 1)
                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>Password</span>
                      <input
                        autocomplete="off"
                        type="password"
                        wire:model.defer="password"
                      />
                    </div>
                    @error('password') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>Password Confirmation</span>
                      <input
                        autocomplete="off"
                        type="password"
                        wire:model.defer="password_confirmation"
                      />
                    </div>
                    @error('password_confirmation') <span class="text-required">{{ $message }}</span>@enderror
                  </div>
                 
                  <div class="rowspan">
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <button type="button" wire:click="closeUpdatePassword" class="button">Cancel</button>
                          <button type="button" wire:click="updatePassword" class="button">Update password</button>
                        </div>
                  </div>
              
                  @else
                  <div class="rowspan">
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <button type="button" wire:click="changeUpdatePassword" class="button">Change password</button>
                        </div>
                  </div>
                  @endif


                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>First Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.defer="fname"
                      />
                    </div>
                    @error('fname') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 3: Middle Name -->
                  <div class="rowspan">
                    <!-- * Middle Name -->
                    <div class="input-wrapper">
                      <span>Middle Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.defer="mname"
                      />
                    </div>
                    @error('mname') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 4: Last Name -->
                  <div class="rowspan">
                    <!-- * Last Name -->
                    <div class="input-wrapper">
                      <span>Last Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.defer="lname"
                      />
                    </div>
                    @error('lname') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 5: Contact Number -->
                  <div class="rowspan">
                    <!-- * Contact Number -->
                    <div class="input-wrapper">
                      <div class="input-wrapper">
                        <span>Contact Number</span>
                        <input
                          autocomplete="off"
                          type="number"
                          wire:model.defer="cno"
                        />
                      </div>
                    </div>
                    @error('cno') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 6: Address -->
                  <div class="rowspan">
                    <!-- * Address -->
                    <div class="input-wrapper">
                      <div class="input-wrapper">
                        <span>Address</span>
                        <input
                          autocomplete="off"
                          type="text"
                          wire:model.defer="address"
                        />
                      </div>
                    </div>
                    @error('address') <span class="text-required">{{ $message }}</span>@enderror
                  </div>
                </div>

                <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
                <div class="small-con">
                  <!-- * Box -->
                  <div class="box">
                    <div class="box-wrap">
                      <!-- * Colspan 1: Upload Image and Update Buttons  -->
                      <div class="colspan">
                        <!-- * Upload Image -->
                        <div class="input-wrapper">
                          <!-- <input type="image"  style="width: 219px; height: 215px;" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" /> -->
                            @if($imgprofile)
                                <img type="image" class="profile" src="{{ $imgprofile->temporaryUrl() }}" alt="upload-image" data-field-officer-image-container>
                            @else
                                @if(file_exists(public_path('storage/users_profile/'.(isset($profilePath) ? $profilePath : 'xxxx'))))
                                    <img type="image" class="profile" src="{{ asset('storage/users_profile/'.$profilePath) }}" alt="upload-image" />                                                                     
                                @else
                                    <img type="image" class="profile" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" />                                               
                                @endif 
                            @endif     
                        
                        </div>

                        <!-- * Button Wrapper -->
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <input type="file" wire:model="imgprofile" class="input-image upload-profile-image-btn" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                          <!-- * Update Button -->
                          <button type="button" class="button" wire:click="register">Update</button>                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </form>
      </div>
</div>
