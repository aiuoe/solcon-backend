<?php

namespace App\GraphQL\Directives;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaginateAuthDirective extends BaseDirective implements FieldResolver
{
  public static function definition(): string
  {
    return /** @lang GraphQL */ <<<'SDL'
    """
    Query multiple model entries as a paginated list.
    """
    directive @paginateAuth(
      """
      Which pagination style to use.
      Allowed values: `paginator`, `connection`.
      """
      type: String = "paginator"

      """
      Specify the class name of the model to use.
      This is only needed when the default model detection does not work.
      """
      model: String

      """
      Point to a function that provides a Query Builder instance.
      This replaces the use of a model.
      """
      builder: String

      """
      Apply scopes to the underlying query.
      """
      scopes: [String!]

      """
      Allow clients to query paginated lists without specifying the amount of items.
      Overrules the `pagination.default_count` setting from `lighthouse.php`.
      """
      defaultCount: Int

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
      ->forPage($args['page'], $this->directiveArgValue('max'))
      ->get();        
    });
  }

}
