<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\User;

class UserMutation
{

	public function upgrade($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
	{
		if (auth()->user()->role == 'admin' || auth()->user()->id == 1)
		{
			$user = User::find($args['id']);
			switch($user->role)
			{
				case 'user':
					$user->role = 'customer';
					break;
				case 'customer':
					$user->role = 'staff';
					break;
				case 'staff':
					$user->role = 'admin';
					break;
			}
			$user->save();
		}

		return User::find($args['id']);
	}

	public function downgrade($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
	{
		if (auth()->user()->role == 'admin' || auth()->user()->id == 1)
		{
			$user = User::find($args['id']);
			switch($user->role)
			{
				case 'customer':
					$user->role = 'user';
					break;
				case 'staff':
					$user->role = 'customer';
					break;
				case 'admin':
					$user->role = 'staff';
					break;
			}
			$user->save();
		}

		return User::find($args['id']);
	}
	
}
