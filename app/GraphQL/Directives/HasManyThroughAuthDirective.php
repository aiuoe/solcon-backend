<?php

namespace App\GraphQL\Directives;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HasManyThroughAuthDirective extends BaseDirective implements FieldResolver
{
  public static function definition(): string
  {
    return /** @lang GraphQL */ <<<'SDL'
    """
    Query multiple model entries as a paginated list.
    """
    directive @hasManyThroughAuth(
      """
      Specify the name of the relation on the parent model
      """
      relation: String

      """
      Apply conditions where column.
      """
      column: String

      """
      Limit the maximum amount of items that clients can request from paginated lists.
      Overrules the `pagination.max_count` setting from `lighthouse.php`.
      """
      max: Int
    ) on FIELD_DEFINITION
    SDL;
  }

  /**
   * Resolve the field directive.
   */
  public function resolveField(FieldValue $fieldValue): FieldValue
  {
    return $fieldValue
    ->setResolver(function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
      return $this->getModelClass()::has($this->directiveArgValue('relation'))
      ->where($this->directiveArgValue('column'), $args['id'])
      ->get()
      ->forPage($args['page'], $this->directiveArgValue('max'));   
    });
  }

}
