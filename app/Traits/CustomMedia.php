<?php

namespace App\Traits;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait CustomMedia
{
    public function getFirstMediaToForm($collection, $field = null)
    {
        $resource = $this->getFirstMedia($collection);

        $field = $field ?? $collection;
        $field_key = $this->getMediaFieldKey($field);

        $this->$field = $resource ? $resource->getFullUrl() : '';
        $this->$field_key = $resource->id ?? null;
    }

    public function setMediaCollection($data, $field, $model = null)
    {
        $model = $model ?? $this;
        $title = $model->title ?? $model->name ?? 'Gestor';
        $collection = $field;
        $field_key = $this->getMediaFieldKey($field);

        // si viene el id del recurso
        if ( ! empty($data[$field_key]) )
        {
            $id = $data[$field_key];

            $resource = $model->getFirstMedia($collection);

            // si el id es el mismo que el actual, es el mismo archivo
            if ( $resource AND ($resource->id == $id) )
            {
                // si el nombre del modelo es distinto al del recurso, se actualiza
                if ($resource->name != $title)
                    $resource->update(['name' => $title]);

                return true;
            }

            // si el id es distinto, se copia el archivo a la colección del modelo
            $resource_selected = Media::findOrFail($id);

            return $resource_selected->copy($model, $collection);
        }

        // si viene un archivo en el request, se agrega a la colección
        if ( ! empty($data[$field]) )
        {
            return $model->addMedia($data[$field])->usingName($title)->toMediaCollection($collection);
        }

        // si viene un archivo en base 64, se agrega a la colección
        if ( ! empty($data[$field . '_64']) )
        {
            return $model->addMediaFromBase64($data[$field .'_64'])->usingName($title)->toMediaCollection($collection);
        }

        // si no viene id ni archivo en el request, se elimina el recurso actual
        $resource = $model->getFirstMedia($collection);

        if ($resource)
            return $resource->delete();

        return false;
    }

    protected function getMediaFieldKey($field, $key = 'id')
    {
        return "{$field}_{$key}";
    }
}
