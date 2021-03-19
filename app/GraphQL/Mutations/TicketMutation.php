<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;

class TicketMutation
{
	private $ticket, $ticket_db, $id, $title, $message, $pinned, $public, $status, $priority, $channel, $due_date, $users, $admin_related;

	public function upsert($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
	{
		try
		{
			return DB::transaction(function () use ($args)
			{
				self::asoc($args);

				if(auth()->user()->role == 'admin')
				{
					if ($this->ticket_db)
					{
						$this->ticket = self::save();

						if (!$this->status)
						{
							if ($this->admin_related)
								$this->ticket->users()->updateExistingPivot(auth()->user()->id, ['updated_by' => true, 'closed_by' => true]);
							else
								$this->ticket->users()->attach([auth()->user()->id => ['updated_by' => true, 'closed_by' => true]]);
						}
						else
						{
							if ($this->admin_related)
								$this->ticket->users()->updateExistingPivot(auth()->user()->id, ['updated_by' => true]);
							else
								$this->ticket->users()->attach([auth()->user()->id => ['updated_by' => true]]);
						}

						$this->ticket->users()->syncWithoutDetaching($this->users);

						return $this->ticket;
					}
					else
					{
						$this->ticket = self::save();
						$this->ticket->users()->attach([auth()->user()->id => ['created_by' => true]]);
						$this->ticket->users()->attach($this->users);
						return $this->ticket;
					}		
				}
				else
				{
					if ($this->ticket_db)
					{
						if ($this->ticket_db->status == true && $this->ticket_db->public == true)
						{
							$this->ticket = self::save();
							$this->ticket->users()->updateExistingPivot(auth()->user()->id, ['updated_by' => true]);
							return $this->ticket;
						}
					}
					else
					{
						$this->id = 0;
						$this->ticket = self::save();
						$this->ticket->users()->attach([auth()->user()->id => ['created_by' => true]]);
						return $this->ticket;
					}
				}
			});
		}
		catch(\Exception $e)
		{
			logger($e);
			throw new AuthorizationException("Unauthorized");
		}
	}

	private function asoc($args)
	{
		if (auth()->user()->role == 'admin')
		{
			$this->id = $args['id'];
			$this->title = strtolower($args['title']);
			$this->message = strtolower($args['message']);
			$this->pinned = $args['pinned'];
			$this->public = $args['public'];
			$this->status = $args['status'];
			$this->priority = $args['priority'];
			$this->channel = strtolower($args['channel']);
			$this->due_date = $args['due_date'];
			$this->users = (isset($args['users']))? $args['users'] : null;
			$this->ticket_db = Ticket::find($this->id);
			$this->admin_related = $this->ticket_db->users()->where('users.id', auth()->user()->id)->first();
		}
		else
		{
			$this->id = $args['id'];
			$this->title = strtolower($args['title']);
			$this->message = strtolower($args['message']);
			$this->pinned = $args['pinned'];
			$this->public = true;
			$this->status = true;
			$this->priority = $args['priority'];
			$this->channel = strtolower($args['channel']);
			$this->due_date = $args['due_date'];
			$this->ticket_db = auth()->user()->tickets()->where('tickets.id', $this->id)->first();
		}
	}

	private function save()
	{
		return Ticket::updateOrCreate(['id' => $this->id], [
			'title' => $this->title,
			'message' => $this->message,
			'pinned' => $this->pinned,
			'public' => $this->public,
			'priority' => $this->priority,
			'status' => $this->status,
			'channel' => $this->channel,
			'due_date' => $this->due_date
		]);	
	}

	public function delete($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
	{
		
	}
}