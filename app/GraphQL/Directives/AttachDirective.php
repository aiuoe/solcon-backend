<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\BaseDirective; 
use Nuwave\Lighthouse\Support\Contracts\ArgResolver;
use Illuminate\Database\Eloquent\Model;

class AttachDirective extends BaseDirective implements ArgResolver
{

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
			directive @attach(
		  	relation: String
			) on ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION
		GRAPHQL;
  }

  public function __invoke($root, $args)
  {
  	$model = new \ReflectionClass($root);

  	return $model->getName()::find($root['id'])
  	->{$this->directiveArgValue('relation')}()
  	->attach($args);
  }

}
