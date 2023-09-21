<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Ui\AdminTable;
use Modules\User\Repositories\Permission;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Modules\Support\Eloquent\Translatable;

class ProfileCounters extends Model
{
    protected $table = 'profile_counters';

}
