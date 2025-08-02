<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>البحث عن الدول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center">البحث عن الدول</h2>

    <form method="GET" action="{{ route('search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="ابحث باسم الدولة..." value="{{ $query ?? '' }}">
            <button type="submit" class="btn btn-primary">بحث</button>
        </div>
    </form>

    @if(isset($countries) && count($countries) > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($countries as $country)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $country->name }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($query))
        <div class="alert alert-warning text-center">لم يتم العثور على نتائج</div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>