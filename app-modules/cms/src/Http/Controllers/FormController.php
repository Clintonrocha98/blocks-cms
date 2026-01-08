<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use ClintonRocha\CMS\Forms\FormRegistry;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submit(Request $request, string $formId)
    {
        $form = FormRegistry::get($formId);

        $validated = $request->validate($form->rules());

        $form->handle($validated);

        return back()->with('success', true);
    }
}
