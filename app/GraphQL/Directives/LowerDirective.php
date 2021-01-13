<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgTransformerDirective;

class LowerDirective extends BaseDirective implements ArgTransformerDirective
{
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html

    /**
    * Formal directive specification in schema definition language (SDL).
    *
    * @return string
    */
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
            """
            A description of what this directive does.
            """
            directive @lower on ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION
        GRAPHQL;
    }

    /**
     * Apply transformations on the value of an argument given to a field.
     *
     * @param  mixed  $argumentValue
     * @return mixed
     */
    public function transform($argumentValue)
    {
        if (is_array($argumentValue))
            return array_map('strtolower', $argumentValue);
        else
            return strtolower($argumentValue);
    }
}