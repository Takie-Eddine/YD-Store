<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name' , 'parent_id' , 'description' , 'image' , 'status' , 'slug'
    ];




    public function scopeActive(Builder $builder){
        $builder->where('status','=' ,'active');
    }

    public function scopeFilter(Builder $builder,$filters){


        $builder->when($filters['name'] ?? false,function ($builder,$value){
            $builder->where('categories.name','LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false,function ($builder,$value){
            $builder->where('categories.status','=', $value);
        });


        // if ($filters['name'] ?? false) {
        //     $builder->where('name','LIKE', "%{$filters['name']}%");
        // }
        // if ($filters['status'] ?? false) {
        //     $builder->where('status','=', $filters['status']);
        // }
    }



    public function getImageUrlAttribute(){

        if(!$this->image){
            return 'https://icphso.org/global_graphics/default-store-350x350.jpg';
        }

        if (Str::startsWith($this->image,['http://' , 'https://'])) {
            return $this->image;
        }

        return asset('storage/' .$this->image);

    }



    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id','id')
        ->withDefault([
            'name' => '__'
        ]);
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }


    public function products(){
        return $this->hasMany(Product::class , 'category_id' , 'id');
    }
}
