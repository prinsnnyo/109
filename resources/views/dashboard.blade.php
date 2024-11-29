<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="shadow card">
            <div class="text-white card-header bg-primary">
                <h3>Dashboard</h3>
            </div>
            <div class="card-body">
        <img src="{{ Auth::user()->avatar }}" alt="" class="mb-3 img-thumbnail" style="width: 150px; height: 150px;">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> {{ Auth::user()->name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    <li class="list-group-item"><strong>Google ID:</strong> {{ Auth::user()->id }}</li>
                  
                </ul>
            </div>
            <div class="text-center card-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div> 
        </div>
    </div>
</body>
</html>
