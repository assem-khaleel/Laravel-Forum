<?php

namespace LaravelForum;


use LaravelForum\Notifications\ReplyMarkedAsBestReply;

class Discussion extends Model
{


    /** Discussion belongs to User **/
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';

    }

//    public function getBestReply(){
//        return Reply::find($this->reply_id);
//    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function markAsBestReply(Reply $reply)
    {

        if ($reply->owner->id === $this->author->id)  {
            return;
        }

         $this->update([
            'reply_id' => $reply->id,
        ]);

         // block owner of the discussion to make his reply the best

        $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }

    public function scopeFilterByChannels($builder)
    {
        if (request()->query('channel')) {
            // filter by Channel
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if ($channel) {
                return $builder->where('channel_id', $channel->id);
            }
            return $builder;
        }
        return $builder;
    }
}
