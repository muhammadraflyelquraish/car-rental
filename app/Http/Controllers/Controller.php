<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function _getActionButton($primaryId)
    {
        $button = '<div class="btn-group pull-right">';
        $button .= '<button class="btn btn-sm btn-warning" data-mode="edit" data-integrity="' . $primaryId . '" data-toggle="modal" data-target="#ModalAddEdit"><i class="fa fa-edit"></i></button>';
        $button .= '<button class="btn btn-sm btn-danger" id="delete" data-integrity="' . $primaryId . '"><i class="fa fa-trash"></i></button>';
        $button .= '</div>';
        return $button;
    }

    protected function _getFilterColumn(array $fields, $query)
    {
        for ($i = 0; $i < count($fields); $i++) {
            if (request()->has($fields[$i])) {
                $query->where($fields[$i], 'like', '%' . trim(request($fields[$i])) . '%');
            }
        }
        return $query;
    }
}
