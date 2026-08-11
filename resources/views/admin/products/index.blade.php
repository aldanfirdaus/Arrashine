@extends('admin.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Data Produk</h3>
            <small class="text-muted">
                Total Produk : {{ $products->total() }}
            </small>
        </div>

        <a href="/admin/product/create" class="btn btn-primary">
            Tambah Produk
        </a>
    </div>

    @include('admin.products.productComponents.filter')
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <td class="text-center">{{ $products->firstItem() + $loop->index }}</td>

                        <td width="120">
                            <img src="{{ asset('storage/' . $product->image) }}" width="80">
                        </td>

                        <td>{{ $product->name }}</td>

                        <td>{{ $product->gender }}</td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">

                                <a href="/admin/product/{{ $product->id }}" class="btn btn-warning action-btn">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmationDelete-{{ $product->id }}">
                                    <i class="fas fa-eraser"></i>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @include('admin.products.confirmation-delete')
                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data produk.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>

@endsection