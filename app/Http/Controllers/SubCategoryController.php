<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContentfulService;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    protected $contentful;

    public function __construct(ContentfulService $contentful) {
     $this->contentful = $contentful;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $subCategories = $this->contentful->fetchEntries('subCategory');
            $categoriesData = $subCategories['items'];
            $includes = $subCategories['includes'];

            // Create a lookup map for includes
            $entryMap = [];
            foreach ($includes['Entry'] as $entry) {
                $entryMap[$entry['sys']['id']] = $entry;
            }
            
            // Resolve references
            $resolvedData = collect($categoriesData)->map(function ($item) use ($entryMap) {
            $fields = $item['fields'];
            // Resolve the Category reference
            if (isset($fields['catId']['sys']['id'])) {
                $catId = $fields['catId']['sys']['id'];
                $fields['catId'] = $entryMap[$catId]['fields'] ?? null;
            }
                return [
                    'id' => $fields['id'],
                    'name' => $fields['name'] ?? 'N/A',
                    'category' => $fields['catId']['name'] ?? 'Unknown',
                ];
            });
            
            return DataTables::of($resolvedData)
                ->addColumn('category', function($row){
                    return $row['category'];
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                    
                    return $btn;
                })
                ->rawColumns(['action' , 'category'])
                ->make(true);
        }

        return view('admin.sub-category.index');
    }
}
