<?php

namespace App\Http\Controllers;

use App\Models\DataClub;
use App\Models\DataKlasemen;
use App\Rules\UniqueScores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class KlasemenController extends Controller
{
    

    public function index(Request $request)
    {
        if ($request->ajax()) {
        $data = DataKlasemen::with('data_club')
                ->selectRaw('*, (menang * 3 + seri * 1 + kalah * 0) AS total_points')
                ->get();
            return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){
					$btn = '<a href="javascript:void(0)" onclick="editForm('.$row->id_klasemen.')" style="margin-right: 5px;" class="btn btn-sm btn-primary "><i class="far fa-edit" style="font-size: 23px; margin-right: -1px; padding-top: 1px;"></i></a>';
					$btn .= '<a href="javascript:void(0)" onclick="deleteRow('.$row->id_klasemen.')" style="margin-right: 5px;" class="btn btn-sm btn-danger "><i class="fa fa-trash" style="font-size: 23px; margin-right: -1px; padding-top: 1px;"></i></a>';
					$btn .='</div></div>';
					return $btn;
				})
                ->addColumn('total_point', function ($row) {
                    return [
                        'club' => $row->nama_club,
                        'matches' => $row->count(),
                        'wins' => $row->total_points / 3, // Menang = Poin / 3
                        'draws' => $row->total_points % 3, // Sisa poin setelah menang dibagi 3
                        'losses' => $row->count() - ($row->total_points / 3) - ($row->total_points % 3),
                        'goalsFor' => $row->menang,
                        'goalsAgainst' => $row->kalah,
                        'points' => $row->total_points,
                    ];
                })
				->rawColumns(['action'])
				->make(true);
            }
        return view('home.main')->with('data');
    }

    function calculatePoints($wins, $draws, $losses)
    {
        $points = ($wins * 3) + ($draws * 1) + ($losses + 0);
        
        return [
            'points' => $points,
            'wins' => $wins,
            'draws' => $draws,
            'losses' => $losses,
        ];
    }

    public function form(Request $request)
    {
        try {
            $data['data'] = (!empty(($request->id))) ? DataKlasemen::find($request->id) : "";
            $data['club'] = DataClub::get();
            // return $data;
            $content = view('home.form', $data)->render();
			return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => '','errMsg'=>$e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            // $rules = [
                // 'main_single_club' => 'unique:data_klasemen,main|required',
                // 'menang_single_club' => 'unique:data_klasemen,menang|required',
                // 'seri_single_club' => 'unique:data_klasemen,seri|required',
                // 'kalah_single_club' => 'unique:data_klasemen,kalah|required',
                // 'goal_menang_single_club' => 'unique:data_klasemen,goal_menang|required',
                // 'goal_kalah_single_club' => 'unique:data_klasemen,goal_kalah|required',
                'main_multiple_score_club' => ['required', new UniqueScores($request->id)],
                'menang_multiple_score_club' => ['required', new UniqueScores($request->id)],
                'seri_multiple_score_club' => ['required', new UniqueScores($request->id)],
                'kalah_multiple_score_club' => ['required', new UniqueScores($request->id)],
                'goal_menang_multiple_score_club' => ['required', new UniqueScores($request->id)],
                'goal_kalah_multiple_score_club' => ['required', new UniqueScores($request->id)],
            ],
            [
                'required' => 'Kolom :attribute harus diisi',
                'unique' => ':attribute sudah ada dalam database, Harap Masukkan Data Yang Lain'
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

            // $newdata = (!empty($request->id)) ? DataKlasemen::find($request->id) : new DataKlasemen;

            if(is_array($request->nama_club_multi_form)) {
                # MULTIPLE INPUT
                foreach ($request->id_club as $i => $club) {
                // for ($i = 0; $i < count($request->nama_club); $i++) {
                    // $newdataMultiple = new DataKlasemen;
                    $newdataMultiple = (!empty($request->id)) ? DataKlasemen::find($request->id) : new DataKlasemen;
                    $newdataMultiple->club_id = $request->nama_club_multi_form[$i];
                    $newdataMultiple->main = $request->main_multiple_score_club[$i];
                    $newdataMultiple->menang = $request->menang_multiple_score_club[$i];
                    $newdataMultiple->seri = $request->seri_multiple_score_club[$i];
                    $newdataMultiple->kalah = $request->kalah_multiple_score_club[$i];
                    $newdataMultiple->goal_menang = $request->goal_menang_multiple_score_club[$i];
                    $newdataMultiple->goal_kalah = $request->goal_kalah_multiple_score_club[$i];
                    $newdataMultiple->save();
                }
            } else if ($request->flexRadioDefault == '0') {
                # SINGLE INPUT
                if ($request->single_nama_club) {
                    $newdata = (!empty($request->id)) ? DataKlasemen::find($request->id) : new DataKlasemen;
                    $newdata->club_id = $request->single_nama_club;
                    $newdata->main = $request->main_single_club;
                    $newdata->menang = $request->menang_single_club;
                    $newdata->seri = $request->seri_single_club;
                    $newdata->kalah = $request->kalah_single_club;
                    $newdata->goal_menang = $request->goal_menang_single_club;
                    $newdata->goal_kalah = $request->goal_kalah_single_club;
                    $newdata->save();
                }
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

    public function destroy(Request $request) 
    {
        try {
            DataKlasemen::where('id_klasemen', $request->id)->delete();
	
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
