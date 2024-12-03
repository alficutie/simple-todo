<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Banyak data yang ditampilkan
        $max_data = 5;
        
        if(request('search')) {
            // memfilter data dari kolom search
            $data = Todo::where('task', 'like', '%'.request('search').'%')->paginate($max_data)->withQueryString();
        } else {
            // menampilkan semua data, dari terbaru sampai terlama, paginate (membatasi)
            $data = Todo::orderBy('id', 'desc')->paginate($max_data);
        }

        // resources/todo/app.blade.php
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'task' => 'required|min:5|max:100'
        ], [
            'task.required' => 'Wajib diisi!',
            'task.min' => 'Minimal 5 karakter!',
            'task.max' => 'Maksimal 100 karakter!',
        ]);

        // Menyimpan input 'task' ke array 'data'
        $data = [
            'task' => $request -> input('task')
        ];

        // Pembuatan data baru
        Todo::create($data);
        // Redirect setelah berhasil
        return redirect()->route('todo.index')->with('success', 'Berhasil menambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi input
        $request->validate([
            'task' => 'required|min:5|max:100'
        ], [
            'task.required' => 'Wajib diisi!',
            'task.min' => 'Minimal 5 karakter!',
            'task.max' => 'Maksimal 100 karakter!',
        ]);

        // Menyimpan input 'task' dan 'is_done' ke array 'data'
        $data = [
            'task' => $request -> input('task'),
            'is_done' => $request -> input('is_done'),
        ];

        // Mencari data dari id lalu update
        Todo::where('id', $id)->update($data);
        // Redirect setelah berhasil
        return redirect()->route('todo.index')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data dari id lalu delete
        Todo::where('id', $id)->delete();
        // Redirect setelah berhasil
        return redirect()->route('todo.index')->with('success', 'Berhasil menghapus data');
        
    }
}
