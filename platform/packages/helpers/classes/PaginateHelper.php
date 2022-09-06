<?php
class PaginateHelper
{
    public static function show($items)
    {
        return ' <p>Hiển thị '.($items->firstItem() ?? 0).' - '.($items->lastItem() ?? 0).' / '. $items->total().' bản ghi</p>';
    }

    public static function paginate($items, $quering = '')
    {
        return '<div class="custome-paginate d-flex justify-content-between">
                    <div class="pull-left float-start">
                        <p style="margin-top: 20px;">Hiển thị '.($items->firstItem() ?? 0).' - '.($items->lastItem() ?? 0).' / '. $items->total().' bản ghi</p>
                    </div>
                    <div class="pull-right float-end">' . $items->appends($quering)->render() . '</div>
                </div>';
    }
}
