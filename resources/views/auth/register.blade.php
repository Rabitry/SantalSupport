<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Santal Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .file-upload {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        .file-upload:hover {
            border-color: #3b82f6;
        }
        .file-upload.dragover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
        .preview-image {
            max-width: 200px;
            max-height: 150px;
            border-radius: 0.375rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Join Santal Community
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Create your account (Admin approval required)
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Personal Information -->
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                            <input id="name" name="name" type="text" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('name') }}" placeholder="Enter your full name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address *</label>
                            <input id="email" name="email" type="email" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('email') }}" placeholder="example@gmail.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ID Verification -->
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">ID Verification</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Student ID -->
                        <div>
                            <label for="student_id" class="block text-sm font-medium text-gray-700">
                                Student ID (if applicable)
                            </label>
                            <input id="student_id" name="student_id" type="text"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('student_id') }}" placeholder="e.g., 202412345">
                            @error('student_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- National ID -->
                        <div>
                            <label for="national_id" class="block text-sm font-medium text-gray-700">
                                National ID / Birth Certificate No *
                            </label>
                            <input id="national_id" name="national_id" type="text" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('national_id') }}" placeholder="Enter NID or Birth Certificate">
                            @error('national_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- ID Card Images -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ID Card Front -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                ID Card Front Photo *
                            </label>
                            <div class="file-upload" id="frontUploadArea">
                                <input type="file" id="id_card_front" name="id_card_front" 
                                       accept="image/*" class="hidden" required>
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <button type="button" onclick="document.getElementById('id_card_front').click()" 
                                                class="font-medium text-blue-600 hover:text-blue-500">
                                            Upload front side
                                        </button>
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                                </div>
                                <img id="frontPreview" class="preview-image hidden mx-auto">
                            </div>
                            @error('id_card_front')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ID Card Back -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                ID Card Back Photo *
                            </label>
                            <div class="file-upload" id="backUploadArea">
                                <input type="file" id="id_card_back" name="id_card_back" 
                                       accept="image/*" class="hidden" required>
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <button type="button" onclick="document.getElementById('id_card_back').click()" 
                                                class="font-medium text-blue-600 hover:text-blue-500">
                                            Upload back side
                                        </button>
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                                </div>
                                <img id="backPreview" class="preview-image hidden mx-auto">
                            </div>
                            @error('id_card_back')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Account Security</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password *</label>
                            <input id="password" name="password" type="password" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Minimum 8 characters">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password *
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Confirm your password">
                        </div>
                    </div>
                </div>

                <!-- Terms and Community Guidelines -->
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                    <div class="flex items-start">
                        <input id="terms" name="terms" type="checkbox" required
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                        <label for="terms" class="ml-3 block text-sm text-gray-900">
                            I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a>
                            and <a href="#" class="text-blue-600 hover:text-blue-500">Community Guidelines</a>. 
                            I understand that my registration requires admin approval and verification of my ID documents.
                        </label>
                    </div>
                    @error('terms')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Security Notice -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                Verification Required
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>• Your ID documents will be verified by admin</p>
                                <p>• Account activation may take 24-48 hours</p>
                                <p>• You'll be notified via email once approved</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        Submit for Verification
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Already have an account? Sign in
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File upload preview functionality
        function setupFileUpload(inputId, previewId, uploadAreaId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const uploadArea = document.getElementById(uploadAreaId);

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.classList.add('dragover');
            }

            function unhighlight() {
                uploadArea.classList.remove('dragover');
            }

            uploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                input.files = files;
                
                const file = files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            }
        }

        // Initialize file uploads
        setupFileUpload('id_card_front', 'frontPreview', 'frontUploadArea');
        setupFileUpload('id_card_back', 'backPreview', 'backUploadArea');

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const frontFile = document.getElementById('id_card_front').files[0];
            const backFile = document.getElementById('id_card_back').files[0];
            
            if (frontFile && frontFile.size > 2 * 1024 * 1024) {
                e.preventDefault();
                alert('Front image must be less than 2MB');
                return;
            }
            
            if (backFile && backFile.size > 2 * 1024 * 1024) {
                e.preventDefault();
                alert('Back image must be less than 2MB');
                return;
            }
        });
    </script>
</body>
</html>