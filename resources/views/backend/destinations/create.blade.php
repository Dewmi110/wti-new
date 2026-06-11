<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='destinations'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Create Destination"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                            <h6 class="mb-0">Create Destination</h6>
                            <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-primary btn-sm mb-0">Back</a>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group input-group-outline mt-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="input-group input-group-outline mt-3 is-filled">
                                    <label class="form-label">Country</label>
                                    <select name="country_id" class="form-control">
                                        @foreach($countries as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <div class="image-upload-box" id="uploadBox">
                                        <svg class="upload-icon-large" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                        </svg>
                                        <p class="upload-label">Click to Upload or drag and drop</p>
                                        <p class="upload-sublabel">(Max. File size: 2 MB)</p>
                                        <input type="file" name="image" id="imageInput" class="d-none" accept="image/*">
                                    </div>
                                    <div class="image-preview-box" id="imagePreview" style="display: none;">
                                        <img id="previewImage" src="" alt="Preview" class="preview-img">
                                        <button type="button" class="btn-change-image" id="changeImage">Change Image</button>
                                    </div>
                                </div>
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                                    <label class="form-check-label" for="status">Active</label>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadBox = document.getElementById('uploadBox');
    const imageInput = document.getElementById('imageInput');
    const fileList = document.getElementById('fileList');
    const deleteFile = document.getElementById('deleteFile');
    const clickUpload = document.querySelector('.click-upload');

    // Click on upload area
    uploadBox.addEventListener('click', () => imageInput.click());
    clickUpload.addEventListener('click', (e) => {
        e.preventDefault();
        imageInput.click();
    });

    // Drag and drop
    uploadBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadBox.style.borderColor = '#0066cc';
        uploadBox.style.background = '#f0f7ff';
    });

    uploadBox.addEventListener('dragleave', () => {
        uploadBox.style.borderColor = '#d0d0d0';
        uploadBox.style.background = '#f9f9f9';
    });

    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadBox.style.borderColor = '#d0d0d0';
        uploadBox.style.background = '#f9f9f9';

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleFileSelect();
        }
    });

    // File input change
    imageInput.addEventListener('change', handleFileSelect);

    // Delete file
    deleteFile.addEventListener('click', (e) => {
        e.preventDefault();
        imageInput.value = '';
        uploadBox.style.display = 'block';
        fileList.style.display = 'none';
    });

    function handleFileSelect() {
        const file = imageInput.files[0];
        if (!file) return;

        // Show file list
        uploadBox.style.display = 'none';
        fileList.style.display = 'block';

        // Update file name and size
        const fileName = file.name;
        const fileSize = (file.size / 1024).toFixed(2) + ' KB';

        document.getElementById('fileName').textContent = fileName;
        document.getElementById('fileSize').textContent = fileSize;

        // Simulate progress
        simulateProgress();
    }

    function simulateProgress() {
        const progressFill = document.getElementById('progressFill');
        const progressText = document.getElementById('progressText');
        let progress = 0;

        const interval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress > 100) progress = 100;

            progressFill.style.width = progress + '%';
            progressText.textContent = Math.floor(progress) + '%';

            if (progress === 100) {
                clearInterval(interval);
            }
        }, 200);
    }
});
</script>
