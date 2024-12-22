<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    // Hiển thị danh sách category
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    // Hiển thị form thêm mới category
    public function create()
    {
        return view('admin.category.add');
    }

    // Lưu category mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công!');
    }

    // Hiển thị form chỉnh sửa category
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    // Cập nhật category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.category.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục thành công!');
    }
}
