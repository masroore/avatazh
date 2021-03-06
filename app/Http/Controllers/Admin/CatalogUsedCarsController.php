<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CatalogUsedCarsRequest;
use App\Http\Controllers\Controller;
use App\CatalogUsedCar;
use Intervention\Image\Facades\Image as ImageInt;

class CatalogUsedCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.catalogusedcars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalogusedcars.create_edit');
    }

    /**
     * @param CatalogUsedCarsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogUsedCarsRequest $request)
    {
        $request->request->remove('id_mark');
        $request->request->remove('id_model');

        $images = [];

        if ($request->hasFile('image')) {
            $small_path = public_path() . '/uploads/usedcars/small/';
            $big_path = public_path() . '/uploads/usedcars/big/';
            $file = $request->file('image');

            foreach ($file as $f) {
                $filename = str_random(20) . '.' . $f->getClientOriginalExtension() ? : 'png';
                $img = ImageInt::make($f);

                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($small_path . $filename);

                $img->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($big_path . $filename);

                $images[] = ['small' => $small_path . $filename, 'big' => $big_path . $filename, 'name' => $f->getClientOriginalName()];
            }
        }

        $catalogUsedCar = CatalogUsedCar::create($request->except('_token'));
        $catalogUsedCar->image = !empty($images) ? serialize($images) : '';
        $catalogUsedCar->save();

        return redirect('admin/catalogusedcars')->with('success', 'Новое меню добавлено успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * @param CatalogUsedCar $catalogusedcar
     * @return $this
     */
    public function edit(CatalogUsedCar $catalogusedcar)
    {
        return view('admin.catalogusedcars.create_edit')->with(compact('catalogusedcar'));
    }

    /**
     * @param CatalogUsedCarsRequest $request
     * @param CatalogUsedCar $catalogUsedCar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogUsedCarsRequest $request, CatalogUsedCar $catalogUsedCar)
    {
        $request->request->remove('id_mark');
        $request->request->remove('id_model');

       // if (!empty($file)) {
        //    CatalogUsedCar::where()
      //  }

        $images = [];

        if ($request->hasFile('image')) {
            foreach(unserialize($catalogUsedCar->image) as $image) {
                if (file_exists($image['small'])) @unlink($image['small']);
                if (file_exists($image['big'])) @unlink($image['big']);
            }

            $small_path = public_path() . '/uploads/usedcars/small/';
            $big_path = public_path() . '/uploads/usedcars/big/';
            $file = $request->file('image');

            foreach ($file as $f) {
                $filename = str_random(20) . '.' . $f->getClientOriginalExtension() ? : 'png';
                $img = ImageInt::make($f);

                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($small_path . $filename);

                $img->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($big_path . $filename);

                $images[] = ['small' => $small_path . $filename, 'big' => $big_path . $filename, 'name' => $f->getClientOriginalName()];
            }
        }

        $catalogUsedCar->mark = trim($request->input('mark'));
        $catalogUsedCar->model = trim($request->input('model'));
        $catalogUsedCar->price = trim($request->input('price'));
        $catalogUsedCar->year = $request->input('year');
        $catalogUsedCar->mileage = trim($request->input('mileage'));
        $catalogUsedCar->gearbox = $request->input('gearbox');
        $catalogUsedCar->drive = $request->input('drive');
        $catalogUsedCar->engine_type = $request->input('engine_type');
        $catalogUsedCar->power = trim($request->input('power'));
        $catalogUsedCar->body = $request->input('body');
        $catalogUsedCar->wheel = $request->input('wheel');
        $catalogUsedCar->color = $request->input('color');
        $catalogUsedCar->salon = $request->input('salon');
        $catalogUsedCar->meta_title = trim($request->input('meta_title'));
        $catalogUsedCar->meta_keywords = trim($request->input('meta_keywords'));
        $catalogUsedCar->meta_description = trim($request->input('meta_description'));
        $catalogUsedCar->description = trim($request->input('description'));
        if (!empty($images)) $catalogUsedCar->image = serialize($images);
        $catalogUsedCar->published = 0;

        if ($request->input('published')) {
            $catalogUsedCar->published = 1;
        }

        $catalogUsedCar->updated_at = \Carbon::now();
        $catalogUsedCar->save();

        return redirect('admin/catalogusedcars')->with('success', $catalogUsedCar->id . 'спешно обнавлен');
    }

    /**
     * @param Request $request
     * @param CatalogUsedCar $catalogUsedCar
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogUsedCar $catalogUsedCar)
    {
        if ($request->ajax()) {
            $catalogUsedCar->delete();
            return response()->json(['success' => 'Меню успешно удалено']);
        } else {
            return 'Вы не можете продолжить операцию удаления';
        }
    }
}
