<?php

namespace App\Http\Controllers;

use App\Models\portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $portofolios = portofolio::all();
        return view('portofolio.index', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('portofolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'contribution' => ['required', 'string', 'max:45'],
            'description' => ['string', 'max:400'],
            'place' => ['required', 'string', 'max:150'],
            'certificate' => ['image', 'max:160']
        ]);
        $originName = $request->file('certificate')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('certificate')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('certificate')->storeAs(
            'public/pictures',
            $fileName
        );
        portofolio::create([
            'student_id' => auth()->user()->id,
            'title' => $request->title,
            'contribution' => $request->contribution,
            'description' => $request->description,
            'place' => $request->place,
            'certificate' => $fileName
        ]);
        return redirect(route('portofolio.index'))->withMessage(['status' => 'success', 'message' => 'Portofolio berhasil dibuat!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(portofolio $portofolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(portofolio $portofolio)
    {

        return view('portofolio.edit', [
            'portofolio' => $portofolio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, portofolio $portofolio)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'contribution' => ['required', 'string', 'max:45'],
            'description' => ['string', 'max:400'],
            'place' => ['required', 'string', 'max:150'],
            'certificate' => ['image', 'max:160'],
        ]);
        if (isset($request->certificate)) {
            $originName = $request->file('certificate')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('certificate')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('certificate')->storeAs(
                'public/pictures',
                $fileName
            );
            $portofolio->certificate = $fileName;
        }
        $portofolio->title = $request->title;
        $portofolio->contribution = $request->contribution;
        $portofolio->description = $request->description;
        $portofolio->place = $request->place;

        $portofolio->save();

        return redirect(route('portofolio.index'))->withMessage(['status' => 'success', 'message' => 'Portofolio berhasil diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(portofolio $portofolio)
    {
        portofolio::destroy($portofolio->id);
        return redirect(route('portofolio.index'))->withMessage(['status' => 'success', 'message' => 'Portofolio berhasil dihapus!']);
    }
}