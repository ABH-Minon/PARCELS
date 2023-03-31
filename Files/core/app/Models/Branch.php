<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public static function getAllBranchesWithRelations()
    {
        $branches = self::with('branch.branch', 'employees', 'products')->get();
        return $branches;
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'parent_id')->with('branch');
    }

    public function employees()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'branch_id');
    }

}
