<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Population Profile</title>
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

        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #218838;
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

        .cancel {
            text-align: center;
            margin-top: 15px;
        }
        .cancel a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Population Profile</h2>

        <form action="{{ route('population.update', $population->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(event)">
            
            <div class="preview" id="previewContainer">
                @if($population->profile_picture)
                    <img src="{{ asset('storage/'.$population->profile_picture) }}" alt="Profile">
                @else
                    <img src="https://via.placeholder.com/120" alt="Profile">
                @endif
            </div>

            <label>Name:</label>
            <input type="text" name="name" value="{{ $population->name }}" required>

            <label>Sex:</label>
            <select name="sex" required>
                <option value="Male" {{ $population->sex == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $population->sex == 'Female' ? 'selected' : '' }}>Female</option>
            </select>

            <label>Occupation:</label>
            <input type="text" name="occupation" value="{{ $population->occupation }}" required>

            <label>College/University:</label>
            <input type="text" name="college_university" value="{{ $population->college_university }}">

            <label>Subject/Department:</label>
            <input type="text" name="subject_department" value="{{ $population->subject_department }}">

            <label>Blood Group:</label>
            <input type="text" name="blood_group" value="{{ $population->blood_group }}">

            <label>Phone:</label>
            <input type="text" name="phone" value="{{ $population->phone }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ $population->email }}" required>

            <label>District:</label>
            <input type="text" name="district" value="{{ $population->district }}" required>

            <label>Upazila:</label>
            <input type="text" name="upazila" value="{{ $population->upazila }}" required>

            <button type="submit">Update Profile</button>
        </form>

        <div class="cancel">
            <a href="{{ route('population.index') }}">Cancel</a>
        </div>
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
