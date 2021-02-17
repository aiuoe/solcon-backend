<?php

namespace App\GraphQL\Directives;

use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\DefinedDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;

class FindAuthDirective extends BaseDirective implements FieldResolver, DefinedDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'SDL'
"""
Find a model based on the arguments provided.
"""
directive @findAuth(
  """
  Specify the class name of the model to use.
  This is only needed when the default model detection does not work.
  """
  model: String

  """
  Apply scopes to the underlying query.
  """
  scopes: [String!]
) on FIELD_DEFINITION
SDL;
    }

    /**
     * Resolve the field directive.
     */
    public function resolveField(FieldValue $fieldValue): FieldValue
    {
        return $fieldValue->setResolver(
            function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): ?Model {
                $results = $resolveInfo
                    ->argumentSet
                    ->enhanceBuilder(
                        $this->getModelClass()::query()->where('user_id', auth()->user()->id),
                        $this->directiveArgValue('scopes', [])
                    )
                    ->get();

                if ($results->count() > 1) {
                    throw new Error('The query returned more than one result.');
                }

                return $results->first();
            }
        );
    }
}
