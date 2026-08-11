@extends('admin.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Data Artikel</h3>
            <small class="text-muted">
                Total Artikel : {{ $articles->total() }}
            </small>
        </div>

        <a href="/admin/article/create" class="btn btn-primary">
            Tambah Artikel & Berita
        </a>
    </div>
    @include('admin.articles.articlesComponents.filter')
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($articles as $article)

                    <tr>

                        <td class="text-center">{{ $articles->firstItem() + $loop->index }}</td>

                        <td>{{ $article->title }}</td>

                        <td width="120">
                            <img src="{{ asset('storage/' . $article->image) }}" width="80">
                        </td>

                        <td>{{ $article->created_at }}</td>

                        <td>
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">

                                <a href="/admin/article/{{ $article->id }}" class="btn btn-warning action-btn">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmationDelete-{{ $article->id }}">
                                    <i class="fas fa-eraser"></i>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @include('admin.articles.confirmation-delete')
                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data artikel.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>
    <div class="text-center">
        {{ $articles->links() }}
    </div>

@endsection