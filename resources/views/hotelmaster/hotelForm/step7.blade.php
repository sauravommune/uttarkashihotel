<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 7]) }}" class="global-ajax-form" method="post"
        enctype="multipart/form-data" id="step7form">
        <input type="hidden" name="id" value="{{ $hotel->id }}">
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Upload Images of Hotel
                    </h3>
                    <!--end::Title-->
                </div>
            </div>
            <div class="card-body p-5">
              
                <div class="row mb-5">
                <!-- New Image Field (Single Image) -->
                <div class="row mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5" id="room-imgs">Select Image for index page</label>
                    </div>
                    <div class="col-sm-9">
                        <div id="imageDropzone2" class="mt-4" style="border: 2px dashed #007bff; padding: 20px; text-align: center;">
                            <input type="file" name="search_page_img" id="images2" accept="image/*" style="display: none;">
                            <div class="d-flex align-items-center gap-4">
                                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex align-items-start flex-column">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop a file here or click to upload.</h3>
                                    <span class="fs-7 fw-semibold text-gray-500">Upload a single file</span>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div id="previewContainer2" style="margin-top: 20px;"></div>

                        @if($hotel->hotel_img)
                        <div style="display: inline-block; position: relative; margin-right: 10px;">
                            <img src="{{ asset('storage/'.$hotel->hotel_img) }}" width="100px" height="80px" />

                        </div>
                        @endif
                    </div>
                   
                    <div class="col-sm-3 mt-5">
                        <label class="fw-semibold mb-2 mt-5">Image Name</label>
                    </div>
                    <div class="col-sm-9 mt-5">
                        <input type="text" id="" class="form-control" name="searchImageName" value="{{$hotel?->image_name??""}}" required  placeholder="Please enter image name..."  />
                    </div>

                    <div class="col-sm-3 mt-5">
                        <label class="fw-semibold mb-2 mt-5">Alt Tag</label>
                    </div>
                    <div class="col-sm-9 mt-5">
                        <input type="text" id="" class="form-control" name="searchAltTag"  value="{{$hotel->alt_tag??''}}" required  placeholder="Please enter alt tag..."  />
                    </div>
 
                </div>
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5" id="room-imgs">Select Image(s)</label>
                    </div>
                    <div class="col-sm-9">
                        <div id="imageDropzone" class="mt-4">
                            <input type="file" name="hotel_images[]" id="images" multiple accept="image/*"  style="display: none;">
                            <div class="d-flex align-items-center gap-4 ">
                                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span
                                        class="path2"></span></i>
                                <div class="d-flex align-items-start flex-column ">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fs-7 fw-semibold text-gray-500">Upload up to 50 files</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @dd($hotel->images); --}}

                    <div class="row mt-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">

                            @if (!empty($hotel->images))
                          
                            @foreach ($hotel->images as $key => $img)
                              
                                {{-- <div style="display: inline-block; position: relative; margin-right: 10px;" class="d-flex"> --}}
                                
                                    <div style="position: relative; left:0px; top:-7px;" class="d-flex align-items-center my-4">
                                        <img src="{{ asset('storage/' . $img->image) }}" width="100px" height="80px" />
                                        <input type="hidden" name="imageId[{{ $key }}]" value="{{ $img->id }}">

                                        <button type="button" onclick="deleteImage({{ $img->id }})"
                                            style="position: absolute; top: -10px; left: -12px; background: none; border: none; cursor: pointer;">
                                            <i class="cancel-icon">✖</i>
                                        </button>

                                        <input  class="form-control mx-3" type="text" name="existingImageName[{{ $key }}]" value="{{ $img->image_name }}" required placeholder="Please enter image name...">
                                        <input class="form-control ms-3" type="text" name="existingAltTag[{{ $key }}]"    value="{{ $img->alt_tag}}" required placeholder="Please enter alt tag...">
                                    </div>
                                
                            @endforeach
                        @endif


                            <div id="previewContainer" style="margin-top: 20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="d-none" id="step7">
    </form>
    <!--end::Input group-->
</div>

