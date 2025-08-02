<?php
namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TravelController extends Controller
{
    
    public function index(Request $request)
    {
        $countries = Country::query();

        if ($request->search) {
            $countries->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->cost) {
            $countries->where('cost', $request->cost);
        }
        if ($request->weather) {
            $countries->where('weather', $request->weather);
        }
        if ($request->lang) {
            $countries->where('language', 'like', '%' . $request->lang . '%');
        }
        if ($request->type) {
            $countries->where('type', $request->type);
        }

        $allCountries = Country::all();

        // استخراج جميع اللغات الفريدة من جدول الدول
        $allLanguages = Country::all()
            ->pluck('language')
            ->flatMap(function ($lang) {
                return explode(',', $lang);
            })
            ->map(fn($l) => trim($l))
            ->unique()
            ->values();

        return view('travel', [
            'countries' => $countries->get(),
            'allCountries' => $allCountries,
            'allLanguages' => $allLanguages
        ]);
    }

    public function budget(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'people' => 'required|integer|min:1',
            'days' => 'required|integer|min:1',
            'level' => 'required|in:economy,medium,luxury'
        ]);

        $country = Country::findOrFail($request->country_id);

        $base = $country->cost == 'high' ? 1000 : ($country->cost == 'medium' ? 700 : 400);
        if ($request->level == 'medium') $base += 200;
        if ($request->level == 'luxury') $base += 800;

        $budget = $base * $request->people * $request->days;

        return redirect()->route('travel')
            ->with('budget', number_format($budget));
    }

    public function suggest(Request $request)
    {
        $countries = Country::query();

        if ($request->cost) {
            $countries->where('cost', $request->cost);
        }
        if ($request->weather) {
            $countries->where('weather', $request->weather);
        }
        if ($request->type) {
            $countries->where('type', $request->type);
        }

        $suggested = $countries->inRandomOrder()->first();

        return redirect()->route('travel')
            ->with('suggestion', $suggested ? $suggested->name : null);
    }
}
