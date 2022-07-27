<?php

namespace Amasty\Trainee;

use Amasty\Trainee\Models\Pizza;

class Calculator
{
    public function calculate(Pizza $pizza): array
    {
        $connection = Core::getConnection();
        $pizzaPrice = $connection->fetchOne('select price from pizza where name = :name', ['name' => $pizza->getType()]);
        $sizePrice = $connection->fetchOne('select price from pizza_sizes where size = :size', ['size' => $pizza->getSize()]);
        $sousPrice = $connection->fetchOne('select price from sous where name = :name', ['name' => $pizza->getSous()]);

        if ($pizzaPrice === null || $sizePrice === null || $sousPrice === null) {
            throw new \Exception('Broken selection');
        }

        $parts = [
            'sous_price' => $this->formatPrice($sousPrice),
            'size_additional_price' => $this->formatPrice($sizePrice),
            'pizza_price' => $this->formatPrice($pizzaPrice)
        ];

        $parts['total'] = $this->formatPrice(array_sum($parts));

        return $parts;
    }

    private function formatPrice($price): string
    {
        return sprintf('%.2F BYN', (float) $price);
    }
}