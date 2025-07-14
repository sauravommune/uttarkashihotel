<div class="flex-column" data-kt-stepper-element="content" id="step-4">
    <form class="global-ajax-form" action="{{ route('rooms.save') }}" method="post" data-redirect-url="{{ route('rooms', encode($hotel?->id)) }}" novalidate="novalidate" id="step4form" enctype="multipart/form-data">
        <!--begin::Input group-->
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-color m-0">
                        Upload Room Images
                    </h3>
                    <!--end::Title-->
                </div>
                <span id="img_error" style="color:red"></span>
            </div>
            <input type="hidden" name="id" value="{{ $roomDetails->id ?? '' }}">

            <div class="card-body p-5">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5" id="room-imgs">Select Image(s)</label>
                    </div>
                    <div class="col-sm-9">
                        <div id="imageDropzone" class="mt-4">
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                style="display: none;">
                            <div class="d-flex align-items-center gap-4">
                                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span
                                        class="path2"></span></i>
                                <div class="d-flex align-items-start flex-column">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                           
                            @if (!empty($roomDetails->images))
                                @foreach ($roomDetails->images as $key => $img)
                                  
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
        <input type="hidden" name="step" value="4">

        <input type="submit" class="d-none" id="step4">

        <!--end::Input group-->
    </form>


    <script>
        const dropzone = document.getElementById('imageDropzone');
        const fileInput = document.getElementById('images');
        const previewContainer = document.getElementById('previewContainer');
        let uploadedFiles = [];

        // Open file input when dropzone is clicked
        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        // Handle drag and drop events
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

        // Handle file input change
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

        // Function to handle file uploads and previews
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
            const index = i; // capture current index

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
                    previewDiv.classList.add('image-preview', 'd-flex','align-items-center');

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '100px';
                    img.style.border = '1px solid #ddd';

                    const removeBtn = document.createElement('button');
                    removeBtn.innerText = '✖';
                    removeBtn.classList.add('remove-btn','cancel-icon');

                       const inputField1 = createInputField('id', `imageName[${i}]`, 'Please enter image name...', ['ms-4', 'w-50']);
                       const inputField2 = createInputField('id', `altTag[${i}]`, 'Please enter alt tag...', [ 'mx-4', 'w-50']);


                    removeBtn.addEventListener('click', () => {
                        previewContainer.removeChild(previewDiv);
                        uploadedFiles.splice(index, 1); // Safe removal
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
</div>
