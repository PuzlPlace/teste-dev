<?php

namespace Classes;


use Carbon\Carbon;

class DataTable
{

    public function getColumns($type, $fields)
    {
        switch ($type) {
            case 'js':
                return json_encode($fields);
                break;
            case 'table':
                return $this->getColumnsTable($fields);
                break;
            default:
                return json_encode([]);
                break;
        }
    }

    public function getColumnsTable($fields)
    {
        $html = '';
        foreach ($fields as $key => $value) {
            $html .= '<th>' . $value['data'] . '</th>';
        }

        return $html;
    }
}
