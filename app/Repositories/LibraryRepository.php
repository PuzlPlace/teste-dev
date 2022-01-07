<?php

namespace App\Repositories;

use App\Models\Library;

class LibraryRepository
{
    /**
     * @var Library $model
     */
    private Library $model;

    /**
     * Construct Library Model Repository
     */
    public function __construct()
    {
        $this->model = new Library;
    }

    /**
     * @return LibraryRepository
     */
    public static function make(): LibraryRepository
    {
        return new static(new LibraryRepository());
    }

    /**
     * @return mixed
     */
    public function pagination()
    {
        return $this->model->paginate(5);
    }

    /**
     * @param Library $library
     * @return bool
     */
    public function store(Library $library): bool
    {
        $this->model = $library;
        return $this->model->save();
    }

    /**
     * @param $library_id
     * @return mixed
     */
    public function getById($library_id)
    {
        return $this->model->findOrFail($library_id);
    }

    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function update($id, $request)
    {
        $library = $this->model->findOrFail($id);
        return $library->fill($request->all())->save();
    }

    public function destroy($id)
    {
        $library = $this->model->findOrFail($id);
        return $library->delete();
    }

}