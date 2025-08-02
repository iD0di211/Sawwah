<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Country;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
   
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('favorites.index', compact('favorites'));
    }

    // حفظ دولة جديدة في المفضلة
    public function store(Request $request)
    {
        $country = Country::findOrFail($request->country_id);

        $fav = new Favorite();
        $fav->user_id = Auth::check() ? Auth::id() : null;
        $fav->country_id = $country->id;
        $fav->country_name = $country->name;
        $fav->cost = $country->cost_label;
        $fav->weather = $country->weather_label;
        $fav->language = $country->language_label;
        $fav->type = $country->type_label;
        $fav->description = $country->description;
        $fav->save();

        return response()->json(['status' => 'ok']);
    }

    // حذف دولة من المفضلة
    public function destroy($id)
    {
        $fav = Favorite::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $fav->delete();

        return redirect()->route('favorites.index')->with('success', 'تم حذف الدولة من المفضلة');
    }
}
