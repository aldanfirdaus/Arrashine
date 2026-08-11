@extends('admin.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Edit Artikel</h3>

            <a href="{{ url('/admin/article') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form action="/admin/article/{{ $article->id }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Judul Artikel
                        </label>

                        <input type="text" name="title" value="{{ old('title', $article->title) }}"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan judul artikel">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Gambar Artikel
                        </label>

                        <img src="{{ asset('storage/' . $article->image) }}" width="150" class="mb-2">
                        <input type="file" name="image" accept="image/*"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Preview gambar --}}
                    <div class="mb-3">
                        <img id="preview-image" src="https://placehold.co/600x300?text=Preview+Gambar"
                            class="img-fluid rounded border" style="max-height: 250px; object-fit: cover;">
                    </div>

                    {{-- Isi Artikel --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Isi Artikel
                        </label>

                        <textarea id="editor" name="body" class="form-control @error('body') is-invalid @enderror"
                            placeholder="Tulis isi artikel di sini...">{!! $article->body !!}</textarea>

                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end gap-2">

                        <button type="reset" class="btn btn-outline-secondary">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-success">
                            Edit
                        </button>

                    </div>

                </form>

            </div>
        </div>
        ```

    </div>

    {{-- Preview gambar --}}

    <script>
        document.querySelector('input[name="image"]').addEventListener('change', function (e) {

            const file = e.target.files[0];

            if (file) {

                document.getElementById('preview-image').src =
                    URL.createObjectURL(file);

            }

        });
    </script>

@endsection

@push('scripts')

<script>
    // Array global untuk melacak URL gambar yang di-upload
    window.uploadedImages = [];

    // Custom Upload Adapter
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file.then(file => new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);

                fetch("/admin/article/upload", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: data
                })
                .then(response => response.json())
                .then(result => {
                    if (result.url) {
                        // Simpan URL gambar ke daftar tracking
                        window.uploadedImages.push(result.url);
                        resolve({ default: result.url });
                    } else {
                        reject(result.error || 'Gagal mengunggah gambar.');
                    }
                })
                .catch(error => reject(error));
            }));
        }

        abort() {}
    }

    // Plugin Adapter Function
    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    // Fungsi pembantu untuk mengambil seluruh URL gambar dari Data HTML CKEditor
    function getImagesFromHTML(htmlContent) {
        const div = document.createElement('div');
        div.innerHTML = htmlContent;
        const imgs = div.querySelectorAll('img');
        return Array.from(imgs).map(img => img.src);
    }

    // Inisialisasi CKEditor
    document.addEventListener("DOMContentLoaded", function () {
        const editorElement = document.querySelector('#editor');
        
        if (editorElement) {
            ClassicEditor
                .create(editorElement, {
                    extraPlugins: [MyCustomUploadAdapterPlugin]
                })
                .then(editor => {
                    // Deteksi perubahan data artikel
                    editor.model.document.on('change:data', () => {
                        // Berikan sedikit jeda (delay) agar CKEditor selesai memperbarui HTML-nya
                        setTimeout(() => {
                            const editorData = editor.getData();
                            const currentImages = getImagesFromHTML(editorData);

                            if (window.uploadedImages && window.uploadedImages.length > 0) {
                                // Salin array agar aman saat di-filter
                                const trackedImages = [...window.uploadedImages];

                                trackedImages.forEach(src => {
                                    // Jika gambar yang di-track TIDAK ADA di data HTML editor saat ini
                                    if (!currentImages.includes(src)) {
                                        // Kirim AJAX hapus gambar fisik dari Laravel
                                        fetch("/admin/article/delete-image", {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                            },
                                            body: JSON.stringify({ src: src })
                                        });

                                        // Hapus dari daftar tracking
                                        window.uploadedImages = window.uploadedImages.filter(url => url !== src);
                                    }
                                });
                            }
                        }, 500); // Jeda 500ms
                    });
                })
                .catch(error => console.error('CKEditor Error:', error));
        }
    });
</script>
@endpush