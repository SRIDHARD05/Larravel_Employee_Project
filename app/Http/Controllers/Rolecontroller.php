<?php

namespace App\Http\Controllers;

use app\Services\RoleService;
use Illuminate\Http\Request;

class Rolecontroller extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    
}
