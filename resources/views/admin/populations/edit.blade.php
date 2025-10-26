<!DOCTYPE html>
<html>
<head>
    <title>Edit Population</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Population</h2>
        <form action="{{ route('admin.populations.update', $population->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $population->name }}" required>
            </div>
            
            <div class="mb-3">
                <label>Gender</label>
                <select name="sex" class="form-control" required>
                    <option value="Male" {{ $population->sex == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $population->sex == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ $population->sex == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label>Occupation</label>
                <select name="occupation" class="form-control" required>
                    <option value="Student" {{ $population->occupation == 'Student' ? 'selected' : '' }}>Student</option>
                    <option value="Jobholder" {{ $population->occupation == 'Jobholder' ? 'selected' : '' }}>Jobholder</option>
                    <option value="Teacher" {{ $population->occupation == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="Business" {{ $population->occupation == 'Business' ? 'selected' : '' }}>Business</option>
                    <option value="Other" {{ $population->occupation == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.populations.show', $population->id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>