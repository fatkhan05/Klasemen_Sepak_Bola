<?php

namespace App\Http\Controllers;

use App\Models\DataClub;
use App\Models\DataKlasemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
        $data = DataKlasemen::get();
            return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){
					$btn = '<a href="javascript:void(0)" onclick="editForm('.$row->id_klasemen.')" style="margin-right: 5px;" class="btn btn-sm btn-primary "><i class="far fa-edit" style="font-size: 23px; margin-right: -1px; padding-top: 1px;"></i></a>';
					$btn .= '<a href="javascript:void(0)" onclick="deleteRow('.$row->id_klasemen.')" style="margin-right: 5px;" class="btn btn-sm btn-danger "><i class="fa fa-trash" style="font-size: 23px; margin-right: -1px; padding-top: 1px;"></i></a>';
					$btn .='</div></div>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
        }
        return view('home.main')->with('data');
    }

    public function form()
    {
        try {
            $data['club'] = DataClub::get();
            $content = view('home.form', $data)->render();
			return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => '','errMsg'=>$e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        return $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                // 'nama_club' => 'required',
                'score' => 'required|unique:data_club,score'
            ],
            [
                // 'required' => ':attribute Tidak Boleh Kosong',
                'unique' => 'Data Yang Anda Masukkan Sudah Ada Didalam Database'
            ]
        );
        $validator->setAttributeNames([
            'nama_club' => 'Nama Club',
            'score' => 'Score Club',
        ]);

        if($validator->fails()) {
            // $pesan = $validator->errors();
			// $pakai_pesan = join(',',$pesan->all());
			// $return = ['status' => 'warning', 'code' => 201, 'message' => $pakai_pesan];
			// return response()->json($return);
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        try {   
            DB::beginTransaction();

            $newdata = (!empty($request->id)) ? DataKlasemen::find($request->id) : new DataKlasemen;

            if($request->flexRadioDefault == 1) {
                # MULTIPLE INPUT
                for ($i = 0; $i < count($request->nama_club); $i++) {
                    $newdataMultiple = new DataKlasemen;
                    $newdataMultiple->club_id = $request->id;
                    $newdataMultiple->nama_club = $request->multiple_nama_club[$i];
                    $newdataMultiple->score = $request->multiple_score_club[$i];
                    $newdataMultiple->save();
                }
            } else {
                # SINGLE INPUT
                $newdata->nama_club = $request->single_nama_club;
                $newdata->score = $request->score;
                $newdata->save();
            }

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

    public function destroy($id)
    {
        //
    }
}
