<form method="GET" action="/admin/article">

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="">
                <div class="row">

                    <div class="col-md-11 mb-3">
                        <label class="form-label">Cari Artikel</label>

                        <input type="text" name="search" class="form-control"
                            placeholder="Cari judul atau isi artikel..." value="{{ request('search') }}">
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
</form>