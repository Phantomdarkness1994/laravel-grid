<?php

namespace Leantony\Grid\Buttons;

class ExportButton extends GenericButton
{
    public $position = 3;

    /**
     * Route to be used for export
     *
     * @var string
     */
    protected $exportRoute = null;

    /**
     * Allow extra parameters to be added on this object
     *
     * @return array
     */
    public function getExtraParams()
    {
        return [
            'exportOptions' => [
                'excel' => [
                    'url' => $this->checkUrl('xlsx'),
                    'icon' => 'file-excel-o',
                    'title' => 'export to excel'
                ],
                'csv' => [
                    'url' => $this->checkUrl('csv'),
                    'icon' => 'file',
                    'title' => 'export to csv'
                ],
                'pdf' => [
                    'url' => $this->checkUrl('pdf'),
                    'icon' => 'file-pdf-o',
                    'title' => 'export to pdf'
                ]
            ]
        ];
    }

    /**
     * Generate url from request or route name
     *
     * @param string $extension
     * @return string
     */
    protected function checkUrl($extension = 'xlsx'): string
    {
        if (filter_var($this->exportRoute, FILTER_VALIDATE_URL)) {
            $v = add_query_param(['export' => $extension]);
            // append the query string
            return request()->fullUrlWithQuery($v);
        }
        return route($this->exportRoute, add_query_param(['export' => $extension]));
    }
}