@push('scripts')

    <script>
        const dropzone = document.getElementById('imageDropzone');
        const fileInput = document.getElementById('images');
        const previewContainer = document.getElementById('previewContainer');
        let uploadedFiles = [];

        const dropzone2 = document.getElementById('imageDropzone2');
        const fileInput2 = document.getElementById('images2');
        const previewContainer2 = document.getElementById('previewContainer2');
        let uploadedFile2 = null; // To store a single file

        // Open file input when dropzone is clicked (Field 1)
        dropzone.addEventListener('click', () => {
  
            fileInput.click();
        });

        // Handle drag and drop events (Field 1)
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.style.borderColor = '#007bff'; // Reset border color
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        // Handle file input change (Field 1)
        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        function createInputField(id, name, placeholder, classes = []) {
            const inputField = document.createElement('input');
            inputField.type = 'text';                // Type of input field
            inputField.id = id;                      // ID for input field
            inputField.name = name;                  // Name for input field
            inputField.placeholder = placeholder;    // Placeholder for input field
            inputField.required = true;              // Make the field required (HTML5)

            
            // Add dynamic classes passed via parameter
            inputField.classList.add('form-control');
            inputField.classList.add(...classes);    // Add additional classes

            return inputField;
        }
        function handleFiles(files) {
            if (uploadedFiles.length + files.length > 50) {
                // Show SweetAlert if limit exceeded
                Swal.fire({
                    title: 'File limit exceeded!',
                    text: 'You can only upload a maximum of 50 files.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            previewContainer.innerHTML = '';

            for (let i = 0; i < files.length; i++) {

                const file = files[i];
                const fileExtension = file.name.split('.').pop().toLowerCase();

                // Reject AVIF files
                if (fileExtension === 'avif' || file.type === 'image/avif') {
                    Swal.fire({
                        title: 'AVIF format not allowed!',
                        text: 'Please upload images in formats like JPG, PNG, or WEBP.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                if (file.type.startsWith('image/')) {
                    uploadedFiles.push(file);
                    const reader = new FileReader();

                    reader.onload = (event) => {
                        const previewDiv = document.createElement('div');
                        previewDiv.classList.add('image-preview', 'd-flex' ,'align-items-center');

                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.width = '100px';
                        img.style.border = '1px solid #ddd';

                        const removeBtn = document.createElement('button');
                        removeBtn.innerText = 'x';
                        removeBtn.classList.add('remove-btn','cancel-icon');

                        const inputField1 = createInputField('id', `imageName[${i}]`, 'Please enter image name...', ['my-4', 'ms-4', 'w-50']);
                        const inputField2 = createInputField('id', `altTag[${i}]`, 'Please enter alt tag...', ['my-4', 'mx-4', 'w-50']);

                        removeBtn.addEventListener('click', () => {
                            previewContainer.removeChild(previewDiv);
                            uploadedFiles = uploadedFiles.filter(f => f.name !== file.name);
                        });

                        previewDiv.appendChild(img);
                        previewDiv.appendChild(removeBtn);
                        previewDiv.appendChild(inputField1);
                        previewDiv.appendChild(inputField2);
                        previewContainer.appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                }
            }

        }

        dropzone2.addEventListener('click', () => {
            
            fileInput2.click();
        });

        dropzone2.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        dropzone2.addEventListener('dragleave', () => {
            dropzone2.style.borderColor = '#007bff';
        });

        dropzone2.addEventListener('drop', (e) => {
            e.preventDefault();
            const files = e.dataTransfer.files;
            handleSingleFile(files);
        });

        // Handle file input change (Field 2)
        fileInput2.addEventListener('change', (e) => {
            const files = e.target.files;
            handleSingleFile(files);
        });
        function handleSingleFile(files) {
            if (uploadedFile2) {
                previewContainer2.innerHTML = '';
                uploadedFile2 = null;
            }

         
            const file = files[0]; // Only handle the first file
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (fileExtension === 'avif' || file.type === 'image/avif') {
                Swal.fire({
                    title: 'AVIF format not allowed!',
                    text: 'Please upload images in formats like JPG, PNG, or WEBP.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
            if (file && file.type.startsWith('image/')) {
            
                uploadedFile2 = file;
                const reader = new FileReader();
                reader.onload = (event) => {
                    const previewDiv = document.createElement('div');
                    previewDiv.classList.add('image-preview');

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '100px';
                    img.style.border = '1px solid #ddd';

                    // Create remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.innerText = '✖';
                    removeBtn.classList.add('remove-btn','cancel-icon'); 
                    
                    // const inputField1 = createInputField('id', `searchImageName`, 'Please enter image name...', ['my-4', 'ms-4', 'w-50']);
                    // const inputField2 = createInputField('id', `searchAltTag`, 'Please enter alt tag...', ['my-4', 'mx-4', 'w-50']);


                    // Remove image on button click
                    removeBtn.addEventListener('click', () => {
                        previewContainer2.removeChild(previewDiv);
                        uploadedFile2 = null;
                    });

                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer2.appendChild(previewDiv);
                    // previewDiv.appendChild(inputField1);
                    // previewDiv.appendChild(inputField2);
                    
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                // Handle case where file is not an image
                Swal.fire({
                    title: 'Invalid file type!',
                    text: 'Please upload only image files.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
</script>

<script>
    function deleteImage(imageId) {

        $.ajax({
            url: "{{ route('delete.roomImage') }}/" + imageId,
            type: 'DELETE',
            success: function(response) {   
                if (response.status == 200) {
                    $('button[onclick="deleteImage(' + imageId + ')"]').closest('div').remove();
    
                }
            },
        });
    }
</script>
@endpush
