<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Transaction;
use App\Models\Sale;

class SaleMutation
{
	public function store($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
	{
		try
		{
			DB::transaction(function () use ($args, $context) {
				// logger('debug: ', $args);

				$products = $args['products'];
				$amount = 0;



				// $columns = array_column($products, 'id');
				// logger('columns: ', $columns);

				foreach($products as $product)
				{
					$quantity = $product['quantity'];
					$pro = Product::find($product['id']);
					$tax = Tax::find($pro['tax_id']);
					logger('quantity: ', ['qua', $quantity]);
					logger('price: ', ['p', $pro['price']]);
					logger('tax: ', ['t', $tax]);


				}

				// Sale::create([
				// 	'account_id' => $args['account_id'],
				// 	'user_id' => auth()->user()->id,
				// 	'currency_id' => $args['currency_id'],
				// 	'discount' => $args['discount'],
				// 	'taxes' => $args['taxes'],
				// 	'amount' => $args['amount'],
				// 	'paid' => $args['paid'],
				// 	'due_date' => $args['due_date']
				// ]);
				

				// logger('context: ', ['context' => $context->user->name]);
				// logger('date: ', ['date' => $args['due_date']]);
				// logger('products: ', ['products' => $args['products']]);
			});

			return Sale::find(1);
		}
		catch (\Exception $e)
		{
			logger($e);
		}
	}
}
