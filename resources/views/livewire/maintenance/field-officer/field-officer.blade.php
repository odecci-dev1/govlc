<div>

@if($showDialog == 1)
    <x-dialog :message="'Are you sure you want to trash this data '" :xmid="$mid" :confirmaction="'archive'" :header="'Trash'"></x-dialog>   
@endif
<x-error-dialog :message="(session('errormessage') ? session('errormessage') : 'Operation Failed. Retry ?')" :xmid="''" :confirmaction="session('erroraction') ? session('erroraction') : ''" :header="'Error'"></x-error-dialog>       
@if(session('mmessage'))
    <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
@endif

<!-- * New-Field-Officer-Container -->
<form action="" class="no-form-con" autocomplete="off">

<!-- * New Field Officer Container Wrapper -->
<div class="no-container-wrapper">

    <!-- * Container 1: New Member Form Fields and Buttons -->
    <div class="no-container-1">
             
        <!-- * Big Container -->
        <div class="big-con">

            <!-- * Form Header -->

            <!-- * Rowspan 1: Rowspan Header: Header and Buttons -->
            <div class="rowspan">
                <h2>Field Officer</h2>
            </div>

            <!-- * Rowspan 2: First Name, Middle Name , Last Name, and Suffix -->
            <div class="rowspan">
                <!-- * First Name -->
                <div class="input-wrapper">
                    <span>First Name</span>
                    <input wire:model.lazy="officer.Fname" autocomplete="off" type="text" >
                    @error('officer.Fname') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Middle Name -->
                <div class="input-wrapper">
                    <span>Middle Name</span>
                    <input wire:model.lazy="officer.Mname" autocomplete="off" type="text" >
                    @error('officer.Mname') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Last Name -->
                <div class="input-wrapper">
                    <span>Last Name</span>
                    <input wire:model.lazy="officer.Lname" autocomplete="off" type="text" >
                    @error('officer.Lname') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Suffix -->
                <div class="input-wrapper">
                    <span>Suffix</span>
                    <input wire:model.lazy="officer.Suffix" autocomplete="off" type="text" >
                    @error('officer.Suffix') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 3: Gender, Date Of Birth, Age, Place Of Birth and Civil Status -->
            <div class="rowspan">

                <!-- * Gender -->
                <div class="input-wrapper">
                    <span>Gender</span>
                    <div class="select-box">
                        <div class="select-box">
                            <select wire:model="officer.Gender" class="select-option">
                                <option value="">- - select - -</option>     
                                <option value="Male">Male</option>                                    
                                <option value="Female">Female</option>                                    
                            </select>                       
                        </div>
                        
                    </div>
                    @error('officer.Gender') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Date Of Birth -->
                <div class="input-wrapper">
                    <span>Date Of Birth</span>
                    <input wire:model.lazy="officer.DOB" wire:change="getofficerAge" autocomplete="off" type="date" >
                    @error('officer.DOB') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Age -->
                <div class="input-wrapper">
                    <span>Age</span>
                    <input wire:model.lazy="officer.Age" disabled autocomplete="off" type="number" >
                    @error('officer.Age') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Place Of Birth -->
                <div class="input-wrapper">
                    <span>Place Of Birth</span>
                    <input wire:model.lazy="officer.POB" autocomplete="off" type="text">
                    @error('officer.POB') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Civil Status -->
                <div class="input-wrapper">
                    <span>Civil Status</span>
                    <div class="select-box">
                        <div class="select-box">
                            <select  wire:model="officer.CivilStatus" class="select-option">
                                <option value="">- - select - -</option>     
                                <option value="Widow">Widow</option>                                    
                                <option value="Married">Married</option>      
                                <option value="Single">Single</option>                                     
                            </select>                       
                        </div>

                    </div>
                    @error('officer.CivilStatus') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 4: Contact Number and Email Address -->
            <div class="rowspan">

                <!-- * Contact Number -->
                <div class="input-wrapper">
                    <div class="input-wrapper">
                        <span>Contact Number</span>
                        <input wire:model.lazy="officer.Cno" autocomplete="off" type="number" >
                        @error('officer.Cno') <span class="text-required">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- * Email Address -->
                <div class="input-wrapper">
                    <div class="input-wrapper">
                        <span>Email Address</span>
                        <input wire:model.lazy="officer.EmailAddress" autocomplete="off" type="email" >
                        @error('officer.EmailAddress') <span class="text-required">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>

            <!-- * Rowspan 5: Barangay and House Address-->
            <div class="rowspan">

                <!-- * House No./ Bldg. No./ Room No./ Subdivision/ Street -->
                <div class="input-wrapper">
                    <span>House No./ Bldg. No./ Room No./ Subdivision/ Street</span>
                    <input wire:model.lazy="officer.HouseNo" autocomplete="off" type="text" >
                    @error('officer.HouseNo') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Barangay -->
                <div class="input-wrapper">
                    <span>Barangay</span>
                    <input wire:model.lazy="officer.Barangay" autocomplete="off" type="text"  >
                    @error('officer.Barangay') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 6: City / Municipality, Province / Region, and Country -->
            <div class="rowspan">


                <!-- * City / Municipality -->
                <div class="input-wrapper">
                    <span>City / Municipality</span>
                    <input wire:model.lazy="officer.City" autocomplete="off" type="text" >
                    @error('officer.City') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Province / Region -->
                <div class="input-wrapper">
                    <span>Province / Region</span>
                    <input wire:model.lazy="officer.Region" autocomplete="off" type="text"  >
                    @error('officer.Region') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Country -->
                <div class="input-wrapper">
                    <span>Country</span>
                    <input wire:model.lazy="officer.Country" autocomplete="off" type="text"  >
                    @error('officer.Country') <span class="text-required">{{ $message }}</span>@enderror
                </div>


            </div>

        </div>

    </div>

    <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
    <div class="no-container-2">

        <!-- * Small Container -->
        <div class="small-con">

            <div class="box-wrap">

                <h3>Upload Files</h3>
                <!-- * Colspan 1: Upload Image, Attach Files and Save Buttons  -->
                <div class="colspan">
                    {{-- <!-- * Upload Image -->
                    <div class="input-wrapper" data-upload-image-field-officer-hover-container>
                        @if($officer['Profile'])
                            <img type="image" class="profile" src="{{ $officer['Profile']->temporaryUrl() }}" alt="upload-image" data-field-officer-image-container>
                        @else
                            @if(file_exists(public_path('storage/officer_profile/'.(isset($officer['Profile']) ? $officer['Profile'] : 'xxxx'))))
                                <img type="image" class="profile" src="{{ $officer['Profile'] }}" alt="upload-image" />                                                                     
                            @else
                                <img type="image" class="ProfilePath" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" />   
                                <p style="position: absolute">Max Size: 2MB</p>                                            
                            @endif 
                        @endif                          
                    </div> --}}

                    <!-- Upload Image -->
                    <div class="input-wrapper" data-upload-image-field-officer-hover-container>
                        @if(is_object($officer['Profile']) && method_exists($officer['Profile'], 'temporaryUrl'))
                            <img type="image" class="profile" src="{{ $officer['Profile']->temporaryUrl() }}" alt="upload-image" data-field-officer-image-container>
                        @elseif(isset($officer['Profile']) && file_exists(public_path('storage/officer_profile/' . $officer['Profile'])))
                            <img type="image" class="profile" src="{{ asset('storage/officer_profile/' . $officer['Profile']) }}" alt="upload-image" />
                        @else
                            <img type="image" class="ProfilePath" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" />   
                            <p style="position: absolute">Max Size: 2MB</p>
                        @endif
                    </div>


                    <!-- * Button Wrapper -->
                    <div class="btn-wrapper">
                        @error('officer.Profile') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                        <!-- * Upload Button -->
                        @if($usertype != 2)
                        <input type="file" wire:model="officer.Profile" class="input-image upload-profile-image-btn" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                        @endif
                        <div wire:loading wire:target="officer.Profile">Uploading...</div>
                        <!-- * Attach Button -->
                        @if($usertype != 2)
                        <input type="file" wire:model="officer.Attachments" class="input-image attach-file-btn" accept=".txt, .pdf, .docx, .xlsx, .jpg, .jpeg, .png" multiple data-attach-field-officer-file-btn></input>
                        @endif
                        <div wire:loading wire:target="officer.Attachments">Uploading...</div>
                        @error('officer.Attachments') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                    </div>

                    <!-- * File Chips Container -->           
                    {{-- <div class="file-wrapper" style="padding: 2rem 0rem;" data-attach-file-container2>                   
                        @if(isset($officer['Attachments']))                           
                            @if($officer['Attachments'] == $officer['Old_Attachments'])                            
                                @foreach($officer['Attachments'] as $attachments)                                                                                                                                
                                        @if(file_exists(public_path('storage/officer_attachments/'.(isset($attachments['filePath']) ? $attachments['filePath'] : $attachments->getClientOriginalName() ))))
                                            @php
                                                $getfilename = $attachments['filePath'];
                                                $filenamearray = explode("_", $getfilename);
                                                $filename = isset($filenamearray[3]) ? $filenamearray[3] : '';
                                            @endphp                                               
                                            <a href="{{ asset('storage/officer_attachments/'.$attachments['filePath']) }}" title="{{ $filename }}" target="_blank">                                                                                              
                                                <div type="button" class="fileButton">
                                                <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png"> 
                                                {{ strlen($filename) > 23 ? strtolower(substr($filename, 0, 23)) . '...' : $filename }}
                                                </div>    
                                            </a>   
                                        @else
                                            @php 
                                                $filename = 'File is deleted';
                                            @endphp 
                                            <a href="#" title="{{ $filename }}" target="_blank">                                                                                              
                                                <div type="button" class="fileButton">
                                                <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png"> 
                                                {{ strlen($filename) > 23 ? strtolower(substr($filename, 0, 23)) . '...' : $filename }}
                                                </div>    
                                            </a>                                      
                                        @endif                                
                                                                        
                                @endforeach
                            @else                            
                                @if(isset($officer['Attachments']))                            
                                    @foreach($officer['Attachments'] as $attachments)                                                     
                                        
                                            <a href="{{ $attachments->path() }}" target="_blank" title="{{ $attachments->getClientOriginalName() }}">                                                    
                                                <div type="button" class="fileButton">
                                                <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">
                                                {{ strlen($attachments->getClientOriginalName()) > 23 ? strtolower(substr($attachments->getClientOriginalName(), 0, 23)) . '...' : $attachments->getClientOriginalName() }}
                                                </div>
                                            </a>                                       
                                        
                                        <!-- <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">{{ $attachments->getClientOriginalName() }}</button> -->
                                    @endforeach
                                @endif   
                            @endif   
                            
                        @else                              
                            @if(isset($officer['Attachments']))                            
                                @foreach($officer['Attachments'] as $attachments)                                                     
                                    
                                        <a href="{{ $attachments->path() }}" target="_blank" alt="file.png">
                                            <div type="button" class="fileButton">
                                            <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">
                                                {{ strlen($attachments->getClientOriginalName()) > 23 ? strtolower(substr($attachments->getClientOriginalName(), 0, 23)) . '...' : $attachments->getClientOriginalName() }}
                                            </div>
                                        </a>                                       
                                    
                                    <!-- <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">{{ $attachments->getClientOriginalName() }}</button> -->
                                @endforeach
                            @endif   
                        @endif                        
                    </div> --}}
                    <div class="file-wrapper" style="padding: 2rem 0rem;" data-attach-file-container2>                   
                        @if(isset($officer['Attachments']))
                            @foreach($officer['Attachments'] as $attachment)
                                @php
                                    // Determine if $attachment is from the FieldOfficer model or another source
                                    $filePath = is_array($attachment) ? (isset($attachment['FilePath']) ? $attachment['FilePath'] : '') : $attachment->path();
                                    $filename = is_array($attachment) ? (isset($attachment['FilePath']) ? basename($attachment['FilePath']) : '') : $attachment->getClientOriginalName();
                                    $filename = preg_replace('/^officer_attachments_\d+_/', '', $filename);
                                @endphp
                    
                                @if(!empty($filePath))
                                    <div style="position: relative">
                                        <a href="{{ asset($filePath) }}" src="{{ asset('storage/officer_attachments/' . $officer['Profile']) }}" title="{{ $filename }}" target="_blank">                                                                                              
                                            <div type="button" class="fileButton">
                                                <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png"> 
                                                {{ strlen($filename) > 23 ? strtolower(substr($filename, 0, 23)) . '...' : $filename }}
                                            </div>    
                                        </a>
                                        {{-- *** Delete File Button *** --}}
                                        <button 
                                            style="
                                                position: absolute; 
                                                top: -8px;
                                                right: 0;
                                                padding: 1.2px 5px; 
                                                color: white; 
                                                background: red; 
                                                border-radius: 50%;"
                                            >
                                            <span >x</span>
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                  
                    <!-- * Save Button -->
                    @if($usertype != 2)
                        @if($foid == null)
                            <button type="button" wire:click="store" class="button save-btn">Save</button>
                        @else   
                        <button type="button" wire:click="update" class="button save-btn">Update</button>
                        <button type="button" onclick="showDialog('{{ $foid }}')" class="button save-btn">Trash</button>
                        @endif
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

