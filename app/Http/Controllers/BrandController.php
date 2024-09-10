<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContentfulService;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    protected $contentful;

    public function __construct(ContentfulService $contentful) {
     $this->contentful = $contentful;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $brands = $this->contentful->fetchEntries('brand');
            $brandData = $brands['items'];
            // Extract relevant fields from Contentful data
            $processedData = collect($brandData)->map(function($item) {
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

        return view('admin.brand.index');
    }
}
