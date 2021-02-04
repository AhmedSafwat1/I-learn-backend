<?php

namespace Modules\Learn\Repositories\Dashboard;

use Modules\Learn\Entities\Subject as Model;
use Hash;
use DB;

class SubjectRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->get();
    }

    public function getStatistics()
    {
        $count  =$this->model->count();
        return ["count" => $count];
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        return $this->model->orderBy($order, $sort)->get();
    }

    public function findById($id)
    {
        
        return $this->model->withDeleted()->find($id);
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            $image = $request->image ? pathFileInStroage($request, "image", "subjects") : "/uploads/default.png";
            $model = $this->model->create([
            'status'         => $request->status ? 1 : 0,
            'color'          => $request->color,
            "image"          => $image,
           
          ]);

            $this->translateTable($model, $request);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $model = $this->findById($id);
      
        $restore = $request->restore ? $this->restoreSoftDelte($model) : null;
        $image =   $model->image;
        if ($request->image) {
            deleteFileInStroage($model->image);
            $image = pathFileInStroage($request, "image", "subjects");
        }

        try {
         

            $model->update([
              'status'         => $request->status ? 1 : 0,
              'color'          => $request->color,
              "image"          => $image

              ]);
             

            $this->translateTable($model, $request);
          
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title           = $value;
            $model->translateOrNew($locale)->description     = $request['description'][$locale];
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $model = $this->findById($id);

            if ($model->trashed()):
              deleteFileInStroage($model->image);
            $model->forceDelete(); else:
              $model->delete();
            endif;

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {
            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->model->withDeleted()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%'. $request->input('search.value') .'%');

            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('translations', function ($query) use ($request) {
                    $query->where('description', 'like', '%'. $request->input('search.value') .'%');
                    $query->orWhere('title', 'like', '%'. $request->input('search.value') .'%');
                  
                });
            });
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Sections by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('created_at', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('created_at', '<=', $request['req']['to']);
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only') {
            $query->onlyDeleted();
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with') {
            $query->withDeleted();
        }

        if (isset($request['req']['status']) &&  $request['req']['status'] == '1') {
            $query->active();
        }

        if (isset($request['req']['status']) &&  $request['req']['status'] == '0') {
            $query->unactive();
        }

        return $query;
    }
}
