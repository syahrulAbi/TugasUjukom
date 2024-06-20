<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('data_kategori', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->categoryName
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,name,'.$id
        ]);

        $category = Category::find($id);
        $category->name = $request->categoryName;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
