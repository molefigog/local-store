<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingAddRequest;
use App\Http\Requests\SettingEditRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
class SettingsController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
		$query = Setting::query();
		if($request->search){
			$search = trim($request->search);
			Setting::search($query, $search);
		}
		$orderby = $request->orderby ?? "settings.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Setting::listFields());
		return $this->respond($records);
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Setting::query();
		$record = $query->findOrFail($rec_id, Setting::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(SettingAddRequest $request){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

		$modeldata = $request->validated();

		if( array_key_exists("logo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['logo'], "logo");
			$modeldata['logo'] = $fileInfo['filepath'];
		}

		if( array_key_exists("favicon", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['favicon'], "favicon");
			$modeldata['favicon'] = $fileInfo['filepath'];
		}

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}

		//save Settings record
		$record = Setting::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(SettingEditRequest $request, $rec_id = null){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

		$query = Setting::query();
		$record = $query->findOrFail($rec_id, Setting::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();

		if( array_key_exists("logo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['logo'], "logo");
			$modeldata['logo'] = $fileInfo['filepath'];
		}

		if( array_key_exists("favicon", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['favicon'], "favicon");
			$modeldata['favicon'] = $fileInfo['filepath'];
		}

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
		$arr_id = explode(",", $rec_id);
		$query = Setting::query();
		$query->whereIn("id", $arr_id);
		$records = $query->get(['logo','favicon','image']); //get records files to be deleted before delete
		$query->delete();
		foreach($records as $record){
			$this->deleteRecordFiles($record['logo'], "logo"); //delete file after record delete
			$this->deleteRecordFiles($record['favicon'], "favicon"); //delete file after record delete
			$this->deleteRecordFiles($record['image'], "image"); //delete file after record delete
		}
		return $this->respond($arr_id);
	}
}
