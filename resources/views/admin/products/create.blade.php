@extends('admin.app')

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">
                <h4>Tambah Produk</h4>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger shadow mb-4">
                        <h6 class="font-weight-bold">Gagal Menyimpan Data:</h6>
                        <ul class="mb-0 nesting-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/admin/product" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" rows="4" class="form-control"
                            required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Top Notes</label>
                            <input type="text" name="top_notes" class="form-control" value="{{ old('top_notes') }}"
                                placeholder="Bergamot, Pear">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Notes</label>
                            <input type="text" name="middle_notes" class="form-control" value="{{ old('middle_notes') }}"
                                placeholder="Jasmine, Orange Blossom">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Base Notes</label>
                            <input type="text" name="base_notes" class="form-control" value="{{ old('base_notes') }}"
                                placeholder="Vanilla, Patchouli">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Gender</label>

                            <select name="gender" class="form-select">

                                <option value="">-- Pilih Gender --</option>

                                <option value="Man" {{ old('gender') == 'Man' ? 'selected' : ''}}>Man</option>

                                <option value="Women" {{ old('gender') == 'Women' ? 'selected' : ''}}>Women</option>

                                <option value="Unisex" {{ old('gender') == 'Unisex' ? 'selected' : ''}}>Unisex</option>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Harga</label>

                            <input type="number" name="price" class="form-control" value="{{ old('price') }}"
                                placeholder="250000">

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Shopee Link</label>
                            <input type="url" name="shopee_link" class="form-control"
                                value="{{ old('shopee_link', $product->shopee_link ?? '') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Tokopedia Link</label>
                            <input type="url" name="tokopedia_link" class="form-control"
                                value="{{ old('tokopedia_link', $product->tokopedia_link ?? '') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>TikTok Shop Link</label>
                            <input type="url" name="tiktokshop_link" class="form-control"
                                value="{{ old('tiktokshop_link', $product->tiktokshop_link ?? '') }}">
                        </div>
                    </div>
                    <div class="row mb-4">

                        {{-- Gambar Utama --}}
                        <div class="col-md-6">

                            <label class="form-label">Gambar Cover Produk</label>

                            <input type="file" id="main-image" name="image" class="form-control mb-3" accept="image/*">

                            <img id="preview-image" src="https://placehold.co/600x300?text=Preview+Gambar"
                                class="img-fluid rounded border" style="height:250px;width:100%;object-fit:contain;">

                        </div>

                        {{-- Gallery --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Gambar Galeri
                            </label>

                            <input type="file" id="gallery-images" name="images[]" class="form-control" multiple
                                accept="image/*">

                            <div class="mt-2">
                                <span class="badge bg-primary" id="image-count">
                                    0 gambar dipilih
                                </span>
                            </div>

                            <div class="row mt-3" id="gallery-preview"></div>

                        </div>

                    </div>

                    {{-- Preview gambar --}}

                    <a href="{{ url('/admin/product') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        Simpan Produk
                    </button>
                </form>

            </div>

        </div>

    </div>

    <script>

        const galleryInput = document.getElementById('gallery-images');
        const preview = document.getElementById('gallery-preview');
        const imageCount = document.getElementById('image-count');

        let selectedFiles = [];

        // =========================
        // PREVIEW GAMBAR UTAMA
        // =========================

        document.getElementById('main-image').addEventListener('change', function (e) {

            const file = e.target.files[0];

            if (file) {

                document.getElementById('preview-image').src =
                    URL.createObjectURL(file);

            }

        });


        // =========================
        // TAMBAH GAMBAR GALERI
        // =========================

        galleryInput.addEventListener('change', function (e) {

            const newFiles = Array.from(e.target.files);

            // Tambahkan file baru ke file yang sudah dipilih
            selectedFiles = [...selectedFiles, ...newFiles];

            renderGallery();

        });


        // =========================
        // RENDER PREVIEW
        // =========================

        function renderGallery() {

            preview.innerHTML = "";

            imageCount.innerHTML =
                selectedFiles.length + " gambar dipilih";


            const dataTransfer = new DataTransfer();


            selectedFiles.forEach((file, index) => {

                // Masukkan file ke DataTransfer
                dataTransfer.items.add(file);


                const col = document.createElement("div");

                col.className = "col-md-4 col-6 mb-3";


                col.innerHTML = `
                    <div class="preview-card">

                        <button
                            type="button"
                            class="remove-image"
                            data-index="${index}">
                            ✕
                        </button>

                        <img
                            src="${URL.createObjectURL(file)}"
                            alt="Preview">

                    </div>
                `;


                preview.appendChild(col);

            });


            // Masukkan semua file ke input
            galleryInput.files = dataTransfer.files;


            // =========================
            // TOMBOL HAPUS
            // =========================

            document.querySelectorAll(".remove-image").forEach(btn => {

                btn.addEventListener("click", function () {

                    const index = parseInt(this.dataset.index);

                    selectedFiles.splice(index, 1);

                    renderGallery();

                });

            });

        }

    </script>

    <style>
        .preview-card {

            position: relative;

        }

        .preview-card img {

            width: 100%;
            height: 170px;

            object-fit: contain;

            border-radius: 10px;

            border: 1px solid #ddd;

        }

        .remove-image {

            position: absolute;

            top: 8px;

            right: 15px;

            width: 28px;

            height: 28px;

            border: none;

            border-radius: 50%;

            background: #dc3545;

            color: white;

            font-weight: bold;

            cursor: pointer;

        }

        .remove-image:hover {

            background: #bb2d3b;

        }
    </style>
@endsection