<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Setings</title>
</head>
<body>
      @if ($errors->any())
            <div style="color: red">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif
  <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  Nama toko
  <input type="text" name="nama_toko" value="{{ $setting->nama_toko }}"><br>
  Alamat
  <input type="text" name="alamat" value="{{ $setting->alamat }}"><br>
  Telepon 
  <input type="text" name="telepon" value="{{ $setting->telepon }}"><br>
  Email
  <input type="email" name="email" value="{{ $setting->email }}"><br>
  Logo
  <input type="file" name="logo"><br>
  <button type="submit">Kirim</button>
</form>
</body>
</html>