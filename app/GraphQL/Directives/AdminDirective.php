<?php

namespace App\GraphQL\Directives;

use Closure;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;


class AdminDirective extends BaseDirective implements FieldMiddleware
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
			directive @admin on FIELD_DEFINITION
		GRAPHQL;
	}

  public function handleField(FieldValue $fieldValue, Closure $next): FieldValue
  {
    $previousResolver = $fieldValue->getResolver();

    return $next($fieldValue->setResolver(function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) use ($previousResolver) 
      {
      	if (auth()->user()->role == 'admin')
          return $previousResolver($root, $args, $context, $resolveInfo);
        else
      		throw new AuthorizationException("Unauthorized");
      }));
  }

}