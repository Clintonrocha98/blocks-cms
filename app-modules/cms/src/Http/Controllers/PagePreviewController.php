<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use ClintonRocha\CMS\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PagePreviewController extends Controller
{
    public function show(int $id): Factory|View
    {
        $page = Page::query()
            ->with('blocks')
            ->findOrFail($id);

        return view('pages.preview', ['page' => $page]);
    }
}
