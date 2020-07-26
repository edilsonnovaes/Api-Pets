<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetCollection;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Http\Requests\PetRequest;
use App\Http\Resources\Pet as PetResource;

class PetController extends Controller
{

    public function __construct(Pet $pet)
    {
        $this->model = $pet;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = $this->model->all();

        $petsCollection = new PetCollection($pets);
        return response()->json($petsCollection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        try {

            $pet = new Pet();
            $pet->fill($request->all());
            $pet->save();
    
            $petResource = new PetResource($pet);
    
            return response()->json($petResource, 201);
        }
        catch(\Exception $e){
            
            return response()->json([
                'title' => 'Erro ',
                'msg'  => 'erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return response()->json(new PetResource($pet), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetRequest $request, Pet $pet)
    {
        $pet->fill($request->all());
        $pet->save();

        return response()->json(new PetResource($pet), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //dd($id);
            $pet = $this->model->find($id);
            $pet->delete();

            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
