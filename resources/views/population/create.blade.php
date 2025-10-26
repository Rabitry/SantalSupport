<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile - Santal Community</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4ff, #e4f0eb);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #004080;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #f5c6cb;
        }

        .info-message {
            background: #cce7ff;
            color: #004085;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #b3d7ff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        .required::after {
            content: " *";
            color: #dc3545;
        }

        input[type="text"],
        input[type="email"],
        select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            font-size: 15px;
            transition: all 0.3s;
        }

        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0px 0px 6px rgba(0, 123, 255, 0.3);
            transform: translateY(-1px);
        }

        input[type="file"] {
            padding: 8px;
            border: 1px dashed #007bff;
            border-radius: 8px;
            background: #f8f9fa;
            width: 100%;
        }

        .file-info {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        button {
            margin-top: 10px;
            padding: 14px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 123, 255, 0.3);
        }

        button:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
        }

        .preview-section {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
        }

        .preview {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .preview img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }

        .preview img:hover {
            transform: scale(1.05);
        }

        .default-avatar-text {
            font-size: 12px;
            color: #666;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-cancel {
            flex: 1;
            padding: 14px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #545b62;
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            .container {
                padding: 20px;
            }
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
            font-style: italic;
        }

        .welcome-note {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>👤 Create New Profile</h2>

        <div class="welcome-note">
            Welcome to Santal Community! Create your profile to connect with other community members.
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="error-message">
                ❌ {{ session('error') }}
            </div>
        @endif

        <!-- Info Message -->
        @if(session('info'))
            <div class="info-message">
                ℹ️ {{ session('info') }}
            </div>
        @endif

        <form action="{{ route('population.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Picture Section -->
            <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(event)">
                <div class="file-info">Supported formats: JPG, PNG, JPEG, GIF, WEBP | Max size: 2MB</div>
                @error('profile_picture') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="preview-section">
                <div class="preview">
                    <img id="profilePreview" src="https://ui-avatars.com/api/?name=New+User&background=007bff&color=fff&size=140" alt="Profile Preview">
                </div>
                <div class="default-avatar-text">Upload a photo or use default avatar</div>
            </div>

            <!-- Personal Information -->
            <div class="form-group">
                <label class="required">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter your full name">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required">Gender</label>
                    <select name="sex" required>
                        <option value="" disabled {{ old('sex') ? '' : 'selected' }}>Select Gender</option>
                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('sex') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('sex') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required">Occupation</label>
                    <select name="occupation" required>
                        <option value="" disabled {{ old('occupation') ? '' : 'selected' }}>Select Occupation</option>
                        <option value="Student" {{ old('occupation') == 'Student' ? 'selected' : '' }}>Student</option>
                        <option value="Jobholder" {{ old('occupation') == 'Jobholder' ? 'selected' : '' }}>Jobholder</option>
                        <option value="Teacher" {{ old('occupation') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="Business" {{ old('occupation') == 'Business' ? 'selected' : '' }}>Business</option>
                        <option value="Other" {{ old('occupation') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('occupation') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Education Information -->
            <div class="form-group">
                <label>College/University</label>
                <input type="text" name="college_university" value="{{ old('college_university') }}" placeholder="e.g., University of Dhaka">
                @error('college_university') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Subject/Department</label>
                <input type="text" name="subject_department" value="{{ old('subject_department') }}" placeholder="e.g., Computer Science & Engineering">
                @error('subject_department') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Contact Information -->
            <div class="form-row">
                <div class="form-group">
                    <label class="required">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g., 01712345678">
                    <div class="help-text">Bangladeshi format: 01XXXXXXXXX</div>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Blood Group -->
            <div class="form-group">
                <label>Blood Group</label>
                <select name="blood_group">
                    <option value="" {{ old('blood_group') == '' ? 'selected' : '' }}>Select Blood Group</option>
                    <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                    <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                    <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                    <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                    <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                    <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                    <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                    <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                </select>
                @error('blood_group') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Location Information -->
            <div class="form-row">
                <div class="form-group">
                    <label class="required">Division</label>
                    <input type="text" name="division" value="{{ old('division') }}" required placeholder="e.g., Dhaka">
                    @error('division') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required">District</label>
                    <input type="text" name="district" value="{{ old('district') }}" required placeholder="e.g., Dhaka">
                    @error('district') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required">Upazila</label>
                    <input type="text" name="upazila" value="{{ old('upazila') }}" required placeholder="e.g., Savar">
                    @error('upazila') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="required">Current Address</label>
                <input type="text" name="current_address" value="{{ old('current_address') }}" required placeholder="Full current address">
                @error('current_address') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Terms Agreement -->
            <div class="form-group" style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 20px;">
                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="terms" required style="margin-top: 3px;">
                    <span>
                        I agree to share my information with the Santal Community for networking and support purposes. 
                        I understand that my phone and email will be visible to other community members.
                    </span>
                </label>
                @error('terms') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('population.index') }}" class="btn-cancel">← Cancel</a>
                <button type="submit">💾 Create Profile</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const img = document.getElementById('profilePreview');
            const file = event.target.files[0];
            
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    event.target.value = '';
                    return;
                }
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG, GIF, WEBP)');
                    event.target.value = '';
                    return;
                }
                
                img.src = URL.createObjectURL(file);
                img.style.borderColor = '#28a745'; // Green border for valid image
            }
        }

        // Dynamic avatar generation based on name input
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.querySelector('input[name="name"]');
            const avatarImg = document.getElementById('profilePreview');
            
            nameInput.addEventListener('input', function() {
                if (this.value.trim() && !document.querySelector('input[name="profile_picture"]').files[0]) {
                    const name = this.value.trim().replace(/\s+/g, '+');
                    avatarImg.src = `https://ui-avatars.com/api/?name=${name}&background=007bff&color=fff&size=140`;
                }
            });

            // Form validation enhancement
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (field.type === 'checkbox') {
                        if (!field.checked) {
                            valid = false;
                            field.parentElement.style.border = '1px solid #dc3545';
                        } else {
                            field.parentElement.style.border = '1px solid #28a745';
                        }
                    } else if (!field.value.trim()) {
                        valid = false;
                        field.style.borderColor = '#dc3545';
                    } else {
                        field.style.borderColor = '#28a745';
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    alert('Please fill in all required fields and agree to the terms.');
                }
            });
        });
    </script>
</body>
</html>