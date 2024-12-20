<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Folder;

class AppController extends Controller
{
    //
	public function index(){
		return view('app/index');
	}
	
	public function post(Request $request)
	{
		//バリデーションチェックを行う		
		$request->validate(Log::$rules);

		//画像名を決める
		date_default_timezone_set("Asia/Tokyo");
		$date	=	date("Y_m_d");
		$time	=	date("_His");
		$imageName =	$date.$time.'.'.$request->image->extension();

		//フォルダの有無を調べる
		//$folder_is_exist	=	Folder::where('name',$date)->exists();
		$folder_path 	=	'images/'.$date;
		$folder_is_exist	=	file_exists(public_path().'/'.$folder_path);
		if($folder_is_exist == false){
			mkdir(
				public_path().'/'.$folder_path,
				0777,
			);
			//$folder = new Folder;
			//$folder->name = $folder_path;
			//$folder->amount = 0; 
		}

		//画像を保存する
		$request->image->move($folder_path,$imageName);

		//リクエストから各データを取り出し、インスタンスに追加する。
		$log = new Log;	
    		$log->name = $imageName;
		$log->path = $folder_path.'/'.$imageName;
    		$log->description = $request->description;
    		$log->judgment = $request->judgment;
    		$log->save();

		$datas = array(
			'isSent'	=>	true,
			'data1'		=>	$imageName,
			'data2'		=>	$folder_path.'/'.$imageName,
			'data3'		=>	$request->description,
			'data4'		=>	$request->judgment,
			'data5'		=>	$folder_is_exist,
		);


		return view('app/post',$datas);
	}

	public function search_all(Request $request)
	{

		$logs = Log::all();


		$data = array(
			"method" 	=> 	$request->method,
			"q"		=>	$request->q,
			"logs"		=>	$logs,
		);

		return view('app/result',$data);
	}

	public function search_date(Request $request)
	{
		$logs = Log::whereDate('created_at',$request->q)->get();


		$data = array(
			"method" 	=> 	$request->method,
			"q"		=>	$request->q,
			"logs"		=>	$logs,
		);

		return view('app/result',$data);
	}

	public function search_range(Request $request)
	{
		$logs = Log::whereBetween('created_at',[$request->q1,$request->q2])->get();


		$data = array(
			"method" 	=> 	$request->method,
			"q"		=>	$request->q1." | ".$request->q2,
			"logs"		=>	$logs,
		);

		return view('app/result',$data);
	}

	public function search_judgment(Request $request)
	{
		$logs = Log::where('judgment',$request->q)->get();


		$data = array(
			"method" 	=> 	$request->method,
			"q"		=>	$request->q,
			"logs"		=>	$logs,
		);

		return view('app/result',$data);
	}
	
	public function test(Request $request) 
	{
		return $request;
	}

}
