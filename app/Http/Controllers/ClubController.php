<?php

namespace App\Http\Controllers;

use App\Models\DataClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ClubController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
        $data = DataClub::get();
            return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){
					$btn = '<a href="javascript:void(0)" onclick="editForm('.$row->id_club.')" style="margin-right: 5px;" class="btn btn-sm btn-primary "><i class="far fa-edit" style="font-size: 23px; margin-right: -1px; padding-top: 1px;"></i></a>';
					$btn .= '<a href="javascript:void(0)" onclick="deleteRow('.$row->id_club.')" style="margin-right: 5px;" class="btn btn-sm btn-danger "><i class="fa fa-trash" style="font-size: 23px; margin-right: -1px; padding-top: 1px;"></i></a>';
					$btn .='</div></div>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
        }
        return view('mst_club.main')->with('data');
    }

    public function form(Request $request)
    {
        try {
            $data['data'] = (!empty($request->id)) ? DataClub::find($request->id) : "";
            $content = view('mst_club.form', $data)->render();
			return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => '','errMsg'=>$e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'nama_club' => 'required',
                'kota_club' => 'required',
            ],
            [
                'required' => 'Kolom :attribute wajib diisi'
            ]
        );

        if($validator->fails()) {
            $pesan = $validator->errors();
			$pakai_pesan = join(',',$pesan->all());
			$return = ['status' => 'warning', 'code' => 201, 'message' => $pakai_pesan];
			return response()->json($return);
        }

        try {
            DB::beginTransaction();

            $newdata = (!empty($request->id)) ? DataClub::find($request->id) : new DataClub;
            $newdata->nama_club = $request->nama_club;
            $newdata->kota_club = $request->kota_club;
            $newdata->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Data Berhasil Disimpan !',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request) 
    {
        try {
            DataClub::where('id_club', $request->id)->delete();
	
			return response()->json([
				'success' => 'Data Berhasil Dihapus'
			]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
				'error' => 'Terjadi kesalahan, silahkan coba lagi'
			]); 
        }
    }
}
