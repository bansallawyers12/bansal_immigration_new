<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suburb;
use App\Models\PostcodeRange;

class PostcodeController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $input = trim($request->query('search', ''));
        $results = [];

        if ($input === '') {
            return response()->json([]);
        }

        if (ctype_digit($input)) {
            $suburbs = Suburb::where('postcode', (int) $input)->get();
        } else {
            $suburbs = Suburb::where('suburb', 'like', '%' . $input . '%')->get();
        }

        foreach ($suburbs as $suburb) {
            $range = PostcodeRange::where('start_postcode', '<=', $suburb->postcode)
                ->where('end_postcode', '>=', $suburb->postcode)
                ->orderBy('start_postcode')
                ->first();

            $category = $range?->category ?? 'Category 1, Not Regional – Major Cities';
            $regional = (str_contains($category, 'Category 2') || str_contains($category, 'Category 3'));

            $results[] = [
                'suburb' => $suburb->suburb,
                'postcode' => (string) $suburb->postcode,
                'state' => $suburb->state,
                'category' => $category,
                'regional' => $regional,
            ];
        }

        return response()->json($results);
    }

    public function suggest(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $results = [];

        if ($query === '') {
            return response()->json($results);
        }

        if (ctype_digit($query)) {
            $matches = Suburb::where('postcode', 'like', $query . '%')
                ->limit(10)
                ->get(['suburb', 'postcode', 'state']);
        } else {
            $matches = Suburb::where('suburb', 'like', $query . '%')
                ->limit(10)
                ->get(['suburb', 'postcode', 'state']);
        }

        foreach ($matches as $m) {
            $results[] = [
                'suburb' => $m->suburb,
                'postcode' => (string) $m->postcode,
                'state' => $m->state,
            ];
        }

        return response()->json($results);
    }
}


