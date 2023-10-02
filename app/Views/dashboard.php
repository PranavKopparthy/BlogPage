<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: linear-gradient(to right, #007bff, #6c757d);
    }
    
    .card {
      border: 4px solid #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-6">
        <div class="card bg-transparent text-white text-center">
          <div class="card-body">
            <h1 class="card-title">Welcome, <?= session()->get('firstname') ?>!</h1>
            <p class="card-text">Enjoy your stay.</p>
            <a href="/users/topBlogs" class="btn btn-light">Go to Top Blogs</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
