@extends('admin.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Tambah Review</h3>

        <a href="/admin/review" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/admin/review" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf

                {{-- Produk --}}
                <div class="mb-3">
                    <label class="form-label">Produk</label>

                    <select name="product_id" class="form-select">

                        <option value="">-- Pilih Produk --</option>

                        @foreach($products as $product)

                            <option value="{{ $product->id }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                {{ $product->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('product_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                {{-- Nama Reviewer --}}
                <div class="mb-3">

                    <label class="form-label">Nama Reviewer</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                    >

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                {{-- Rating --}}
                <div class="mb-3">

                    <label class="form-label">Rating</label>

                    <select name="rating" class="form-select">

                        <option value="">-- Pilih Rating --</option>

                        @for($i=5; $i>=1; $i--)

                            <option value="{{ $i }}"
                                {{ old('rating') == $i ? 'selected' : '' }}>

                                {{ str_repeat('⭐', $i) }}

                            </option>

                        @endfor

                    </select>

                    @error('rating')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                {{-- Foto Review --}}
                <div class="mb-3">

                    <label class="form-label">Foto Review</label>

                    <input
                        type="file"
                        class="form-control"
                        name="photo"
                        id="photo"
                        accept="image/*"
                    >

                    @error('photo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                {{-- Preview --}}
                <div class="mb-4">

                    <img
                        id="preview"
                        src="https://placehold.co/300x200?text=Preview"
                        class="img-thumbnail"
                        style="max-width:300px;"
                    >

                </div>


                {{-- Review --}}
                <div class="mb-4">

                    <label class="form-label">Review</label>

                    <textarea
                        name="comment"
                        rows="5"
                        class="form-control"
                    >{{ old('comment') }}</textarea>

                    @error('comment')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <button class="btn btn-primary">
                    Simpan Review
                </button>

            </form>

        </div>
    </div>

</div>

@endsection


@push('scripts')

<script>

document.getElementById('photo').addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        document.getElementById('preview').src =
            URL.createObjectURL(file);

    }

});

</script>

@endpush