<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\support\facades\validator;
use App\kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::all();
        if (count($kategori) <= 0) {
            $response = [
                'success' =>false,
                'data' => 'Empty',
                'massage' =>'Kategori Tidak Ada'
            ];
            return response()->json($response,404);
        }
        $response = [
                'success' =>true,
                'data' => $kategori,
                'massage' =>'Kategori Berhasil di munculkan.'
            ];
            return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1. tampung semua inputan ke $inputan
          $input = $request->all();
        //2. buat validasi di tampung ke $validator
        $validator = Validator::make($input,[
            'nama_kategori' => 'required'
        ]);
        //3. cek validasi
        if ($validator->fails()) {
            $response = [
              'success' =>false,
                'data' => 'validator error',
                'massage' =>$validator->error()
            ];
            return response()->json($response,404);

        }
        //4. buat fungsi untuk menghandle semua inputan ->
        //dimasukan ke table
        $kategori = kategori::create($input);
       //5.menampilkan response
          $response = [
                'success' =>true,
                'data' => $kategori,
                'massage' =>'berhasil.'
            ];
            //6.tampilkan berhasil
            return response() ->json($response,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = kategori::find($id);
        if (!$kategori) {
            $response = [
                'success' =>false,
                'data' => 'Empty',
                'massage' =>'Kategori tidak di temukan'
            ];
            return response() ->json($response,404);
        }
        $response = [
                'success' =>true,
                'data' => $kategori,
                'massage' =>$kategori->nama_kategori.' berhasil ditampilkan.'
            ];
            return response() ->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $kategori = kategori::find($id);
          $input = $request->all();
            if (is_null($kategori)) {
            $response = [
                'success' =>false,
                'data' => 'Empty',
                'massage' =>'kategori tidak di temukan'
            ];
            return response() ->json($response,404);
        }
         $validator = Validator::make($input,[
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
              'success' =>false,
                'data' => 'validator error',
                'massage' =>$validator->error()
            ];
            return response()->json($response,500);

        }
        $kategori->nama_kategori = $input['nama_kategori'];
        $kategori->slug = $input['slug'];
        $kategori->save();
        $response = [
                'success' =>true,
                'data' => $kategori,
                'massage' =>'berhasil.'
            ];
            return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = kategori::find($id);
          if (!$kategori) {
            $response = [
                'success' =>false,
                'data' => 'gagal menghapus',
                'massage' =>'kategori tidak di temukan.'
            ];
            return response() ->json($response,404);
        }
           $kategori->delete();
             $response = [
                'success' =>true,
                'data' => $kategori,
                'massage' => $kategori->nama_kategori.' berhasil dihapus.'
            ];
            return response()->json($response,200);
    }
}
