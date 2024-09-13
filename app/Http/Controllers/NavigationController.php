<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigation;
use Yajra\DataTables\DataTables;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $menuList = Navigation::where('parent_id' , '=', 0)->select(['id', 'title', 'slug', 'parent_id']);
            return DataTables::of($menuList)
                    ->editColumn('menu_items', function ($row) {
                        $getItems = Navigation::where('parent_id', '=', $row->id)->get()->toArray();
                        if($getItems) {
                            $array_items = [];
                            foreach ($getItems as $items) {
                                $arr[]  = $items['title'];
                            }
                            $array_items[] = implode(" , " , $arr);
                            return $array_items;
                        } else {
                            return 'None';
                        }
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="' . route('navigation.edit', encrypt($row->id)) . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
                        
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getMenus = Navigation::get();
        return view('admin.menu.create', compact('getMenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = Navigation::create($request->all());
        return redirect()->route('navigation.index')->with('success', 'Navigation Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Navigation::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menuId = decrypt($id);
        $menuDetails = Navigation::findOrFail($menuId);
        $getMenus = Navigation::where('parent_id', '=', $menuDetails->id)->get();
        return view('admin.menu.edit', compact(['menuDetails','getMenus']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menuDetails = Navigation::findOrFail($id);
        $menuDetails->update($request->all());
        return redirect()->route('navigation.index')->with('success', 'Navigation Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
