<?php

namespace App\Http\Controllers\Backend;

use App\Models\Field;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class SeoController extends Controller
{
    public function index()
    {
        Gate::authorize("seo-view");
        $fields = Field::all();
        return view("backend.seo.index", compact("fields"));
    }
    public function create()
    {
        // Gate::authorize("seo-create");
        if (Gate::any(['seo-create', 'seo-edit'])) {
            $fields = Field::all();
            return view("backend.seo.create", compact("fields"));
        } else {
            abort(403);
        }
    }
    public function store(Request $request)
    {
        if (Gate::any(['seo-create', 'seo-edit'])) {
            $fields = $request->input('fields', []);

            foreach ($fields as $fieldData) {
                // $fieldData['field_name'] = Str::slug($fieldData['field_name']);
                $fieldData['field_name'] = Str::slug(str_replace('@', '', $fieldData['field_name']));


                if (isset($fieldData['id'])) {

                    $field = Field::find($fieldData['id']);
                    if ($field) {
                        $field->update([
                            'type' => $fieldData['type'],
                            'label' => $fieldData['label'],
                            'field_name' => $fieldData['field_name'],
                        ]);
                    }
                } else {
                    Field::create([
                        'type' => $fieldData['type'],
                        'label' => $fieldData['label'],
                        'field_name' => $fieldData['field_name'],
                    ]);
                }
            }

            return redirect()->route('fields.index')->with('success', 'SEO Updated successfully.');
        } else {
            abort(403);
        }
    }


    public function storeValue(Request $request)
    {
        Gate::authorize('seo-edit');
        $request->validate([
            'field_ids' => 'required|array',
            'field_ids.*' => 'required|integer|exists:fields,id',
            'values' => 'required|array',
            'values.*' => 'nullable|string',
        ]);
        foreach ($request->field_ids as $index => $fieldId) {
            $field = Field::findOrFail($fieldId);
            $field->value = $request->values[$index];
            $field->save();
        }
        return redirect()->route('fields.index')->with('success', 'SEO Values updated successfully.');
    }

    public function destroy($id)
    {
        Gate::authorize('seo-delete');
        $field = Field::findOrFail($id);
        $field->delete();

        return response()->json(['message' => 'Fields Deleted Successfully']);
    }
}
