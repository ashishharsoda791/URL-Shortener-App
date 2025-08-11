<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    /**
     * Show the URL shortening form
     */
    public function index()
    {
        return view('url-shortener.index');
    }

    /**
     * Store a new shortened URL
     */
    public function shorten(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $originalUrl = $request->input('url');

        // Check if URL already exists
        $existingUrl = ShortenedUrl::where('original_url', $originalUrl)->first();
        
        if ($existingUrl) {
            return redirect('/')->with('shortUrl', $existingUrl->short_url);
        }

        // Create new shortened URL
        $shortenedUrl = ShortenedUrl::create([
            'original_url' => $originalUrl,
            'short_code' => ShortenedUrl::generateShortCode(),
        ]);

        return redirect('/')->with('shortUrl', $shortenedUrl->short_url);
    }

    /**
     * Redirect to the original URL
     */
    public function redirect($shortCode)
    {
        $shortenedUrl = ShortenedUrl::where('short_code', $shortCode)->first();

        if (!$shortenedUrl) {
            abort(404);
        }

        return redirect($shortenedUrl->original_url);
    }
}
