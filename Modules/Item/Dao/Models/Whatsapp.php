<?php

namespace Modules\Item\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\Item\Dao\Enums\templateType;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;
use Kirschbaum\PowerJoins\PowerJoins;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use PHPUnit\TextUI\Help;

class Whatsapp extends Model
{
    use PowerJoins;

    protected $table = 'whatsapp';
    protected $primaryKey = 'wa_id';

    protected $fillable = [
        'wa_id',
        'wa_name',
        'wa_template_id',
        'wa_status',
        'wa_image',
        'wa_user_id',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'wa_name' => 'required',
        'wa_template_id' => 'required',
    ];

    protected $casts = [
        'wa_status' => 'integer',
    ];

    public $searching = 'wa_status';
    public $datatable = [
        'wa_id' => [false => 'Code', 'width' => 50],
        'name' => [true => 'Name'],
        'template_name' => [true => 'Template Name'],
        'wa_template_id' => [false => 'Description'],
        'wa_image' => [false => 'Image'],
        'wa_name' => [true => 'Nama Whatsapp'],
        'wa_status' => [true => 'Status'],
    ];

    public function mask_name()
    {
        return 'wa_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function has_template()
    {
        return $this->hasone(Template::class, 'template_id', 'wa_template_id');
    }

    public function has_user()
    {
        return $this->hasone(User::class, 'id', 'wa_user_id');
    }


    public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {

            $file = 'file';
            if (request()->has($file)) {
                // $image = $model->wa_image;
                // if ($image) {
                //     Helper::removeImage($image, Helper::getTemplate(__CLASS__));
                // }

                $file = request()->file($file);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->wa_image = $name;
            }

            if(!empty($model->wa_user_id) && $model->wa_user_id != 0){

                $user = User::find($model->wa_user_id);
                $phone = $user->phone ?? '';
                $name = $user->name ?? '';
                $template = $content = $gambar = null;

                $template = $model->has_template;

                if(!empty($phone)){
                    if($template){
                        $content = str_replace('@name', $name, $template->template_description);
                        $gambar = Helper::files('template/'.$template->template_image);
                    }

                    $hp = Helper::convertPhone($phone);

                    if($hp){

                        Notifikasi::create([
                            'notifikasi_name' => $name,
                            'notifikasi_content' => $content,
                            'notifikasi_image' => $gambar,
                            'notifikasi_phone' => $hp,
                            'notifikasi_start' => date('Y-m-d H:i:s'),
                            'notifikasi_type' => $template->template_type ?? 'text',
                        ]);
                    }
                }
            }
            else{

                $users = User::whereNotNull('phone')->get();
                foreach($users as $user){

                    $phone = $user->phone ?? '';
                    $name = $user->name ?? '';
                    $template = $content = $gambar = null;
                    $template = $model->has_template;

                    if(!empty($phone)){
                        if($template){
                            $content = str_replace('@name', $name, $template->template_description);
                            $gambar = Helper::files('template/'.$template->template_image);
                        }

                        $hp = Helper::convertPhone($phone);

                        if($hp){
                            Notifikasi::create([
                                'notifikasi_name' => $name,
                                'notifikasi_content' => $content,
                                'notifikasi_image' => $gambar,
                                'notifikasi_phone' => $hp,
                                'notifikasi_start' => date('Y-m-d H:i:s'),
                                'notifikasi_type' => $template->template_type ?? 'text',
                            ]);
                        }

                    }
                }
            }

        });
    }
}