<!-- * Container 3: Requirements -->
<div class="no-container-3">

    <!-- * Small Container -->
    <div class="small-con-2">

        <!-- * Rowspan 1: Header -->
        <div class="rowspan">

            <!-- * Requirements -->
            <div class="input-wrapper">
                <h2>Requirements</h2>
            </div>

        </div>

        <!-- * Rowspan 2: Valid ID Presented and ID Number -->
        <div class="rowspan">

            <!-- * Valid ID Presented  -->
            <div class="input-wrapper">
                <span>Valid ID Presented</span>
                <div class="select-box">

                    <select  wire:model="officer.IDType" class="select-option">
                        <option value="">- - select - -</option>     
                        @if(count($idtypes) > 0)
                            @foreach($idtypes as $midtypes)
                            <option value="{{ $midtypes['typeID'] }}">{{ $midtypes['type'] }}</option>     
                            @endforeach
                        @endif     
                    </select>          
                    
                </div>
                @error('officer.IDType') <span class="text-required">{{ $message }}</span>@enderror
            </div>

            <!-- * ID Number -->
            <div class="input-wrapper">
                <span>ID Number</span>
                <input wire:model.lazy="officer.ID_Number" type="text">
                @error('officer.ID_Number') <span class="text-required">{{ $message }}</span>@enderror
            </div>

        </div>

        <!-- * Rowspan 3: ID Front and Back Image Input  -->
        <div class="rowspan">

            <div class="wrapper">
               

                <!-- * ID Front Image Input --> 
                <div class="input-wrapper">
                    <span>Front</span>
                    @if(isset($officer['FrontID']) && is_object($officer['FrontID']))
                        <img class="profile" style="object-fit: contain;" src="{{ $officer['FrontID']->temporaryUrl() }}" alt="Front Image" id="frontImage" name="frontImage">
                        <p>&nbsp;</p>
                    @else
                        @if(isset($officer['FrontID']) && file_exists(public_path('storage/officer_ids/' . $officer['FrontID'])))
                            <img class="profile" style="object-fit: contain;" src="{{ asset('storage/officer_ids/' . $officer['FrontID']) }}" alt="Front Image" id="frontImage" name="frontImage">
                            <p>&nbsp;</p>
                        @else
                            <img class="profile" style="object-fit: contain;" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="Front Image" id="frontImage" name="frontImage">                                             
                            <p>Max Size: 2MB</p>
                        @endif
                    @endif  

                    <div class="btn-wrapper">       
                        @if($usertype != 2)         
                        <input type="file" wire:model="officer.FrontID" class="input-image upload-profile-image-btn" style="margin-top: 1rem; background-color: #d6a330;" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                        @endif
                    </div>
                    <div wire:loading wire:target="officer.FrontID">Uploading...</div>

                    @error('officer.FrontID') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                </div>

                <!-- * ID Back Image Input -->
                <div class="input-wrapper">
                    <span>Back</span>                   
                    @if(isset($officer['BackID']) && is_object($officer['BackID']))
                        <img class="profile" style="object-fit: contain;" src="{{ $officer['BackID']->temporaryUrl() }}" alt="Back Image" id="BackImage" name="BackImage">
                        <p>&nbsp;</p>
                    @else
                        @if(isset($officer['BackID']) && file_exists(public_path('storage/officer_ids/' . $officer['BackID'])))
                            <img class="profile" style="object-fit: contain;" src="{{ asset('storage/officer_ids/' . $officer['BackID']) }}" alt="Back Image" id="BackImage" name="BackImage">
                            <p>&nbsp;</p>
                        @else
                            <img class="profile" style="object-fit: contain;" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="Back Image" id="BackImage" name="BackImage">                                             
                            <p>Max Size: 2MB</p>
                        @endif 
                    @endif   

                    <div class="btn-wrapper">
                        @if($usertype != 2)
                        <input type="file" wire:model="officer.BackID" class="input-image upload-profile-image-btn" style="margin-top: 1rem; background-color: #d6a330;" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                        @endif
                    </div>
                    <div wire:loading wire:target="officer.BackID">Uploading...</div>

                    @error('officer.BackID') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                </div>

            </div>

            

        </div>

        <!-- * Rowspan 4: Philhealth Number, Pag-ibig Number and SSS Number -->
        <div class="rowspan">

            <div class="wrapper-2">

                <!-- * Philhealth Number -->
                <div class="input-wrapper">
                    <span>Philhealth Number</span>
                    <input wire:model.lazy="officer.PhilHealth" type="text">
                    @error('officer.PhilHealth') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Pag-ibig Number -->
                <div class="input-wrapper">
                    <span>Pag-ibig Number</span>
                    <input wire:model.lazy="officer.PagIbig" type="text" >
                    @error('officer.PagIbig') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * SSS Number -->
            <div class="input-wrapper">
                <span>SSS Number</span>
                <input wire:model.lazy="officer.SSS" type="text" >
                @error('officer.SSS') <span class="text-required">{{ $message }}</span>@enderror
            </div>

        </div>

    </div>

</div>
<script>
        document.addEventListener('livewire:load', function () {
            window.showDialog = function($mid){              
                @this.call('showDialog', $mid);        
            };

            window.archive = function($mid){
                @this.call('archive', $mid);       
            };

            window.livewire.on('EMIT_ERROR_ASKING_DIALOG', data =>{
                document.getElementById('error-asking-dialog-div').style.visibility="visible";
            });
        })
      
</script>
@if(session('errmmessage'))
    <x-error :message="session('errmmessage')" :words="'Action not successfull'" :header="'Error'"></x-error>   
@endif
</div>
