<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailSettingAddRequest;
use App\Http\Requests\MailSettingEditRequest;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
class MailSettingsController extends Controller
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
		$query = MailSetting::query();
		if($request->search){
			$search = trim($request->search);
			MailSetting::search($query, $search);
		}
		$orderby = $request->orderby ?? "mail_settings.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, MailSetting::listFields());
		return $this->respond($records);
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = MailSetting::query();
		$record = $query->findOrFail($rec_id, MailSetting::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(MailSettingAddRequest $request){
        if (Auth::check() && Auth::user()->id !== 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
		$modeldata = $request->validated();
		$modeldata['mail_password'] = bcrypt($modeldata['mail_password']);

		//save MailSettings record
		$record = MailSetting::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(MailSettingEditRequest $request, $rec_id = null){
		$query = MailSetting::query();
		$record = $query->findOrFail($rec_id, MailSetting::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
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
		$query = MailSetting::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
