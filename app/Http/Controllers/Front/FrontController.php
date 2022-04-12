<?php

namespace App\Http\Controllers\Front;

use App\Models\System;
use App\Models\Social;
use App\Models\Page;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function __construct()
    {
        @session_start();

        //logo
        $logo = System::select('Description')->where('Code', 'logo')->first();
        view()->share('logo', $logo);

        //favicon
        $favicon = System::select('Description')->where('Code', 'favicon')->first();
        view()->share('favicon', $favicon);

        //copyright
        $copyright = System::select('Description')->where('Code', 'copyright')->first();
        view()->share('copyright', $copyright);

        //social
        $socials = Social::selectRaw('name, font, alias')->where('status', 1)->orderBy('sort', 'asc')->get();
        view()->share('socials', $socials);

        //page
        $pages = Page::selectRaw('name, font, alias')->where('status', 1)->orderBy('sort', 'asc')->get();
        view()->share('pages', $pages);
    }

    public function home()
    {
        //listNews
        $listNews = DB::table('news as N')
            ->join('news_catalogues as NC', 'N.idcat', '=', 'NC.id')
            ->selectRaw('N.*, NC.name as CatalogueName')
            ->where('N.idcat', 1)
            ->orderBy('N.id', 'DESC')
            ->limit(6)
            ->get();

        //listSlider
        $listSilders = Slider::get();

        //listNewSale
        $listNewsSale = DB::table('news as N')
            ->join('news_catalogues as NC', 'N.idcat', '=', 'NC.id')
            ->selectRaw('N.*, NC.name as CatalogueName')
            ->where('N.idcat', 1)
            ->orderBy('N.id', 'DESC')
            ->limit(6)
            ->get();

        //listNewsViews
        $listNewsViews = DB::table('news as N')
            ->join('news_catalogues as NC', 'N.idcat', '=', 'NC.id')
            ->selectRaw('N.*, NC.name as CatalogueName')
            ->orderBy('N.views', 'DESC')
            ->limit(4)
            ->get();

        return view('front.home.index', compact('listNews', 'listSilders', 'listNewsSale','listNewsViews'));
    }
}
