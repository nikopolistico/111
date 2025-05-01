<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Meal Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/background/e.webp');
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
            /* White with 80% opacity for semi-transparency */
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .alert {
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="card p-4">
            <div class="card-header">
                <h4>Create a New Meal Plan</h4>
            </div>
            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <!-- Meal Plan Upload Form -->
                <form action="{{ route('mealPlans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Meal Plan Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Meal Plan Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>

                    <!-- Meal Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Meal Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Create Meal Plan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>