<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'featured_image' => $this->featured_image ? asset('storage/' . $this->featured_image) : null,
            'published_at' => $this->published_at?->toISOString(),
            'comments_count' => $this->relationLoaded('comments') ? $this->comments->count() : $this->comments()->count(),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
