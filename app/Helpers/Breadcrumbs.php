<?php

namespace App\Helpers;

class Breadcrumbs
{
    public static function buildBreadcrumbs($page, $title = "", $id = 0)
    {
        switch ($page) {

            case 'search':
                return [
                    ['route' => '', 'value' => 'search'],
                ];

            case 'categories':
                return [
                    ['route' => '', 'value' => 'categories'],
                ];

            case 'category':
                return [
                    ['route' => route('blog'), 'value' => 'categories'],
                    ['route' => '', 'value' => $title]
                ];

            case 'post':
                return[
                    ['route' => route('blog'), 'value' => 'categories'],
                    ['route' => route('category', $id), 'value' => $title]
                ];

            case 'contact_us':
                return [
                    ['route' => '', 'value' => $title]
                ];
               
            default:
                return [
                    ['route' => '', 'value' => 'default case']
                ];             
        }
    }    
}