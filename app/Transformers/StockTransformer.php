<?php

namespace App\Transformers;

use App\Company;
use App\Stock;
use League\Fractal\TransformerAbstract;

class StockTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'company',
    ];

    /**
     * @param Stock $stock
     *
     * @return array
     */
    public function transform(Stock $stock)
    {
        return [
            'value'    => (float) $stock->value,
            'previous' => (float) $stock->previous,
            'change'   => (float) ($stock->value - $stock->previous),
        ];
    }

    public function includeCompany(Stock $stock)
    {
        return $this->item($stock->company, new CompanyTransformer());
    }
}
