<?php
declare(strict_types=1);
use InvalidArgumentException;
require_once('Mapping.php');

class CurrencySymbolUtil {
	public static function getSymbol(string $currency): string {
        $currencySymbolMapping = CurrencySymbolMapping::values();
        /** @var string $symbol */
        $symbol = $currencySymbolMapping[$currency] ?? null;
        if ($symbol === null) {
             throw new InvalidArgumentException('Invalid currency');
        }
        return $symbol;
    }
}
