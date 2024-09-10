<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContentfulService;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    protected $contentful;

    public function __construct(ContentfulService $contentful) {
     $this->contentful = $contentful;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $categories = $this->contentful->fetchEntries('category');
            $categoriesData = $categories['items'];
            // Extract relevant fields from Contentful data
            $processedData = collect($categoriesData)->map(function($item) {
                return [
                    'id' => $item['fields']['id'],
                    'name' => $item['fields']['name'],
                ];
            });
            
            return DataTables::of($processedData)
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.category.index');
    }
}
