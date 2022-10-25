<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# -- 
use View;
use App\Models\Book as Model;
# --  


class BooksController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = Model::class;
    }

    public function index()
    {
        $get = $this->model::query();

        if (request()->category) {
            $get->where('category', request()->category);
        }

        if (request()->type) {
            $get->where('type', request()->type);
        }

        if (request()->name) {
            $get->where('name', request()->name);
        }

        return response()->json($get->paginate(15)->appends(request()->query())->toArray());
    }
    public function store(Request $request)
    {
        # Init transaction
        \DB::beginTransaction();

        try {

            # Validate Form
            request()->validate($this->model::$rules, \Lang::get('validation'));

            # Store
            $content = $this->model::create(request()->all());

            # Response
            $response = [
                'message'  => 'Operação realizada com sucesso!',
                'code' => 200,
            ];

            # Commit
            \DB::commit();
        } catch (\Illuminate\Validation\ValidationException $e) {

            # Rollback
            \DB::rollback();

            # Response
            $response = [
                'message' => $e->errors(),
                'code' => 500,
            ];
        } catch (\Exception $e) {
            # Response
            $response = [
                'message' => $e->getMessage(),
                'code' => 500,
            ];

            # Rollback
            \DB::rollback();
        }

        # end
        return response()->json($response)->setStatusCode($response['code']);
    }
    public function show($id)
    {
        $item = $this->model::find($id);
        return response()->json($item);
    }
    public function update($id, Request $request)
    {
        $item = $this->model::find($id);
        $item->update(request()->all());
        return response()->json('$this->model updated!');
    }
    public function destroy($id)
    {
        $item = $this->model::find($id);
        $item->delete();
        return response()->json('$this->model deleted!');
    }

    public function report()
    {
        $get = \DB::table('books');

        $get->select(
            \DB::raw("(COUNT(*)) as as_total"),
            \DB::raw("(sum(case when deleted_at is null then 1 else 0 end)) as as_non_deleted"),
            \DB::raw("(sum(case when deleted_at is not null then 1 else 0 end)) as as_deleted"),
        );

        if (request()->category != 'all') {
            $get->where('category', request()->category);
        }

        if (request()->type != 'all') {
            $get->where('type', request()->type);
        }

        # [Start date]
        $start_date = (request()->start_date === null) ? null : request()->start_date;
        $end_date = (request()->end_date === null) ? null : request()->end_date;
        if ($start_date or $end_date) {

            $start = (!$start_date) ? \Carbon\Carbon::now()->format('Y-m-d') : \Carbon\Carbon::createFromFormat('Y-m-d', $start_date)->format('Y-m-d');
            $end = (!$end_date) ? \Carbon\Carbon::now()->format('Y-m-d') : \Carbon\Carbon::createFromFormat('Y-m-d', $end_date)->format('Y-m-d');
            $get->whereBetween('created_at', [$start, $end]);
        }
        return response()->json($get->first());
    }
}
