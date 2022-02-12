<?php

namespace App\Models\v1;

use App\Traits\ApiResponse;
use App\Traits\CustomMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Throwable;
use function abort;
use function app;

class BaseModel extends Model implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use Sluggable;
    use ApiResponse;

    use CustomMedia;
    use InteractsWithMedia;

    public function sluggable(): array
    {
        return [];
    }

    protected function storeRequest($data, $model = null)
    {
        try {
            DB::beginTransaction();

            $response = $this->storeOrUpdate($data, $model);

            DB::commit();

        } catch (Throwable $e) {
            DB::rollBack();

            return $this->errorResponse(['exception' => $e]);
        }
        return $this->success($response);
    }

    public function storeOrUpdate($data, $model)
    {
        if ($model):

            $model->update($data);

            $message = 'Registro actualizado correctamente';

        else:

            $model = BaseModel::create($data);

            $message = 'Registro creado correctamente';

        endif;

        return compact('message', 'model');
    }
    public function errorResponse($params = [])
    {
        $message = $params['message'] ?? '¡Ocurrió un error!';

        if (app()->environment('local')) :

            $exception = $params['exception']->getMessage() ?? null;
            $message = $exception ? $message . ' :: ' . $exception : $message;

        endif;

        return abort($this->errorServerResponse($message));
    }

    public function errorServerResponse($message)
    {
        return abort(response()->json(compact('message'), 500));
    }
}
