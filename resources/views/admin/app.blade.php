<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin ArraShine - Reveal Your Everyday Scent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/navbar/bulat.png') }}" sizes="512x512">

    <style>
        body {
            overflow-x: hidden;
            background: #f5f6fa;
        }

        /* Navbar */
        .navbar {
            height: 60px;
            z-index: 1050;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100vh - 60px);
            background: #212529;
            transition: .3s;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
            white-space: nowrap;
        }

        .sidebar .nav-link:hover {
            background: #343a40;
            color: #fff;
        }

        .sidebar .nav-link i {
            width: 25px;
        }

        .sidebar.collapsed .menu-text {
            display: none;
        }

        /* Content */
        .content {
            margin-left: 250px;
            margin-top: 0px;
            padding: 25px;
            transition: .3s;
            min-height: calc(100vh - 60px);
        }

        .content.expanded {
            margin-left: 70px;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark sticky-top">

        <div class="container-fluid">

            <button class="btn btn-outline-light border-0" id="toggleSidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <span class="navbar-brand mb-0 h1">
                Arrashine Admin
            </span>

        </div>

    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">

        <ul class="nav flex-column mt-3">

            <li class="nav-item">
                <a href="/admin/product" class="nav-link">
                    <i class="fa-solid fa-spray-can-sparkles"></i>
                    <span class="menu-text">Produk</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/article" class="nav-link">
                    <i class="fa-solid fa-blog"></i>
                    <span class="menu-text">Artikel</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/profile" class="nav-link">
                    <i class="fa-solid fa-key"></i>
                    <span class="menu-text">Ganti Password</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/review" class="nav-link">
                    <i class="fa-solid fa-star"></i>
                    <span class="menu-text">Reviews</span>
                </a>
            </li>

            <li class="nav-item">
                <form action="{{ url('/admin/logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="nav-link logout-btn">
                        <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                        <span class="menu-text text-danger">Logout</span>
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- Content -->
    <div class="content" id="content">

        @yield('content')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        document.getElementById('toggleSidebar').addEventListener('click', function () {

            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');

        });

    </script>
    @stack('scripts')
</body>

</html>