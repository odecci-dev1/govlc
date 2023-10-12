<div>
@if($showDialog == 1)
    <x-dialog :message="'Are you sure you want to trash this data '" :xmid="$mid" :confirmaction="'archive'" :header="'Trash'"></x-dialog>   
@endif
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
                <h2>New Field Officer</h2>
            </div>

            <!-- * Rowspan 2: First Name, Middle Name , Last Name, and Suffix -->
            <div class="rowspan">

                <!-- * First Name -->
                <div class="input-wrapper">
                    <span>First Name</span>
                    <input wire:model.lazy="officer.fname" autocomplete="off" type="text" >
                    @error('officer.fname') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Middle Name -->
                <div class="input-wrapper">
                    <span>Middle Name</span>
                    <input wire:model.lazy="officer.mname" autocomplete="off" type="text" >
                    @error('officer.mname') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Last Name -->
                <div class="input-wrapper">
                    <span>Last Name</span>
                    <input wire:model.lazy="officer.lname" autocomplete="off" type="text" >
                    @error('officer.lname') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Suffix -->
                <div class="input-wrapper">
                    <span>Suffix</span>
                    <input wire:model.lazy="officer.suffix" autocomplete="off" type="text" >
                    @error('officer.suffix') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 3: Gender, Date Of Birth, Age, Place Of Birth and Civil Status -->
            <div class="rowspan">

                <!-- * Gender -->
                <div class="input-wrapper">
                    <span>Gender</span>
                    <div class="select-box">

                        <div class="options-container" data-option-con1>

                            <div class="option" data-option-item1>

                                <input type="radio" wire:model.lazy="officer.gender" class="radio" id="male" value="Male" />
                                <label for="male">
                                    <h4>Male</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item1>

                                <input type="radio" wire:model.lazy="officer.gender" class="radio" id="female" value="Female" />
                                <label for="female">
                                    <h4>Female</h4>
                                </label>

                            </div>

                        </div>

                        <div class="selected" style="font-weight: bold;" data-option-select1>
                            {{ isset($officer['gender']) ? $officer['gender'] : '' }}
                        </div>

                    </div>
                    @error('officer.gender') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Date Of Birth -->
                <div class="input-wrapper">
                    <span>Date Of Birth</span>
                    <input wire:model.lazy="officer.dob" wire:change="getofficerAge" autocomplete="off" type="date" >
                    @error('officer.dob') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Age -->
                <div class="input-wrapper">
                    <span>Age</span>
                    <input wire:model.lazy="officer.age" disabled autocomplete="off" type="number" >
                    @error('officer.age') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Place Of Birth -->
                <div class="input-wrapper">
                    <span>Place Of Birth</span>
                    <input wire:model.lazy="officer.pob" autocomplete="off" type="text">
                    @error('officer.pob') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Civil Status -->
                <div class="input-wrapper">
                    <span>Civil Status</span>
                    <div class="select-box">

                        <div class="options-container" data-option-con2>

                            <div class="option" data-option-item2>

                                <input type="radio" wire:model.lazy="officer.civilStatus" id="Widow" class="radio"  value="Widow" />
                                <label for="Widow">
                                    <h4>Widow</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item2>

                                <input type="radio" wire:model.lazy="officer.civilStatus" id="Married" class="radio" value="Married" />
                                <label for="Married">
                                    <h4>Married</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item2>

                                <input type="radio" wire:model.lazy="officer.civilStatus" id="Single" class="radio"  value="Single" />
                                <label for="Single">
                                    <h4>Single</h4>
                                </label>

                            </div>

                        </div>

                        <div class="selected" style="font-weight: bold;" data-option-select2>
                            {{ isset($officer['civilStatus']) ? $officer['civilStatus'] : '' }}
                        </div>

                    </div>
                    @error('officer.civilStatus') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 4: Contact Number and Email Address -->
            <div class="rowspan">

                <!-- * Contact Number -->
                <div class="input-wrapper">
                    <div class="input-wrapper">
                        <span>Contact Number</span>
                        <input wire:model.lazy="officer.cno" autocomplete="off" type="number" >
                        @error('officer.cno') <span class="text-required">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- * Email Address -->
                <div class="input-wrapper">
                    <div class="input-wrapper">
                        <span>Email Address</span>
                        <input wire:model.lazy="officer.emailAddress" autocomplete="off" type="email" >
                        @error('officer.emailAddress') <span class="text-required">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>

            <!-- * Rowspan 5: Barangay and House Address-->
            <div class="rowspan">

                <!-- * House No./ Bldg. No./ Room No./ Subdivision/ Street -->
                <div class="input-wrapper">
                    <span>House No./ Bldg. No./ Room No./ Subdivision/ Street</span>
                    <input wire:model.lazy="officer.houseNo" autocomplete="off" type="text" >
                    @error('officer.houseNo') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Barangay -->
                <div class="input-wrapper">
                    <span>Barangay</span>
                    <input wire:model.lazy="officer.barangay" autocomplete="off" type="text"  >
                    @error('officer.barangay') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 6: City / Municipality, Province / Region, and Country -->
            <div class="rowspan">


                <!-- * City / Municipality -->
                <div class="input-wrapper">
                    <span>City / Municipality</span>
                    <input wire:model.lazy="officer.city" autocomplete="off" type="text" >
                    @error('officer.city') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Province / Region -->
                <div class="input-wrapper">
                    <span>Province / Region</span>
                    <input wire:model.lazy="officer.region" autocomplete="off" type="text"  >
                    @error('officer.region') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Country -->
                <div class="input-wrapper">
                    <span>Country</span>
                    <input wire:model.lazy="officer.country" autocomplete="off" type="text"  >
                    @error('officer.country') <span class="text-required">{{ $message }}</span>@enderror
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

                    <!-- * Upload Image -->
                    <div class="input-wrapper" data-upload-image-field-officer-hover-container>
                        @if($imgprofile)
                            <img type="image" class="profile" src="{{ $imgprofile->temporaryUrl() }}" alt="upload-image" data-field-officer-image-container>
                        @else
                            @if(file_exists(public_path('storage/officer_profile/'.(isset($officer['profile']) ? $officer['profile'] : 'xxxx'))))
                                <img type="image" class="profile" src="{{ asset('storage/officer_profile/'.$officer['profile']) }}" alt="upload-image" />                                                                     
                            @else
                                <img type="image" class="profile" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" />                                               
                            @endif 
                        @endif                          
                    </div>

                    <!-- * Button Wrapper -->
                    <div class="btn-wrapper">
                        @error('imgprofile') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                        <!-- * Upload Button -->
                        <input type="file" wire:model="imgprofile" class="input-image upload-profile-image-btn" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                        <div wire:loading wire:target="imgprofile">Uploading...</div>
                        <!-- * Attach Button -->
                        <input type="file" wire:model="officer.attachments" class="input-image attach-file-btn" accept=".txt, .pdf, .docx, .xlsx" multiple data-attach-field-officer-file-btn></input>
                        <div wire:loading wire:target="officer.attachments">Uploading...</div>
                        @error('officer.attachments') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                    </div>

                    <!-- * File Chips Container -->           
                    <div class="file-wrapper" data-attach-file-container>                   
                    
                            @if(isset($officer['attachments']))
                                @if($officer['attachments'] == $officer['old_attachments'])                            
                                    @foreach($officer['attachments'] as $attachments)                                                     
                                        <div type="button" class="fileButton">
                                            <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">                                           
                                            @if(file_exists(public_path('storage/officer_attachments/'.(isset($attachments['filePath']) ? $attachments['filePath'] : $attachments->getClientOriginalName() ))))
                                                @php
                                                    $getfilename = $attachments['filePath'];
                                                    $filenamearray = explode("_", $getfilename);
                                                    $filename = isset($filenamearray[3]) ? $filenamearray[3] : '';
                                                @endphp                                               
                                                <a href="{{ asset('storage/officer_attachments/'.$attachments['filePath']) }}" title="{{ $filename }}" target="_blank">                                                                                              
                                                    {{ strlen($filename) > 10 ? strtolower(substr($filename, 0, 10)) . '...' : $filename }}
                                                </a>                                               
                                            @endif                                
                                        </div>                                        
                                    @endforeach
                                @else
                                    @if(isset($officer['attachments']))                            
                                        @foreach($officer['attachments'] as $attachments)                                                     
                                            <div type="button" class="fileButton">
                                                <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">
                                                <a href="{{ $attachments->path() }}" target="_blank" title="{{ $attachments->getClientOriginalName() }}">                                                    
                                                    {{ strlen($attachments->getClientOriginalName()) > 10 ? strtolower(substr($attachments->getClientOriginalName(), 0, 10)) . '...' : $attachments->getClientOriginalName() }}
                                                </a>                                       
                                            </div>
                                            <!-- <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">{{ $attachments->getClientOriginalName() }}</button> -->
                                        @endforeach
                                    @endif   
                                @endif   
                                
                            @else
                                @if(isset($officer['attachments']))                            
                                    @foreach($officer['attachments'] as $attachments)                                                     
                                        <div type="button" class="fileButton">
                                            <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">
                                            <a href="{{ $attachments->path() }}" target="_blank" alt="file.png">{{ $attachments->getClientOriginalName() }}</a>                                       
                                        </div>
                                        <!-- <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">{{ $attachments->getClientOriginalName() }}</button> -->
                                    @endforeach
                                @endif   
                            @endif                        
                    </div>

                    <!-- * Save Button -->
                    @if($foid == '')
                    <button type="button" wire:click="store" class="button save-btn">Save</button>
                    @else
                    <button type="button" wire:click="update" class="button save-btn">Update</button>
                    <button type="button" onclick="showDialog('{{ $foid }}')" class="button save-btn">Trash</button>
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

                    <div class="options-container" data-option-con3>

                        @if(count($idtypes) > 0)
                            @foreach($idtypes as $midtypes)
                            <div class="option"  data-option-item3>

                                <input type="radio" {{ isset($officer['typeID']) ? ($officer['typeID'] == $midtypes['typeID'] ? 'checked' : '') : '' }} wire:model.lazy="officer.typeID" wire:change="getIdTypeName('{{ $midtypes['type'] }}')" name="typeID" id="idtype{{ $midtypes['typeID'] }}" class="radio"  value="{{ $midtypes['typeID'] }}" />
                                <label  for="idtype{{ $midtypes['typeID'] }}" style="width: 100%; height: 100%;">
                                    <h4>{{ $midtypes['type'] }}</h4>
                                </label>

                            </div>
                            @endforeach
                        @endif                                              

                    </div>

                    <div class="selected" style="font-weight: bold;"  data-option-select3>
                        {{ isset($idtypename) ? $idtypename : '' }}
                    </div>

                </div>
                @error('officer.typeID') <span class="text-required">{{ $message }}</span>@enderror
            </div>

            <!-- * ID Number -->
            <div class="input-wrapper">
                <span>ID Number</span>
                <input wire:model.lazy="officer.idNum" type="text">
                @error('officer.idNum') <span class="text-required">{{ $message }}</span>@enderror
            </div>

        </div>

        <!-- * Rowspan 3: ID Front and Back Image Input  -->
        <div class="rowspan">

            <div class="wrapper">
                <!-- dito -->
                <!-- * ID Front Image Input -->
                <div class="input-wrapper">
                    <span>Front</span>
                    @if($imgfrontID)
                        <img class="profile" style="object-fit: contain;" src="{{ $imgfrontID->temporaryUrl() }}" alt="Front Image" id="frontImage" name="frontImage">
                    @else
                        @if(file_exists(public_path('storage/officer_ids/'.(isset($officer['frontID']) ? $officer['frontID'] : 'xxxx'))))    
                            <img class="profile" style="object-fit: contain;" src="{{ asset('storage/officer_ids/'.$officer['frontID']) }}" alt="Front Image" id="frontImage" name="frontImage">
                        @else
                            <img class="profile" style="object-fit: contain;" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="Front Image" id="frontImage" name="frontImage">                                             
                        @endif 
                    @endif   
                    <div class="btn-wrapper">                
                        <input type="file" wire:model="imgfrontID" class="input-image upload-profile-image-btn" style="margin-top: 1rem; background-color: #d6a330;" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                    </div>
                    @error('imgfrontID') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                </div>

                <!-- * ID Back Image Input -->
                <div class="input-wrapper">
                    <span>Back</span>                   
                    @if($imgbackID)
                        <input type="image" class="profile" src="{{ $imgbackID->temporaryUrl() }}" alt="Front Image" id="frontImage" name="frontImage">
                    @else
                        @if(file_exists(public_path('storage/officer_ids/'.(isset($officer['backID']) ? $officer['backID'] : 'xxxx'))))    
                            <input type="image" class="profile" src="{{ asset('storage/officer_ids/'.$officer['backID']) }}" alt="Front Image" id="frontImage" name="frontImage">
                        @else
                            <input type="image" class="profile" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="Front Image" id="frontImage" name="frontImage">                                             
                        @endif 
                    @endif   
                    <div class="btn-wrapper">
                        <input type="file" wire:model="imgbackID" class="input-image upload-profile-image-btn" style="margin-top: 1rem; background-color: #d6a330;" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                    </div>
                    @error('imgbackID') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                </div>

            </div>

            

        </div>

        <!-- * Rowspan 4: Philhealth Number, Pag-ibig Number and SSS Number -->
        <div class="rowspan">

            <div class="wrapper-2">

                <!-- * Philhealth Number -->
                <div class="input-wrapper">
                    <span>Philhealth Number</span>
                    <input wire:model.lazy="officer.philHealth" type="text">
                    @error('officer.philHealth') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Pag-ibig Number -->
                <div class="input-wrapper">
                    <span>Pag-ibig Number</span>
                    <input wire:model.lazy="officer.pagIbig" type="text" >
                    @error('officer.pagIbig') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * SSS Number -->
            <div class="input-wrapper">
                <span>SSS Number</span>
                <input wire:model.lazy="officer.sss" type="text" >
                @error('officer.sss') <span class="text-required">{{ $message }}</span>@enderror
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
        })
        // ** Select Dropdown 1
        const selectedOpt1 = document.querySelector('[data-option-select1]');
        const optionsContainer1 = document.querySelector('[data-option-con1]');
        const optionsList1 = document.querySelectorAll('[data-option-item1]');
       
        selectedOpt1.addEventListener("click", () => {           
            optionsContainer1.classList.toggle("active");
        });

        optionsList1.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt1.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer1.classList.remove("active");
            });
        });

        // ** Select Dropdown 2
        const selectedOpt2 = document.querySelector('[data-option-select2]');
        const optionsContainer2 = document.querySelector('[data-option-con2]');
        const optionsList2 = document.querySelectorAll('[data-option-item2]');

        selectedOpt2.addEventListener("click", () => {
            optionsContainer2.classList.toggle("active");
        });

        optionsList2.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt2.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer2.classList.remove("active");
            });
        });

        // ** Select Dropdown 3
        const selectedOpt3 = document.querySelector('[data-option-select3]');
        const optionsContainer3 = document.querySelector('[data-option-con3]');
        const optionsList3 = document.querySelectorAll('[data-option-item3]');

        selectedOpt3.addEventListener("click", () => {
            optionsContainer3.classList.toggle("active");
        });

        optionsList3.forEach(option => {
            option.addEventListener("click", () => {
                // selectedOpt3.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer3.classList.remove("active");
            });
        });
</script>
</div>
