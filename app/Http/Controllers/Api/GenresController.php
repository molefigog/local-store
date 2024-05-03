<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenreAddRequest;
use App\Http\Requests\GenreEditRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
class GenreController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Genre::query();
		if($request->search){
			$search = trim($request->search);
			Genre::search($query, $search);
		}
		$orderby = $request->orderby ?? "Genre.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Genre::listFields());
		return $this->respond($records);
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Genre::query();
		$record = $query->findOrFail($rec_id, Genre::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(GenreAddRequest $request){
		$modeldata = $request->validated();

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}

		//save Genre record
		$record = Genre::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(GenreEditRequest $request, $rec_id = null){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Forbidden Operation'], 403);
        }
		$query = Genre::query();
		$record = $query->findOrFail($rec_id, Genre::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
		}
		return $this->respond($record);
	}


	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
		$arr_id = explode(",", $rec_id);
		$query = Genre::query();
		$query->whereIn("id", $arr_id);
		$records = $query->get(['image']); //get records files to be deleted before delete
		$query->delete();
		foreach($records as $record){
			$this->deleteRecordFiles($record['image'], "image"); //delete file after record delete
		}
		return $this->respond($arr_id);
	}
}
