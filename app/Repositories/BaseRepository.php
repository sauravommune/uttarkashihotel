<?php
namespace App\Repositories;

use App\Models\Images;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository {
    public function saveImages(Model $model,array|string|null $images){
        $row = [];
        $images = is_array($images) ? $images : [$images];
        foreach($images as $key => $image){
            $row[$key]['imageable_id'] = $model->id;
            $row[$key]['imageable_type'] = $model::class;
            $row[$key]['image'] = $image;
            $row[$key]['created_at'] = now();
            $row[$key]['updated_at'] = now();
        }
        
        Images::insert($row);
    }


    public function saveHotelImages(Model $model,array|string|null $images,$altTag=null,$imageName){

        $row = [];
        $images = is_array($images) ? $images : [$images];
        foreach($images as $key => $image){
            $row[$key]['imageable_id'] = $model->id;
            $row[$key]['imageable_type'] = $model::class;
            $row[$key]['image'] = $image;
            $row[$key]['alt_tag'] = $altTag[$key]??"";
            $row[$key]['image_name'] = $imageName[$key]??"";
            $row[$key]['created_at'] = now();
            $row[$key]['updated_at'] = now();
        }
        
        Images::insert($row);
    }
}