<?php

use Flarum\Api\Controller\ShowForumController;
use Flarum\Extend;
use FlarumCom\TagsUnderDiscussion\LoadAllForumTagsRelationship;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/custom.less'),

    (new Extend\ApiController(ShowForumController::class))
        ->addInclude(['tags', 'tags.parent', 'tags.children'])
        ->prepareDataForSerialization(LoadAllForumTagsRelationship::class),
];
