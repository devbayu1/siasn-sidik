<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Faq;
use App\Models\Media;
use App\Models\Setting;
use App\Models\StaticPage;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();

        $abouts = About::orderBy('created_at', 'desc')->get();

        $pages = StaticPage::where('is_published', true)
            ->where('slug', '=', 'jenis-pengembangan-kompetensi')
            ->orderBy('created_at', 'desc')
            ->first();

        $medias = Media::where('type', '=', 'image')
            ->orderBy('created_at', 'desc')
            ->get();

        $tableConversion = Media::where('slug', '=', 'tabel-konversi')
            ->orderBy('created_at', 'desc')
            ->first();

        return view('frontend.home', compact(
            'faqs',
            'abouts',
            'pages',
            'medias',
            'tableConversion'
        ));
    }
}
