<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        try {
            $languages = Language::all();
            return view('language.index', compact('languages'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve languages');
        }
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        try {
            $language = new Language();
            $language->code = $request->input('code');
            $language->name = $request->input('name');
            $language->save();

            return redirect()->back()->with('success', 'Language created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create language');
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required',
                'code' => 'required',
            ]);

            $language = Language::find($id);
            if (!$language) {
                return redirect()->back()->with('error', 'Failed to update language');
            }
            $language->code = $request->input('code');
            $language->name = $request->input('name');
            $language->save();


            return redirect()->back()->with('success', 'Language updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update language');
        }
    }

    public function destroy($id)
    {
        $jenjang = Language::findOrFail($id);
        try {
            $jenjang->delete();
            return redirect()->back()->with('success', 'Language deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Failed to delete language');
            } else {
                return redirect()->back()->with('error', 'Failed to delete language. Error: ' . $e->getMessage());
            }
        }
    }
}
