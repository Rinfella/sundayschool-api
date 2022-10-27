<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use App\Models\User;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::with([
            'bialtu' => function($q) {
                $q->select('id', 'name');
            }
        ])->get();
        $viewData = [
            'areas' => $areas
        ];

        return view('areas.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elders = User::select([
            'id',
            'name',
            'fathers_name',
        ])->get();

        return view('areas.create', [
            'elders' => $elders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAreaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        try {
            Area::create($request->all());
            return redirect('/admin/areas')->with('messageSuccess', 'Created Successfully');
        } catch (\Throwable $th) {
            return redirect('/areas/create')->with('messageError', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        // $area = Area::findOrFail($id);
        // return view('areas.show', ['area' => $area]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $elders = User::select([
            'id',
            'name',
            'fathers_name',
        ])->get();

        return view('areas.edit', [
            'elders' => $elders,
            'area' => $area,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAreaRequest  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $area->name = $request->input('name');
        $area->person_in_charge = $request->input('person_in_charge');
        $area->save();

        return redirect('/admin/areas/')->with('messageSuccess', $area->name . '  Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect('/admin/areas')->with('messageSuccess', $area->name. '  Deleted Successfully');
    }
}
