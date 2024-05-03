<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserAccountEditRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
class UsersController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */


    function index(Request $request, $fieldname = null, $fieldvalue = null)
    {
        // Check if the authenticated user is admin (user ID 1)
        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        $query = User::query();

        // Add search functionality
        if ($request->search) {
            $search = trim($request->search);
            User::search($query, $search);
        }

        // Define order by fields
        $orderby = $request->orderby ?? "users.id";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);

        // Apply additional field-based filtering if provided
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue);
        }

        // Paginate the results
        $records = $this->paginate($query, User::listFields());

        // Return the paginated records
        return $this->respond($records);
    }


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = User::query();
		$record = $query->findOrFail($rec_id, User::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(UserAddRequest $request){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

		$modeldata = $request->validated();

		if( array_key_exists("avatar", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['avatar'], "avatar");
			$modeldata['avatar'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);

		//save Users record
		$record = User::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(UserEditRequest $request, $rec_id = null){

        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
		$query = User::query();

		$record = $query->findOrFail($rec_id, User::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();

		if( array_key_exists("avatar", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['avatar'], "avatar");
			$modeldata['avatar'] = $fileInfo['filepath'];
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
		$query = User::query();
		$query->whereIn("id", $arr_id);
		$records = $query->get(['avatar']); //get records files to be deleted before delete
		$query->delete();
		foreach($records as $record){
			$this->deleteRecordFiles($record['avatar'], "avatar"); //delete file after record delete
		}
		return $this->respond($arr_id);
	}
}
