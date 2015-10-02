<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'repo_url', 'init_script', 'base_ami_id'];

    public function env_variables()
    {
        return $this->hasMany('App\EnvVariable');
    }

    public function versions()
    {
    	return $this->hasMany('App\Version');
    }
}
