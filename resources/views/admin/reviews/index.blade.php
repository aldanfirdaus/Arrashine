@extends('admin.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Review Produk</h3>
                <small class="text-muted">
                    Total Review : {{ $reviews->total() }}
                </small>
            </div>

            <a href="/admin/review/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Review
            </a>
        </div>

        {{-- Search dan Filter --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="">
                    <div class="row">

                        <div class="col-md-8 mb-3">
                            <label class="form-label">Cari Review</label>

                            <input type="text" name="search" class="form-control"
                                placeholder="Cari produk, reviewer atau isi review..." value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Produk</label>

                            <select name="product" class="form-select">

                                <option value="">Semua Produk</option>

                                @foreach($products as $product)

                                    <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>

                                        {{ $product->name }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-1 d-flex align-items-end mb-3">

                            <button class="btn btn-primary w-100">
                                Cari
                            </button>

                        </div>

                    </div>
                </form>

            </div>
        </div>

        {{-- Table --}}
        <div class="card shadow-sm">

            <div class="table-responsive">

                <table class="table table-bordered align-middle table-hover mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th width="40">No</th>

                            <th width="70">Foto</th>

                            <th>Produk</th>

                            <th>Reviewer</th>

                            <th width="150">Rating</th>

                            <th>Review</th>

                            <th width="120">Tanggal</th>

                            <th width="120" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($reviews as $review)

                            <tr>

                                <td class="text-center">
                                    {{ $reviews->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    @if($review->photo)

                                        <img src="{{ asset('storage/' . $review->photo) }}" width="55" height="55"
                                            class="rounded object-fit-cover">

                                    @else

                                        <span class="text-muted">-</span>

                                    @endif

                                </td>

                                <td>

                                    {{ $review->product->name }}

                                </td>

                                <td>

                                    {{ $review->name }}

                                </td>

                                <td>

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $review->rating)

                                            ⭐

                                        @else



                                        @endif

                                    @endfor

                                </td>

                                <td>

                                    {{ Str::limit($review->comment, 60) }}

                                </td>

                                <td>

                                    {{ $review->created_at->format('d M Y') }}

                                </td>

                                <td class="text-center">

                                    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                                        <a href="/admin/review/{{ $review->id }}" class="btn btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#confirmationDelete-{{ $review->id }}">
                                            <i class="fas fa-eraser"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            @include('admin.reviews.confirmation-delete')
                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-5">

                                    Belum ada review.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-4">

            {{ $reviews->links() }}

        </div>

    </div>

@endsection