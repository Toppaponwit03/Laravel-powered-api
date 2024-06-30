<?php

namespace App\Http\Controllers;

use App\Models\category;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Schema;
class ResfullApi extends Controller
{
  public function show($id , Request $request){
        if($request->func == 'getData'){
            $data = category::with('SubCategory')->whereNull('parent_id')->select('id','name','parent_id')->get(); // select All
        }
        elseif($request->func == 'getDataStanalone'){
            $data = category::select('id','name','parent_id')->find($request->id);
        }
        elseif($request->func == 'getDataInsideNode'){
            $data = category::where('id',$request->id)->with('SubCategory')->select('id','name','parent_id')->get(); // select leaf inside node

        }
        elseif($request->func == 'getDataTenThoundsand'){
            $test = [];
            DB::statement("SET GLOBAL cte_max_recursion_depth = 12000");
            $data = DB::select("
                WITH RECURSIVE TreePath AS (
                    SELECT id, name, parent_id, 0 AS level
                    FROM categories
                    WHERE id = ?

                    UNION ALL

                    SELECT dt.id, dt.name, dt.parent_id, tp.level + 1
                    FROM categories dt
                    JOIN TreePath tp ON dt.parent_id = tp.id
                )
                SELECT *
                FROM TreePath;
            ", [$request->id]);

            // $data = Category::with('SubCategory')->find($request->id);
        }
        return response()->json([
            "data" => $data
        ]);
  }

  public function store(Request $request){
      try{
            if($request->func == 'saveCategory'){
                $arrInsert = [];

                foreach($request->categories as $item){
                    $arrInsert[] = [
                        "name" => $item['name'],
                        "parent_id" => @$item['parent_id'],
                        "created_at" => now(),
                        "updated_at" => now()
                    ];
                }

                category::insert($arrInsert);

                return response()->json($arrInsert);
            }
            elseif($request->func == 'tenThoundsand'){
                for($i=0 ; $i<=10000 ; $i++){
                    $arrInsert[] = [
                        "name" => "root".@$i,
                        "parent_id" => @$i == 0 ? null : @$i,
                        "created_at" => now(),
                        "updated_at" => now()
                    ];
                }

                category::insert($arrInsert);
            }
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }




  }

  public function update($id){
    return 'update';
  }

  public function destroy($id , Request $request){
    if($request->func == 'deleteCategory'){
        DB::beginTransaction();

    try {

        $category = Category::find($request->id);

        if ($category) {
            $parentId = $category->parent_id;


          $t =  Category::where('parent_id', $request->id)->update(['parent_id' => $parentId]);

            $category->delete();
        }

        DB::commit();

        return response()->json($t);
    } catch (Exception $e) {
        DB::rollBack();
        return false;
    }

    }

  }

}
