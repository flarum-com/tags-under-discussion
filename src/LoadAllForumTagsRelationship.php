<?php

namespace FlarumCom\TagsUnderDiscussion;

use Flarum\Api\Controller\ShowForumController;
use Flarum\Http\RequestUtil;
use Flarum\Tags\Tag;
use Psr\Http\Message\ServerRequestInterface;

class LoadAllForumTagsRelationship
{
    public function __invoke(ShowForumController $controller, array &$data, ServerRequestInterface $request): void
    {
        $actor = RequestUtil::getActor($request);

        // Expose the complete tag list to clients by adding it as a
        // relationship to the /api endpoint. Since the Forum model
        // doesn't actually have a tags relationship, we will manually load and
        // assign the tags data to it using an event listener.
        $data['tags'] = Tag::query()
            ->whereVisibleTo($actor)
            ->withStateFor($actor)
            ->get();
    }
}
