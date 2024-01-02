<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Models\Kategorien;


class DangerController extends Controller
{
	public function insert(Request $r){

		$session = Session::getId();


		$check = DB::table("current_danger")->where("session",$session)->first();

		if ($check) {
			DB::table("current_danger")->where("session",$session)->update([
				'options' => $r->options,

			]);

		}
		else{

			DB::table("current_danger")->insert([

				'options' => $r->options,
				'session' => Session::getId(),


			]);
		}


		return redirect("admin/step2");

		

	}

	public function step2(){

		$data['category'] = Kategorien::get();

		return view('admin.risk-assessment.step2',$data);


	}




	public function insert2(Request $r){

		$session = Session::getId();

		$cat = $r->category;


		$check = DB::table("current_category")->where("cat_id",$cat)->where("session",$session)->first();

		if ($check) {



		}
		else{

		

			for ($i=0; $i < count($cat); $i++) { 
				DB::table("current_category")->insert([

					'cat_id' => $cat[$i],
					'session' => Session::getId(),


				]);
			}

			
		}


		return redirect("admin/step3");



		

	}




	public function step3(){

		$session = Session::getId();

		$data['category'] = DB::table("current_category")
		->join('kategoriens','kategoriens.id','current_category.cat_id')
		->select("current_category.*",'kategoriens.danger','kategoriens.photo','kategoriens.id as katid')
		->where("current_category.session",$session)
		->first();


		$data['category2'] = DB::table("current_category")
		->join('kategoriens','kategoriens.id','current_category.cat_id')
		->select("current_category.*",'kategoriens.danger','kategoriens.photo','kategoriens.id as katid')
		->where("current_category.session",$session)
		->skip(1)
		->limit(100)
		->get();

		return view('admin.risk-assessment.step3',$data);


	}

	// public function insert3(Request $r){

	// 	dd($r->all());
	// }

	public function insert3(Request $request)
{
    
    $data = $request->input('tabs', []);

    dd($data);

    $firstTabCheckboxes = isset($data['tab11']) ? $data['tab11'] : [];

    dd($firstTabCheckboxes);

}


	
}
