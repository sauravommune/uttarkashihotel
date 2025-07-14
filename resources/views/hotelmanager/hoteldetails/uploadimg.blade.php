<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Upload Pictures</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1" >edit</span>Edit
        </button>
    </div>
    <div class="row mb-5">
        <div class="col-sm-3">
            <h4 class="fw-semibold mb-2 mt-5" id="room-imgs">Select Image(s)</h4>

        </div>
        <div class="col-sm-9">
            <div id="imageDropzone" class="mt-4">
                <input type="file" name="hotel_images[]" id="images" multiple accept="image/*"
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
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div id="previewContainer" style="margin-top: 20px;"></div>
                @if (!empty($hotel->images))
                @foreach ($hotel->images as $img)
                <div style="display: inline-block; position: relative; margin-right: 10px;">
                    <img src="{{ asset('storage/'.$img->image) }}" width="100px" height="80px" />

                    <button type="button" onclick="deleteImage({{ $img->id }})"
                        style="position: absolute; top: 0; right: 0; background: none; border: none; cursor: pointer;">
                        <i class="text-danger fs-6">✖</i>
                    </button>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
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

        for (const file of files) {
            if (file.type.startsWith('image/')) {
                uploadedFiles.push(file);
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
                    removeBtn.classList.add('remove-btn');

                    // Remove image on button click
                    removeBtn.addEventListener('click', () => {
                        previewContainer.removeChild(previewDiv);
                        uploadedFiles = uploadedFiles.filter(f => f.name !== file
                            .name); // Remove from the array
                    });

                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer.appendChild(previewDiv);
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
<script>
    // Function to load checkbox states from localStorage
    function loadCheckboxStates() {
        let checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function(checkbox) {
            let checkboxState = localStorage.getItem(checkbox.id);
            if (checkboxState === 'true') {
                checkbox.checked = true;
            } else if (checkboxState === 'false') {
                checkbox.checked = false;
            }
        });
    }

    // Call the function to load saved checkbox states when the page loads
    window.onload = function() {
        loadCheckboxStates();
    }

    // Toggle enable/disable and show/hide the Save button
    document.getElementById('disabled-btn').addEventListener('click', function() {
        // Get all checkboxes
        let checkboxes = document.querySelectorAll('.form-check-input');

        // Loop through checkboxes and toggle the disabled attribute
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = !checkbox.disabled;
        });

        // Toggle the Save Amenities button visibility
        let saveBtn = document.getElementById('save_aminites_btn');
        saveBtn.classList.toggle('d-none');
    });

    // Disable checkboxes when save button is clicked, save states to localStorage, and hide the save button
    document.getElementById('save_aminites_btn').addEventListener('click', function() {
        // Get all checkboxes
        let checkboxes = document.querySelectorAll('.form-check-input');

        // Loop through checkboxes, set them to disabled, and save their states in localStorage
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = true;
            localStorage.setItem(checkbox.id, checkbox.checked);
        });

        // Hide the Save Amenities button again
        let saveBtn = document.getElementById('save_aminites_btn');
        saveBtn.classList.add('d-none');
    });
</script>
