<form method="GET" action="/admin/product">

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="">
                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label class="form-label">Cari Produk</label>

                        <input type="text" name="search" class="form-control"
                            placeholder="Cari produk, reviewer atau isi review..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">FIlter Gender</label>

                        <select name="gender" class="form-select" onchange="this.form.submit()">

                            <option value="">All</option>

                            <option value="Man" {{ request('gender') == 'Man' ? 'selected' : '' }}>
                                Man
                            </option>

                            <option value="Women" {{ request('gender') == 'Women' ? 'selected' : '' }}>
                                Women
                            </option>

                            <option value="Unisex" {{ request('gender') == 'Unisex' ? 'selected' : '' }}>
                                Unisex
                            </option>

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
</form>