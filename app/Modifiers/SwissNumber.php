<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class SwissNumber extends Modifier
{
    /**
     * Format numbers using Swiss formatting (apostrophe as thousands separator).
     * 
     * Examples:
     * - 1000 becomes 1'000
     * - 164455 becomes 164'455
     * - 1500000.50 becomes 1'500'000.50
     * - 1500000.00 becomes 1'500'000
     * 
     * @param mixed $value The value to format
     * @param array $params Additional parameters (not used)
     * @param array $context The context array
     * @return string The formatted number
     */
    public function index($value, $params, $context)
    {
        // Convert to string and trim whitespace
        $value = trim((string) $value);
        
        // If empty or not numeric, return as-is
        if (empty($value) || !is_numeric($value)) {
            return $value;
        }
        
        // Convert to float to handle decimal values
        $number = (float) $value;
        
        // Check if it's a whole number (no meaningful decimal part)
        $isWholeNumber = ($number == (int) $number);
        
        if ($isWholeNumber) {
            // For whole numbers, format without decimals
            $formatted = number_format($number, 0, '.', '’');
        } else {
            // For decimal numbers, keep up to 2 decimal places and remove trailing zeros
            $formatted = rtrim(rtrim(number_format($number, 2, '.', '\''), '0'), '.');
        }
        
        return $formatted;
    }
}