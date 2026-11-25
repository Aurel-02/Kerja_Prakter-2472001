<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Pengelola - TK Harapan Bunda</title>

  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap 4.6.2 CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!-- Font Awesome 6 CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    html, body {
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px 16px;
      overflow-x: hidden;
    }

    /* Kartu Login dengan Spacing yang Lega & Rapi */
    .login-card {
      width: 100%;
      max-width: 430px;
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
      padding: 40px 36px;
      position: relative;
      animation: fadeInUp 0.45s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Judul Login */
    .login-title {
      font-size: 1.85rem;
      font-weight: 700;
      color: #1e293b;
      text-align: center;
      margin-bottom: 30px;
      letter-spacing: -0.3px;
    }

    /* Label Form */
    .form-group label {
      font-size: 0.88rem;
      font-weight: 600;
      color: #334155;
      margin-bottom: 9px;
      display: block;
    }

    /* Input Field Custom */
    .input-group-custom {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon-left {
      position: absolute;
      left: 15px;
      color: #94a3b8;
      font-size: 15px;
      pointer-events: none;
      z-index: 5;
      transition: color 0.2s;
    }

    .form-control-custom {
      width: 100%;
      height: 50px;
      padding: 10px 44px 10px 44px;
      font-size: 0.94rem;
      color: #1e293b;
      background-color: #f8fafc;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      transition: all 0.2s ease;
    }

    .form-control-custom:focus {
      background-color: #ffffff;
      border-color: #16a34a;
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.14);
      outline: none;
    }

    .form-control-custom:focus ~ .input-icon-left {
      color: #16a34a;
    }

    /* Eye toggle password */
    .toggle-password-btn {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      color: #94a3b8;
      font-size: 15px;
      cursor: pointer;
      padding: 6px;
      border-radius: 6px;
      transition: color 0.2s;
      z-index: 5;
    }

    .toggle-password-btn:hover {
      color: #16a34a;
    }

    /* Lupa Password Link */
    .forgot-password-link {
      font-size: 0.84rem;
      color: #64748b;
      font-weight: 500;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .forgot-password-link:hover {
      color: #15803d;
      text-decoration: underline;
    }

    /* Tombol Submit (Menyamai Warna Tema Portal #16a34a) */
    .btn-login {
      width: 100%;
      height: 48px;
      background: #16a34a;
      color: #ffffff;
      border: none;
      border-radius: 10px;
      font-size: 0.96rem;
      font-weight: 600;
      letter-spacing: 0.2px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: background 0.15s ease, transform 0.15s ease;
      margin-top: 4px;
    }

    .btn-login:hover {
      background: #15803d;
      color: #ffffff;
      text-decoration: none;
    }

    .btn-login:active {
      transform: scale(0.99);
    }

    /* Kembali ke Beranda */
    .back-home-wrap {
      text-align: center;
      margin-top: 26px;
      padding-top: 22px;
      border-top: 1px solid #f1f5f9;
    }

    .back-home-link {
      color: #64748b;
      font-size: 0.86rem;
      font-weight: 500;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      transition: color 0.2s;
    }

    .back-home-link:hover {
      color: #16a34a;
      text-decoration: none;
    }

    /* Alert */
    .alert-custom {
      border-radius: 10px;
      font-size: 0.84rem;
      padding: 10px 14px;
      margin-bottom: 22px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
  </style>
</head>
<body>

  <!-- Login Card -->
  <div class="login-card">

    <!-- Header Judul -->
    <div class="text-center" style="margin-bottom: 26px;">
      <h1 class="login-title" style="margin-bottom: 6px;">Login</h1>
      <p style="font-size: 0.85rem; color: #64748b; margin: 0;">Masuk ke Portal TK Harapan Bunda</p>
    </div>

    <!-- Alert Notifikasi Flash -->
    @if(session('success'))
      <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 6px 10px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 6px 10px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>{{ $errors->first() }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 6px 10px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <!-- Form Login -->
    <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
      @csrf

      <!-- Field Username -->
      <div class="form-group mb-4">
        <label for="username">Username</label>
        <div class="input-group-custom">
          <i class="fa-solid fa-user input-icon-left"></i>
          <input 
            type="text" 
            class="form-control-custom @error('username') is-invalid @enderror" 
            id="username" 
            name="username" 
            value="{{ old('username') }}" 
            placeholder="Masukkan username" 
            required 
            autofocus
          >
        </div>
      </div>

      <!-- Field Password -->
      <div class="form-group mb-2">
        <label for="password">Password</label>
        <div class="input-group-custom">
          <i class="fa-solid fa-lock input-icon-left"></i>
          <input 
            type="password" 
            class="form-control-custom @error('password') is-invalid @enderror" 
            id="password" 
            name="password" 
            placeholder="Masukkan password" 
            required
          >
          <button type="button" class="toggle-password-btn" id="togglePasswordBtn" title="Lihat password" tabindex="-1">
            <i class="fa-solid fa-eye" id="passwordEyeIcon"></i>
          </button>
        </div>
      </div>

      <!-- Tulisan Lupa Password Tepat di Bawah Kotak Password -->
      <div class="d-flex justify-content-end mb-4 mt-2">
        <a href="#" class="forgot-password-link" onclick="alert('Silakan hubungi administrator sekolah untuk mereset password akun Anda.'); return false;">
          Lupa password?
        </a>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-login mb-2">
        <i class="fa-solid fa-arrow-right-to-bracket"></i>
        <span>Login</span>
      </button>
    </form>

    <!-- Kembali ke Halaman Utama -->
    <div class="back-home-wrap">
      <a href="{{ route('home') }}" class="back-home-link">
        <i class="fa-solid fa-house"></i>
        <span>Kembali ke Website Utama</span>
      </a>
    </div>

  </div>

  <!-- jQuery & Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script Show / Hide Password -->
  <script>
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('passwordEyeIcon');

    if (toggleBtn && passwordInput && eyeIcon) {
      toggleBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.remove('fa-eye');
          eyeIcon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('fa-eye-slash');
          eyeIcon.classList.add('fa-eye');
        }
      });
    }
  </script>
</body>
</html>
