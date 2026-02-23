<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Profile Settings - SIYENRO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #000;
            background-color: #f8f9fa;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        .profile-header {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
        }

        .profile-header h1 {
            color: white;
            margin-bottom: 0.5rem;
        }

        .profile-header p {
            color: rgba(255,255,255,0.8);
        }

        .profile-card {
            background: white;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            padding: 2rem;
        }

        .profile-card h3 {
            color: #000;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            border-bottom: 2px solid #000;
            padding-bottom: 1rem;
        }

        .profile-card .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .profile-card .form-control,
        .profile-card .form-control:focus {
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
        }

        .profile-card .form-control:focus {
            border-color: #000;
            box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.1);
        }

        .btn-save {
            background-color: #000;
            color: white;
            border: none;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background-color: #333;
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background-color: #dc3545;
            color: white;
            border: none;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .btn-danger-custom:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-2px);
        }

        .alert-success, .alert-danger {
            border: none;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }

        .success-message {
            color: #28a745;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .divider {
            border-top: 1px solid #eee;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <!-- Profile Header -->
    <section class="profile-header">
        <div class="container">
            <h1><i class="bi bi-person-circle"></i> Profile Settings</h1>
            <p>Manage your account information and security</p>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Update Profile Information -->
                    <div class="profile-card">
                        <h3><i class="bi bi-person"></i> Profile Information</h3>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Update Password -->
                    <div class="profile-card">
                        <h3><i class="bi bi-lock"></i> Change Password</h3>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Delete Account -->
                    <div class="profile-card border-danger" style="border-left: 4px solid #dc3545 !important;">
                        <h3 style="color: #dc3545;"><i class="bi bi-exclamation-triangle"></i> Delete Account</h3>
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 SIYENRO. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide success messages after 3 seconds
        document.querySelectorAll('.success-message').forEach(msg => {
            setTimeout(() => {
                msg.style.display = 'none';
            }, 3000);
        });
    </script>
</body>
</html>
