<?php
namespace App\Helpers;

use App\Area;
use App\CostCentre;
use App\Department;
use App\Section;
use App\EmployeePosition;
use App\Team;
use App\Category;
use App\EmployeeGrade;
use App\BankCode;

class FilterHelper
{
    public static function getCostCentre()
    {
        return CostCentre::orderBy('name')->get();
    }
    
    public static function getDepartment()
    {
        return Department::orderBy('name')->get();
    }
    
    public static function getSection()
    {
        return Section::orderBy('name')->get();
    }
    
    public static function getPosition()
    {
        return EmployeePosition::orderBy('name')->get();
    }
    
    public static function getTeam()
    {
        return Team::orderBy('name')->get();
    }
    
    public static function getCategory()
    {
        return Category::orderBy('name')->get();
    }
    
    public static function getArea()
    {
        return Area::orderBy('name')->get();
    }
    
    public static function getGrade()
    {
        return EmployeeGrade::orderBy('name')->get();
    }
    
    public static function getBankCode()
    {
        return BankCode::orderBy('name')->get();
    }
}

