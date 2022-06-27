<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.pages.category', ['categories' => $categories]);
    }

    public function list_category()
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        foreach ($categories as $category) {
            echo $html = '
            <tr>
                <td> ' . $category->name . ' </td>
                <td> ' . $category->desc . ' </td>
                <td>
                    <a href="javascript:;" class="btn btn-info" id="updatecategory"
                        data-eid="' . $category->id . '">
                        Edit
                    </a>
                </td>
                <td>
                    <button class="btn btn-danger" id="delcategory" data-id="' . $category->id . '">
                        Delete
                    </button>
                </td>
            </tr>';
        }
    }

    public function add_category(Request $r)
    {
        $cat = $r->name;
        $desc = $r->desc;
        $icon = $r->catIcon;

        if ($r->hasFile('catIcon')) {
            $icon_img = $r->file('catIcon')->store('public/admin_category');
        }

        $obj = new Category();
        $obj->name = $cat;
        $obj->desc  = $desc;
        $obj->icon  = $icon_img;
        $obj->save();

        return redirect()->back()->with('success', 'Record added successfully');
    }

    public function del_category()
    {
        $id = $_GET['id'];

        $delQuery = Category::where(['id' => $id])->delete();

        if ($delQuery != "") {
            return response()->json([
                'success' => 'Category deleted successfully',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'success' => 'Failed delete category',
                'status' => 401
            ]);
        }
    }

    public function get_category()
    {
        $selectQuery = Category::where(['id' => $_GET['id']])->get();

        foreach ($selectQuery as $sQuery) {
            $html['id'] = $sQuery->id;
            $html['name'] = $sQuery->name;
            $html['desc'] = $sQuery->desc;
        }
        echo json_encode($html);
    }

    public function update_category(Request $r)
    {
        $id = $r->id;
        $name = $r->name;
        $desc = $r->desc;

        $obj = Category::find($id);

        $obj->name = $name;
        $obj->desc = $desc;
        $obj->update();

        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }
}
