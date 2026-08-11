@extends('admin.app')

@section('content')

    <div class="card">

        <div class="card-header">
            <h4>Edit Produk</h4>
        </div>

        <div class="card-body">
            <form action="/admin/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>

                    <textarea name="description" class="form-control"
                        rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <label>Top Notes</label>

                        <input type="text" name="top_notes" class="form-control"
                            value="{{ old('top_notes', $product->top_notes) }}">

                    </div>

                    <div class="col-md-4">

                        <label>Middle Notes</label>

                        <input type="text" name="middle_notes" class="form-control"
                            value="{{ old('middle_notes', $product->middle_notes) }}">

                    </div>

                    <div class="col-md-4">

                        <label>Base Notes</label>

                        <input type="text" name="base_notes" class="form-control"
                            value="{{ old('base_notes', $product->base_notes) }}">

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-6">

                        <label>Gender</label>

                        <select name="gender" class="form-select">

                            <option value="Man" {{ $product->gender == 'Man' ? 'selected' : '' }}>
                                Man
                            </option>

                            <option value="Women" {{ $product->gender == 'Women' ? 'selected' : '' }}>
                                Women
                            </option>

                            <option value="Unisex" {{ $product->gender == 'Unisex' ? 'selected' : '' }}>
                                Unisex
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label>Harga</label>

                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">

                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label>Shopee Link</label>
                        <input type="url" name="shopee_link" class="form-control"
                            value="{{ old('shopee_link', $product->shopee_link) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Tokopedia Link</label>
                        <input type="url" name="tokopedia_link" class="form-control"
                            value="{{ old('tokopedia_link', $product->tokopedia_link) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>TikTok Shop Link</label>
                        <input type="url" name="tiktokshop_link" class="form-control"
                            value="{{ old('tiktokshop_link', $product->tiktokshop_link) }}">
                    </div>
                </div>

                <div class="row mb-4">

                    {{-- Gambar Utama --}}
                    <div class="col-md-6">

                        <label>Gambar Lama</label><br>

                        <img src="{{ asset('storage/' . $product->image) }}" width="150" class="mb-2">

                        <input type="file" name="image" class="form-control" accept="image/*">

                    </div>

                    {{-- Gallery --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Gambar Galeri
                        </label>

                        {{-- Gambar galeri lama --}}
                        <div class="row g-2 mb-3">

                            @forelse($product->images as $image)

                                <div class="col-md-4" id="gallery-image-{{ $image->id }}">

                                    <div class="gallery-card">

                                        <img src="{{ asset('storage/' . $image->image) }}" class="gallery-image">

                                        <button type="button" class="remove-old-image" data-id="{{ $image->id }}">
                                            ✕
                                        </button>

                                    </div>

                                </div>

                            @empty

                                <div class="col-12">
                                    <div class="alert alert-secondary">
                                        Belum ada gambar galeri.
                                    </div>
                                </div>

                            @endforelse

                        </div>


                        {{-- Upload gambar baru --}}
                        <input type="file" id="gallery-images" name="images[]" class="form-control" multiple
                            accept="image/*">

                        <div class="mt-2">

                            <span class="badge bg-primary" id="image-count">
                                0 gambar baru dipilih
                            </span>

                        </div>


                        {{-- Preview gambar baru --}}
                        <div class="row mt-3" id="gallery-preview">
                        </div>

                    </div>

                </div>

                <div class="mt-4">

                    <button class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ url('/admin/product') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

    <style>
        .gallery-card {
            position: relative;
            width: 100%;
        }

        .gallery-image {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .remove-old-image,
        .remove-new-image {
            position: absolute;
            top: 5px;
            right: 5px;

            width: 28px;
            height: 28px;

            border: none;
            border-radius: 50%;

            background: #dc3545;
            color: white;

            font-weight: bold;
            cursor: pointer;

            z-index: 2;
        }

        .remove-old-image:hover,
        .remove-new-image:hover {
            background: #bb2d3b;
        }

        .new-gallery-card {
            position: relative;
        }

        .new-gallery-card img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    </style>

    <script>

        const galleryInput = document.getElementById('gallery-images');

        const galleryPreview = document.getElementById('gallery-preview');

        const imageCount = document.getElementById('image-count');

        let selectedFiles = [];


        // =====================================
        // PILIH GAMBAR BARU
        // =====================================

        galleryInput.addEventListener('change', function (event) {

            const newFiles = Array.from(event.target.files);

            // Tambahkan file baru ke file sebelumnya
            selectedFiles = [
                ...selectedFiles,
                ...newFiles
            ];

            renderNewGallery();

        });


        // =====================================
        // RENDER PREVIEW GAMBAR BARU
        // =====================================

        function renderNewGallery() {

            galleryPreview.innerHTML = "";

            imageCount.innerHTML =
                selectedFiles.length + " gambar baru dipilih";


            const dataTransfer = new DataTransfer();


            selectedFiles.forEach((file, index) => {

                dataTransfer.items.add(file);


                const col = document.createElement('div');

                col.className = 'col-md-4 mb-3';


                col.innerHTML = `

                    <div class="new-gallery-card">

                        <button
                            type="button"
                            class="remove-new-image"
                            data-index="${index}">
                            ✕
                        </button>

                        <img
                            src="${URL.createObjectURL(file)}"
                            alt="Preview"
                        >

                    </div>

                `;


                galleryPreview.appendChild(col);

            });


            // Masukkan kembali semua file
            // ke input file

            galleryInput.files = dataTransfer.files;


            // Tombol hapus gambar baru

            document.querySelectorAll('.remove-new-image')
                .forEach(button => {

                    button.addEventListener('click', function () {

                        const index =
                            parseInt(this.dataset.index);

                        selectedFiles.splice(index, 1);

                        renderNewGallery();

                    });

                });

        }

    </script>
    <!-- UNTUK HAPUS GAMBAR GALERI -->
    <script>

        document.querySelectorAll('.remove-old-image')
            .forEach(button => {

                button.addEventListener('click', function () {

                    const imageId = this.dataset.id;

                    if (!confirm('Hapus gambar ini?')) {
                        return;
                    }


                    fetch(
                        `/admin/product/gallery/${imageId}`,
                        {
                            method: 'DELETE',

                            headers: {
                                'X-CSRF-TOKEN':
                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).getAttribute('content'),

                                'Accept': 'application/json'
                            }
                        }
                    )
                        .then(response => response.json())

                        .then(data => {

                            if (data.success) {

                                document
                                    .getElementById(
                                        `gallery-image-${imageId}`
                                    )
                                    .remove();

                            }

                        });

                });

            });

    </script>
@endsection