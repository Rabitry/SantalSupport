<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Population Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
        }

        .container {
            background: #fff;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        select {
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0px 0px 6px rgba(0, 123, 255, 0.3);
        }

        input[type="file"] {
            margin-top: 5px;
            font-size: 14px;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 3px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .preview {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .preview img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Population Profile</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('population.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(event)">
            @error('profile_picture') <p class="error">{{ $message }}</p> @enderror
            <div class="preview" id="previewContainer"></div>

            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <label>Sex:</label>
            <select name="sex" required>
                <option value="">Select Sex</option>
                <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('sex') <p class="error">{{ $message }}</p> @enderror

            <label>Occupation:</label>
            <input type="text" name="occupation" value="{{ old('occupation') }}" required>
            @error('occupation') <p class="error">{{ $message }}</p> @enderror

            <label>College/University:</label>
            <input type="text" name="college_university" value="{{ old('college_university') }}">
            @error('college_university') <p class="error">{{ $message }}</p> @enderror

            <label>Subject/Department:</label>
            <input type="text" name="subject_department" value="{{ old('subject_department') }}">
            @error('subject_department') <p class="error">{{ $message }}</p> @enderror

            <label>Blood Group:</label>
            <input type="text" name="blood_group" value="{{ old('blood_group') }}" placeholder="e.g. A+, B+, O-, AB+">
            @error('blood_group') <p class="error">{{ $message }}</p> @enderror

            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g. 01712345678">
            @error('phone') <p class="error">{{ $message }}</p> @enderror

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com">
            @error('email') <p class="error">{{ $message }}</p> @enderror

            <label>District:</label>
            <input type="text" name="district" value="{{ old('district') }}" required>
            @error('district') <p class="error">{{ $message }}</p> @enderror

            <label>Upazila:</label>
            <input type="text" name="upazila" value="{{ old('upazila') }}" required>
            @error('upazila') <p class="error">{{ $message }}</p> @enderror

            <button type="submit">Save Profile</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('previewContainer');
            preview.innerHTML = '';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[0]);
            preview.appendChild(img);
        }
    </script>
</body>
</html>
