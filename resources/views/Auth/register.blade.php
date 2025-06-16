<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-k6Phl7FNC2kNqKz3C3lEf+6gCwFOfG5rqUXMJ6lXfWB5hP3UszREzBQQTw+RRp50e0Rk0S7kZCkXglN1NW9Cyg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-color: #f1f4f9;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .form-icon {
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card p-4">
        <h3 class="text-center mb-4">Buat Akun</h3>
        @if ($errors->any())
            <div style="color: red">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif
        <form action="{{ route('register.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-user form-icon"></i></span>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter your full name">
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-envelope form-icon"></i></span>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Enter your email">
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-lock form-icon"></i></span>
              <input type="password" name="password" class="form-control" id="password" placeholder="Create a password">
            </div>
          </div>

          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success">Register</button>
          </div>

          <div class="text-center">
            <p>Already have an account? <a href="{{ url('login') }}" class="text-decoration-none">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
