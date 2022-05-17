<?php

namespace PanicHD\PanicHD\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'panichd_game';
    protected $fillable = ['name', 'description'];

    /**
     * Indicates that this model should not be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get related tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('PanicHD\PanicHD\Models\Ticket', 'game_id');
    }

    /**
     * Delete all category relations prior of itself.
     */
    public function delete()
    {
        $this->tickets()->delete();
        // $this->closingReasons()->delete();
        // $this->agents()->detach();

        // Tags detach and delete
        // $a_tags = [];
        // foreach ($this->tags()->get() as $tag) {
        //     $a_tags[] = $tag->id;
        // }
        // if ($a_tags) {
        //     $this->tags()->detach();
        //     Tag::whereIn('id', $a_tags)->delete();
        // }
        parent::delete();
    }
}
