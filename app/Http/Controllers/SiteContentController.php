<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\SiteContent;
use App\Models\SiteField;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function createFields($siteId)
    {
        $site = Site::findOrFail($siteId);
        return view('site_fields.create', compact('site'));
    }

    public function storeFields(Request $request, $siteId)
    {
        $site = Site::findOrFail($siteId);
        foreach ($request->fields as $field) {
            $field = SiteField::create([
                'site_id' => $site->id,
                'field_name' => $field['name'],
                'field_type' => $field['type'],
            ]);
            SiteContent::updateOrCreate(
                ['site_id' => $site->id, 'field_id' => $field->id],
                
            );
        }
        return redirect()->route('sites.show', $siteId)->with([
            'message' => 'Campos adicionados com sucesso.',
            'alert-type' => 'success'
        ]);
    }

    public function createContents($siteId)
    {
        $site = Site::findOrFail($siteId);
        $fields = $site->fields;
        return view('site_contents.create', compact('site', 'fields'));
    }

    public function storeContents(Request $request, $siteId)
    {
        
        $site = Site::findOrFail($siteId);
        foreach ($request->contents as $fieldId => $content) {
            SiteContent::updateOrCreate(
                ['site_id' => $site->id, 'field_id' => $fieldId],
                ['content' => $content]
            );
        }
        return redirect()->route('sites.show', $siteId)->with([
            'message' => 'Conteúdos salvos com sucesso.',
            'alert-type' => 'success'
        ]);
    }

    public function updateContents(Request $request, $siteId, $contentId)
    {
        Site::findOrFail($siteId);
        $content = SiteContent::findOrFail($contentId);
        $content->content = $request->content;
        $content->save();

        return redirect()->route('sites.show', $siteId)->with([
            'message' => 'Conteúdo atualizado com sucesso.',
            'alert-type' => 'success'
        ]);
    }

    public function destroyContents($siteId, $contentId)
    {
        $content = SiteContent::findOrFail($contentId);

        // Definir o campo de conteúdo como null
        $content->content = null;
        $content->save();

        return redirect()->route('sites.show', $siteId)->with([
            'message' => 'Conteúdo removido com sucesso.',
            'alert-type' => 'success'
        ]);
    }
}
