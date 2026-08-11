<form method="GET" action="/product">

    <div class="row mb-5">

        <div class="col-9 col-md-9">

            <input type="text" name="search" class="form-control" placeholder="Search by product name or aroma..."
                value="{{ request('search') }}">

        </div>

        <div class="col-3 col-md-3">

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

    </div>

</form>