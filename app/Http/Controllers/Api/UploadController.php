<?php

	namespace App\Http\Controllers\Api;
	use App\Http\Controllers\Controller;
	use App\Models\Option;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;


	class UploadController extends Controller
	{
		public function uploadLogo(Request $request)
    	{
			$logo = $request->file('logo')->store('logo', 'public');
			DB::table("options")->where("clave","=","logo")->update(["valor" => $logo]);
			return response()->json([
	            'success' => true,
	            'new_logo' => $logo,
	            'msg' => 'Logo Actualizado con Exito'
	        ]);
		}

	}