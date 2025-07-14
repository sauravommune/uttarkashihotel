<?php

namespace App\Http\Controllers;

use App\DataTables\MetaSettingsDataTable;
use App\Models\MetaSettings;

class SEOAndRouteController extends Controller
{

    public function index(MetaSettingsDataTable $dataTable)
    {
        addVendors(['datatable']);
        $title = 'Page SEO Settings';
        return $dataTable->render('seoAndRoute.index', compact('title'));
    }

    public function form($id)
    {
        $metaSetting = MetaSettings::findOrFail($id);
        $html =  view('seoAndRoute.form', compact('metaSetting'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }
}
