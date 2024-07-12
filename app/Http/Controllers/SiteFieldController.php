<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\SiteField;
use Illuminate\Http\Request;

class SiteFieldController extends Controller
{
    public function manageFields($siteId)
    {
        $site = Site::with('fields')->findOrFail($siteId);
        return view('site_fields.manage', compact('site'));
    }

    public function create($siteId)
    {
        $site = Site::findOrFail($siteId);
        return view('site_fields.create', compact('site'));
    }

    public function store(Request $request, $siteId)
    {
        $site = Site::findOrFail($siteId);

        $field = new SiteField();
        $field->site_id = $site->id;
        $field->field_name = $request->field_name;
        $field->field_type = $request->field_type;
        $field->save();

        return redirect()->route('site_fields.manage', $siteId)->with('success', 'Campo adicionado com sucesso.');
    }

    public function edit($siteId, $fieldId)
    {
        $site = Site::findOrFail($siteId);
        $field = SiteField::findOrFail($fieldId);
        return view('site_fields.edit', compact('site', 'field'));
    }

    public function update(Request $request, $siteId, $fieldId)
    {
        $site = Site::findOrFail($siteId);
        $field = SiteField::findOrFail($fieldId);

        $field->field_name = $request->field_name;
        $field->field_type = $request->field_type;
        $field->save();

        return redirect()->route('sites.show', $siteId)->with([
            'message' => 'Campo alterado com sucesso.',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($siteId, $fieldId)
    {
        $field = SiteField::findOrFail($fieldId);
        $field->delete();

        return redirect()->route('sites.show', $siteId)->with([
            'message' => 'Campo removido com sucesso.',
            'alert-type' => 'success'
        ]);
    }

}
