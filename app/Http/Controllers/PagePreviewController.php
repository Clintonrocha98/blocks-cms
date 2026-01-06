<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagePreviewController extends Controller
{
    public function show(int $id)
    {
        $page = Page::query()
            ->with('blocks')
            ->findOrFail($id);

        return view('pages.preview', compact('page'));
    }
}
