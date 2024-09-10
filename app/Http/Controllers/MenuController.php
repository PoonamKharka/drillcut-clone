<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContentfulService;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    protected $contentful;

    public function __construct(ContentfulService $contentful) {
     $this->contentful = $contentful;
    }

    public function index(Request $request)
    {   

        if($request->ajax()) {
            $subMenus = $this->contentful->fetchEntries('subMenus');
            $menus = $this->contentful->fetchEntries('menus');
            $sortedMenu = array_reverse($menus['items']);
            $sortedData = array_reverse($subMenus['items']);
            $includes = $subMenus['includes'];
            
            // Create a lookup map for includes
                $entryMap = [];
                foreach ($includes['Entry'] as $entry) {
                    $entryMap[$entry['sys']['id']] = $entry;
                }
               
                // Resolve references
                $resolvedData = collect($sortedData)->map(function ($item) use ($entryMap, $sortedMenu) {
                    $fields = $item['fields'];
                    
                    // Resolve the Brand reference
                    if (isset($fields['parent']['sys']['id'])) {
                        $brandId = $fields['parent']['sys']['id'];
                        $fields['parent'] = $entryMap[$brandId]['fields'] ?? null;
                    }
                    
                    return [
                        'id' => $fields['id'],
                        'name' => $fields['title'] ?? 'Unknown',
                        'parent' => $fields['parent']['name'] ?? 'Unknown'
                    ];
                });
                
                return DataTables::of($resolvedData)
                        ->addColumn('parent', function($row){
                            return $row['parent'];
                        })
                        // ->addColumn('category', function($row){
                        //     return $row['category'];
                        // })
                        // ->addColumn('sub-category', function($row){
                        //     return $row['sub-category'];
                        // })
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                            $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                            
                            return $btn;
                        })
                        ->rawColumns(['action', 'parent'])
                        ->make(true);
        }
        return view('admin.menu.index');
    }
}
