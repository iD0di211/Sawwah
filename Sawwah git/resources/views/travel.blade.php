@extends('layout')

@section('title', 'أين أسافر؟')

@section('content')
<div dir="rtl" class="page-container mx-auto max-w-5xl" style="margin-top:32px; padding: 0 8px;">
    <video autoplay muted loop class="video-bg" >
        <source src="{{ asset('videos/5.mp4') }}" type="video/mp4">
        متصفحك لا يدعم الفيديو.
    </video>

    <div class="header-bar-main">
        <div style="z-index:2;">
            <h1>
                منصة سواح: خطط رحلتك بأفضل الطرق!<br>
                استكشف، فلتر، قارن، واقترح وجهة تناسب احتياجك بسهولة وذكاء.
            </h1>
            <div class="header-desc">
                جرب خيارات البحث المتقدمة واحفظ الدول المفضلة، واحسب ميزانيتك بكل مرونة. دعم كامل للغات متعددة ودول جديدة تضاف باستمرار.
            </div>
        </div>
        <a href="{{ route('favorites.index') }}" class="saved-btn">الدول المحفوظة</a>
    </div>

    <section class="beige-box">
        <h2 class="text-2xl font-bold text-center">الدول السياحية</h2>
        <form method="GET" action="{{ route('travel') }}" class="filter-form" id="filterForm">
            <input type="text" name="search" value="{{ old('search', request('search')) }}" placeholder="ابحث عن دولة...">
            <select name="cost">
                <option value="">تكلفة السفر</option>
                <option value="high" {{ request('cost')=='high' ? 'selected':'' }}>عالية التكلفة</option>
                <option value="medium" {{ request('cost')=='medium' ? 'selected':'' }}>متوسطة التكلفة</option>
                <option value="low" {{ request('cost')=='low' ? 'selected':'' }}>منخفضة التكلفة</option>
            </select>
            <select name="weather">
                <option value="">الطقس</option>
                <option value="cold" {{ request('weather')=='cold' ? 'selected':'' }}>بارد</option>
                <option value="hot" {{ request('weather')=='hot' ? 'selected':'' }}>حار</option>
            </select>
            <select name="lang">
                <option value="">اللغة</option>
                @foreach($allLanguages as $lang)
                    <option value="{{ $lang }}" {{ request('lang') == $lang ? 'selected' : '' }}>
                        {{ \App\Models\Country::langName($lang) }}
                    </option>
                @endforeach
            </select>
            <select name="type">
                <option value="">نوع الرحلة</option>
                <option value="family" {{ request('type')=='family' ? 'selected':'' }}>عائلية</option>
                <option value="single" {{ request('type')=='single' ? 'selected':'' }}>فردية</option>
                <option value="friends" {{ request('type')=='friends' ? 'selected':'' }}>أصدقاء</option>
            </select>
            <div class="btn-row">
                <button type="submit">بحث</button>
                <button type="button" class="reset-btn" onclick="resetForm('filterForm')">إعادة تعيين</button>
            </div>
        </form>
        <div class="country-list-scroll">
            @forelse($countries as $country)
                <div class="country-card">
                    <h3 class="text-xl font-bold mb-2">{{ $country->name }}</h3>
                    <div class="text-gray-700 mb-1">التكلفة: <span>{{ $country->cost_label }}</span></div>
                    <div class="text-gray-700 mb-1">الطقس: <span>{{ $country->weather_label }}</span></div>
                    <div class="text-gray-700 mb-1">
                        اللغة: <span>{{ $country->language_label }}</span>
                    </div>
                    <div class="text-gray-700 mb-1">نوع مناسب: <span>{{ $country->type_label }}</span></div>
                    <div class="text-gray-500 text-sm mt-2">{{ $country->description }}</div>
                    <button class="save-btn" type="button"
                        onclick="saveCountry({{ $country->id }})">
                        حفظ الدولة
                    </button>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-400">لا توجد دول متاحة...</div>
            @endforelse
        </div>
    </section>

    <!-- احسب ميزانيتك -->
    <section class="beige-box">
        <div style="display:flex;align-items:center;flex-wrap:wrap;gap:18px 30px;margin-bottom:15px;">
            <h2 class="text-2xl font-bold text-center mb-0">احسب ميزانيتك</h2>
            @if(session('budget'))
                <span style="color:#168654;font-size:1.07rem;font-weight:bold;">
                    تكلفة الرحلة التقريبية إلى {{ session('budget_country') }}: {{ session('budget') }} ريال
                </span>
            @endif
        </div>
        <form action="{{ route('travel.budget') }}" method="POST" class="filter-form" id="budgetForm" style="margin-bottom:0;">
            @csrf
            <select name="country_id" required>
                <option value="">اختر الدولة</option>
                @foreach($countries as $c)
                    <option value="{{ $c->id }}" {{ old('country_id', request('country_id')) == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
            <input type="number" name="people" min="1" placeholder="عدد الأفراد" required value="{{ old('people', request('people')) }}">
            <input type="number" name="days" min="1" placeholder="عدد أيام الإقامة" required value="{{ old('days', request('days')) }}">
            <select name="level" required>
                <option value="">مستوى الترفيه</option>
                <option value="economy" {{ old('level', request('level')) == 'economy' ? 'selected' : '' }}>اقتصادي</option>
                <option value="medium" {{ old('level', request('level')) == 'medium' ? 'selected' : '' }}>متوسط</option>
                <option value="luxury" {{ old('level', request('level')) == 'luxury' ? 'selected' : '' }}>فاخر</option>
            </select>
            <div class="btn-row">
                <button type="submit">احسب</button>
                <button type="button" class="reset-btn" onclick="resetForm('budgetForm')">إعادة تعيين</button>
                <button class="save-btn" type="button"
                    onclick="saveCountry(document.getElementById('budgetForm').country_id.value)">
                    حفظ الدولة المختارة
                </button>
            </div>
        </form>
    </section>

    <!-- الاقتراح -->
    <section class="beige-box text-center">
        <div style="display:flex;align-items:center;flex-wrap:wrap;gap:18px 30px;margin-bottom:15px;justify-content:center;">
            <h2 class="text-2xl font-bold mb-0">اقتراح وجهة مناسبة لك</h2>
            @if(session('suggestion'))
                <span style="color:#205893;font-size:1.04rem;font-weight:bold;">
                    الدولة المقترحة : {{ session('suggestion') }}
                </span>
            @elseif(request('cost') || request('weather') || request('type'))
                <span style="color:#ad2424;font-size:1.04rem;font-weight:bold;">
                    لا يوجد اقتراح مناسب للخيارات المحددة.
                </span>
            @else
                <span style="color:#757575;font-size:1.02rem;">
                    اختر نوع التكلفة والطقس ونوع الرحلة ليظهر لك اقتراح هنا.
                </span>
            @endif
        </div>
        <form method="GET" action="{{ route('travel.suggest') }}" class="suggest-form" id="suggestForm" style="margin-bottom:0;">
            <select name="cost">
                <option value="">تكلفة السفر</option>
                <option value="high" {{ request('cost')=='high' ? 'selected':'' }}>عالية التكلفة</option>
                <option value="medium" {{ request('cost')=='medium' ? 'selected':'' }}>متوسطة التكلفة</option>
                <option value="low" {{ request('cost')=='low' ? 'selected':'' }}>منخفضة التكلفة</option>
            </select>
            <select name="weather">
                <option value="">الطقس</option>
                <option value="cold" {{ request('weather')=='cold' ? 'selected':'' }}>بارد</option>
                <option value="hot" {{ request('weather')=='hot' ? 'selected':'' }}>حار</option>
            </select>
            <select name="type">
                <option value="">نوع الرحلة</option>
                <option value="family" {{ request('type')=='family' ? 'selected':'' }}>عائلية</option>
                <option value="single" {{ request('type')=='single' ? 'selected':'' }}>فردية</option>
                <option value="friends" {{ request('type')=='friends' ? 'selected':'' }}>أصدقاء</option>
            </select>
            <div class="btn-row" style="justify-content:center;">
                <button type="submit">اقترح لي</button>
                <button type="button" class="reset-btn" onclick="resetForm('suggestForm')">إعادة تعيين</button>
                <button class="save-btn" type="button"
                    onclick="saveSuggestion()">
                    حفظ الدولة المقترحة
                </button>
            </div>
        </form>
    </section>
</div>

<style>
body { background: #f8f4ee; }
.page-container { display: block !important; max-width: 700px; margin: 0 auto; }
.header-bar-main {
    width: 100%;
    background: linear-gradient(120deg, #fff6e6 80%, #ffe4cc 100%);
    border-radius: 24px;
    box-shadow: 0 4px 24px 0 #e4d8c382;
    margin: 38px 0 22px 0;
    padding: 38px 28px 32px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    min-height: 120px;
    position: relative;
    overflow: hidden;
}
.header-bar-main h1 {
    font-size: 1.38rem;
    font-weight: bold;
    color: #a07d51;
    margin: 0;
    flex: 1;
    line-height: 2.15rem;
    letter-spacing: 0.02em;
    z-index: 1;
    text-shadow: 0 3px 12px #fff1e780;
}
.header-bar-main .header-desc {
    color: #946e37;
    font-size: 1rem;
    margin-top: 14px;
    margin-bottom: 0;
    font-weight: 400;
    line-height: 1.9;
    z-index: 1;
}
.header-bar-main .saved-btn {
    background: #a07d51;
    color: #fff;
    border-radius: 10px;
    padding: 14px 36px;
    font-weight: bold;
    font-size: 1.13rem;
    border: none;
    box-shadow: 0 2px 8px #c9b29544;
    transition: background 0.2s, box-shadow 0.2s;
    margin-right: 10px;
    margin-top: 7px;
    z-index: 2;
    position: relative;
}
.header-bar-main .saved-btn:hover { background: #7f5a2c; box-shadow: 0 4px 16px #a07d5188; }
.beige-box {
    background: #fff8f3;
    border-radius: 18px;
    box-shadow: 0 2px 10px 0 #e4d8c3;
    padding: 2rem 1.1rem;
    margin: 18px 0;
}
.beige-box h2 {
    color: #a07d51;
    margin-bottom: 18px !important;
    display: inline-block;
    vertical-align: middle;
}
.country-list-scroll {
    max-height: 350px;
    overflow-y: auto;
    padding-left: 5px;
    padding-right: 5px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.1rem;
}
.country-card {
    background: #fcf6ef;
    border-radius: 15px;
    box-shadow: 0 1px 10px #e4d8c3;
    transition: 0.2s;
    padding: 1.1rem;
    margin-bottom: 1rem;
    min-height: 145px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.country-card:hover { box-shadow: 0 8px 20px #e4d8c3; }
.country-list-scroll::-webkit-scrollbar { width: 8px; background: #f4eadd; border-radius: 4px;}
.country-list-scroll::-webkit-scrollbar-thumb { background: #e4d8c3; border-radius: 5px;}
.filter-form, .suggest-form {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.4rem;
    align-items: center;
}
.filter-form select, .filter-form input,
.suggest-form select {
    flex: 1 1 140px;
    min-width: 110px;
    font-size: 1rem;
    padding: 10px;
    border-radius: 10px;
    border: 1.5px solid #e4d8c3;
    background: #fbf8f4;
    font-family: 'Tajawal', 'Cairo', Arial, sans-serif;
    color: #6a5c3a;
    transition: border 0.2s;
    margin-bottom: 0.5rem;
}
.filter-form select:focus, .filter-form input:focus,
.suggest-form select:focus { border-color: #a07d51; outline: none; }
.filter-form button, .suggest-form button {
    background: #a07d51;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    padding: 12px 28px;
    font-size: 1.02rem;
    margin-top: 4px;
    transition: background 0.2s;
}
.filter-form button:hover, .suggest-form button:hover {
    background: #7f5a2c;
}
.reset-btn {
    background: #ed5645;
    color: #fff;
    border: none;
    border-radius: 9px;
    padding: 10px 19px;
    font-size: .98rem;
    margin-right: 0.3rem;
    font-weight: bold;
    transition: background 0.17s;
}
.reset-btn:hover { background: #ba3320; }
.save-btn {
    background: #f8e3c0;
    color: #a07d51;
    border: 1px solid #dab37c;
    border-radius: 9px;
    font-size: 1rem;
    padding: 7px 20px;
    margin-top: 12px;
    cursor: pointer;
    transition: background 0.18s;
}
.save-btn:hover {
    background: #ffe7bb;
    color: #8b6a2d;
    border-color: #a07d51;
}
.btn-row {
    display: flex;
    gap: 9px;
    margin-top: 6px;
    justify-content: flex-start;
}
@media (max-width: 550px) {
    .page-container { max-width: 99vw; padding: 0 2px;}
    .country-card {
        padding: 0.7rem;
        min-height: 110px;
    }
    .beige-box { padding: 0.7rem 0.4rem; margin: 7px 0;}
    .btn-row { flex-direction: column; gap: 6px; }
    .header-bar-main { flex-direction: column; gap: 10px; padding: 16px 8px 16px 8px;}
    .header-bar-main .saved-btn { width: 100%; margin: 0; }
    .header-bar-main h1 { font-size: 1.05rem; line-height: 1.5rem;}
    .header-bar-main .header-desc { font-size: .93rem; line-height: 1.4; }
}
</style>

<script>
function resetForm(formId) {
    document.getElementById(formId).reset();
    if (formId === 'filterForm' || formId === 'suggestForm') {
        window.location = "{{ route('travel') }}";
    }
}
function saveCountry(countryId) {
    if(!countryId) { alert('اختر دولة أولاً!'); return; }
    fetch("{{ route('favorite.add') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
        body: JSON.stringify({ country_id: countryId })
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === 'ok') {
            alert('تم حفظ الدولة في المفضلة!');
        }
    });
}
function saveSuggestion() {
    let suggested = @json(session('suggestion'));
    if(!suggested) { alert('لا يوجد اقتراح!'); return; }
    let countries = @json($countries);
    let match = countries.find(c => c.name === suggested);
    if(match) {
        saveCountry(match.id);
    } else {
        alert('الدولة غير موجودة بالحالية');
    }
}
</script>
@endsection
